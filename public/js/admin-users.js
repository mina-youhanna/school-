// انتظار تحميل jQuery
if (typeof jQuery === 'undefined') {
    console.error('jQuery is not loaded!');
} else {
    console.log('jQuery is loaded successfully');
}

$(document).ready(function() {
    console.log('=== Admin Users JS Loaded ===');

    // إزالة الخلفية السوداء عند hover - فقط هذا التغيير
    $('.users-table tr').hover(
        function() {
            $(this).css({
                'background': 'rgba(255, 255, 255, 0.03)',
                'transform': 'scale(1.01)',
                'transition': 'all 0.3s ease'
            });
        },
        function() {
            $(this).css({
                'background': '',
                'transform': '',
                'transition': ''
            });
        }
    );

    // تغيير الدور - تفعيل الأزرار
    $('.change-role-btn').click(function() {
        const userId = $(this).data('user-id');
        const newRole = $(this).data('new-role');
        const userName = $(this).data('user-name');

        const roleNames = {
            'admin': 'مدير',
            'خادم': 'خادم',
            'مخدوم': 'مخدوم'
        };

        let confirmMessage = '';
        if (newRole === 'admin') {
            confirmMessage = `هل تريد جعل المستخدم "${userName}" مدير؟\nسيحصل على صلاحيات إدارية كاملة.`;
        } else if (newRole === 'خادم') {
            confirmMessage = `هل تريد جعل المستخدم "${userName}" خادم؟\nسيحصل على صلاحيات الخدمة.`;
        } else if (newRole === 'مخدوم') {
            confirmMessage = `هل تريد جعل المستخدم "${userName}" مخدوم؟\nسيصبح طالب في النظام.`;
        }

        Swal.fire({
            title: 'تأكيد تغيير الدور',
            text: confirmMessage,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4CAF50',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'نعم، تأكيد',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).addClass('loading');

                const requestData = {
                    role: newRole,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url: `/admin/users/${userId}/role`,
                    method: 'POST',
                    data: requestData,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'تم تغيير الدور بنجاح',
                                text: `تم جعل ${userName} ${roleNames[newRole]} بنجاح`,
                                confirmButtonText: 'حسناً',
                                confirmButtonColor: '#4CAF50'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ',
                                text: response.message || 'حدث خطأ أثناء تغيير الدور',
                                confirmButtonText: 'حسناً',
                                confirmButtonColor: '#F44336'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = 'حدث خطأ أثناء تغيير الدور';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: errorMessage,
                            confirmButtonText: 'حسناً',
                            confirmButtonColor: '#F44336'
                        });
                    },
                    complete: function() {
                        $('.change-role-btn').removeClass('loading');
                    }
                });
            }
        });
    });

    // نقل الفصل - تفعيل الأزرار مع جلب الفصول من قاعدة البيانات
    $('.transfer-class').click(function() {
        const userId = $(this).data('user-id');
        const currentClass = $(this).data('current-class');
        const userName = $(this).data('user-name');

        // جلب الفصول من قاعدة البيانات
        console.log('Fetching classes from database...');
        $.ajax({
            url: '/admin/classes/list-api',
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(classes) {
                console.log('Classes loaded successfully:', classes);
                // إنشاء خيارات الفصول
                let optionsHtml = '<option value="">اختر الفصل</option>';
                classes.forEach(function(classItem) {
                    optionsHtml += `<option value="${classItem.id}">${classItem.name} - ${classItem.stage}</option>`;
                });

                // إنشاء modal محسن
                const modalHtml = `
                    <div class="modal fade" id="transferClassModal" tabindex="-1" data-bs-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        <i class="fas fa-exchange-alt text-primary"></i>
                                        نقل المستخدم: ${userName}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="transferClassForm">
                                        <input type="hidden" id="transferUserId" value="${userId}">
                                        <div class="form-group">
                                            <label for="newClass" class="form-label">
                                                <i class="fas fa-graduation-cap"></i>
                                                اختر الفصل الجديد
                                            </label>
                                            <select class="form-select" id="newClass" name="my_class" required>
                                                ${optionsHtml}
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fas fa-times"></i>
                                        إلغاء
                                    </button>
                                    <button type="button" class="btn btn-primary" id="confirmTransfer">
                                        <i class="fas fa-check"></i>
                                        تأكيد النقل
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // إزالة modal سابق إذا وجد
                $('#transferClassModal').remove();

                // إضافة modal جديد
                $('body').append(modalHtml);

                // تعيين القيمة الحالية إذا وجدت
                if (currentClass) {
                    $('#newClass').val(currentClass);
                }

                // عرض modal
                const modal = new bootstrap.Modal(document.getElementById('transferClassModal'));
                modal.show();

                // تفعيل زر التأكيد
                $('#confirmTransfer').click(function() {
                    const newClass = $('#newClass').val();

                    if (!newClass) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'تنبيه',
                            text: 'يرجى اختيار الفصل الجديد',
                            confirmButtonText: 'حسناً',
                            confirmButtonColor: '#FF9800'
                        });
                        return;
                    }

                    // إضافة loading state
                    $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري النقل...');

                    const requestData = {
                        my_class: newClass,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };

                    console.log('Sending transfer request:', {
                        userId: userId,
                        newClass: newClass,
                        url: `/admin/users/${userId}/class`,
                        data: requestData
                    });

                    $.ajax({
                        url: `/admin/users/${userId}/class`,
                        method: 'PUT',
                        data: requestData,
                        success: function(response) {
                            console.log('Transfer successful:', response);
                            modal.hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'تم النقل بنجاح',
                                text: 'تم نقل المستخدم للفصل الجديد بنجاح',
                                confirmButtonText: 'حسناً',
                                confirmButtonColor: '#4CAF50'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Transfer failed:', xhr, status, error);
                            let errorMessage = 'حدث خطأ أثناء نقل الفصل';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ',
                                text: errorMessage,
                                confirmButtonText: 'حسناً',
                                confirmButtonColor: '#F44336'
                            });
                        },
                        complete: function() {
                            $('#confirmTransfer').prop('disabled', false).html('<i class="fas fa-check"></i> تأكيد النقل');
                        }
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error('Error loading classes:', xhr, status, error);
                console.log('Response:', xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: 'فشل في تحميل قائمة الفصول: ' + (xhr.responseJSON?.message || error),
                    confirmButtonText: 'حسناً',
                    confirmButtonColor: '#F44336'
                });
            }
        });
    });

    // حذف المستخدم - تفعيل الأزرار
    $('.delete-user').click(function() {
        const userId = $(this).data('user-id');
        const userName = $(this).data('user-name');

        Swal.fire({
            title: 'تأكيد الحذف',
            text: `هل أنت متأكد من حذف المستخدم "${userName}"؟\nهذا الإجراء لا يمكن التراجع عنه نهائياً.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#F44336',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).addClass('loading');

                const requestData = {
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url: `/admin/users/${userId}`,
                    method: 'DELETE',
                    data: requestData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'تم الحذف بنجاح',
                            text: `تم حذف المستخدم "${userName}" بنجاح`,
                            confirmButtonText: 'حسناً',
                            confirmButtonColor: '#4CAF50'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = 'حدث خطأ أثناء حذف المستخدم';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: errorMessage,
                            confirmButtonText: 'حسناً',
                            confirmButtonColor: '#F44336'
                        });
                    },
                    complete: function() {
                        $('.delete-user').removeClass('loading');
                    }
                });
            }
        });
    });

    // Auto-submit form on filter change
    $('#role, #gender, #class, #sort_by, #sort_order').change(function() {
        $('#searchForm').submit();
    });

    console.log('=== Admin Users JS Initialization Complete ===');
});
