@extends('layouts.app')

@section('title', 'إدارة المستخدمين')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin-users.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="container-fluid admin-users-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-title">
                <div class="title-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="title-text">
                    <h1>إدارة المستخدمين</h1>
                    <p>إدارة جميع المستخدمين في النظام</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.users.create') }}" class="add-user-btn">
                    <i class="fas fa-plus"></i>
                    <span>إضافة مستخدم جديد</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-card primary">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $stats['total_users'] }}</div>
                    <div class="stat-label">إجمالي المستخدمين</div>
                </div>
            </div>

            <div class="stat-card success">
                <div class="stat-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $stats['servants'] }}</div>
                    <div class="stat-label">الخدام</div>
                </div>
            </div>

            <div class="stat-card info">
                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $stats['students'] }}</div>
                    <div class="stat-label">المخدومين</div>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $stats['admins'] }}</div>
                    <div class="stat-label">المديرين</div>
                </div>
            </div>

            <div class="stat-card danger">
                <div class="stat-icon">
                    <i class="fas fa-mars"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $stats['males'] }}</div>
                    <div class="stat-label">الذكور</div>
                </div>
            </div>

            <div class="stat-card secondary">
                <div class="stat-icon">
                    <i class="fas fa-venus"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $stats['females'] }}</div>
                    <div class="stat-label">الإناث</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters Section -->
    <div class="modern-filter-section">
        <div class="modern-filter-header">
            <h3><i class="fas fa-search"></i> فلاتر البحث المتقدمة</h3>
        </div>
        <form method="GET" action="{{ route('admin.users') }}" id="searchForm">
            <div class="modern-filter-grid">
                <div class="modern-filter-group">
                    <label for="name"><i class="fas fa-user"></i> الاسم</label>
                    <input type="text" class="modern-form-control" id="name" name="name" value="{{ request('name') }}" placeholder="البحث بالاسم...">
                </div>

                <div class="modern-filter-group">
                    <label for="role"><i class="fas fa-user-tag"></i> الدور</label>
                    <select class="modern-form-select" id="role" name="role">
                        <option value="">جميع الأدوار</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>مدير</option>
                        <option value="خادم" {{ request('role') == 'خادم' ? 'selected' : '' }}>خادم</option>
                        <option value="مخدوم" {{ request('role') == 'مخدوم' ? 'selected' : '' }}>مخدوم</option>
                    </select>
                </div>

                <div class="modern-filter-group">
                    <label for="gender"><i class="fas fa-venus-mars"></i> النوع</label>
                    <select class="modern-form-select" id="gender" name="gender">
                        <option value="">جميع الأنواع</option>
                        <option value="ذكر" {{ request('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                        <option value="أنثى" {{ request('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                    </select>
                </div>

                <div class="modern-filter-group">
                    <label for="class"><i class="fas fa-graduation-cap"></i> الفصل</label>
                    <select class="modern-form-select" id="class" name="class">
                        <option value="">جميع الفصول</option>
                        @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="modern-filter-group">
                    <label for="age_min"><i class="fas fa-birthday-cake"></i> السن من</label>
                    <input type="number" class="modern-form-control" id="age_min" name="age_min" value="{{ request('age_min') }}" min="0" max="100">
                </div>

                <div class="modern-filter-group">
                    <label for="age_max"><i class="fas fa-birthday-cake"></i> السن إلى</label>
                    <input type="number" class="modern-form-control" id="age_max" name="age_max" value="{{ request('age_max') }}" min="0" max="100">
                </div>

                <div class="modern-filter-group">
                    <label for="registered_from"><i class="fas fa-calendar-alt"></i> تاريخ التسجيل من</label>
                    <input type="date" class="modern-form-control" id="registered_from" name="registered_from" value="{{ request('registered_from') }}">
                </div>

                <div class="modern-filter-group">
                    <label for="registered_to"><i class="fas fa-calendar-alt"></i> تاريخ التسجيل إلى</label>
                    <input type="date" class="modern-form-control" id="registered_to" name="registered_to" value="{{ request('registered_to') }}">
                </div>

                <div class="modern-filter-group">
                    <label for="sort_by"><i class="fas fa-sort"></i> ترتيب حسب</label>
                    <select class="modern-form-select" id="sort_by" name="sort_by">
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>تاريخ التسجيل</option>
                        <option value="full_name" {{ request('sort_by') == 'full_name' ? 'selected' : '' }}>الاسم</option>
                        <option value="role" {{ request('sort_by') == 'role' ? 'selected' : '' }}>الدور</option>
                        <option value="birth_date" {{ request('sort_by') == 'birth_date' ? 'selected' : '' }}>تاريخ الميلاد</option>
                    </select>
                </div>

                <div class="modern-filter-group">
                    <label for="sort_order"><i class="fas fa-sort-amount-down"></i> الترتيب</label>
                    <select class="modern-form-select" id="sort_order" name="sort_order">
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>تنازلي</option>
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>تصاعدي</option>
                    </select>
                </div>
            </div>

            <div class="modern-filter-actions">
                <button type="submit" class="modern-search-btn">
                    <i class="fas fa-search"></i>
                    <span>بحث</span>
                </button>
                <a href="{{ route('admin.users') }}" class="modern-reset-btn">
                    <i class="fas fa-times"></i>
                    <span>إلغاء</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Users Table Section -->
    <div class="table-section">
        <div class="table-card">
            <div class="table-header">
                <div class="table-title">
                    <h3><i class="fas fa-list"></i> قائمة المستخدمين</h3>
                </div>
                <div class="table-info">
                    <span class="results-count">إجمالي النتائج: {{ $users->total() }}</span>
                </div>
            </div>

            <div class="table-container">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>النوع</th>
                            <th>السن</th>
                            <th>الدور</th>
                            <th>الفصل</th>
                            <th>تاريخ التسجيل</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="user-row">
                            <td class="user-info">
                                <div class="user-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="user-details">
                                    <div class="user-name">{{ $user->full_name }}</div>
                                    <div class="user-phone">{{ $user->phone ?? 'لا يوجد رقم' }}</div>
                                </div>
                            </td>

                            <td class="user-email">{{ $user->email }}</td>

                            <td class="user-gender">
                                @if($user->gender == 'ذكر')
                                <span class="badge badge-male">
                                    <i class="fas fa-mars"></i>
                                    ذكر
                                </span>
                                @elseif($user->gender == 'أنثى')
                                <span class="badge badge-female">
                                    <i class="fas fa-venus"></i>
                                    أنثى
                                </span>
                                @else
                                <span class="badge badge-unknown">غير محدد</span>
                                @endif
                            </td>

                            <td class="user-age">
                                @if($user->birth_date)
                                <span class="age-number">{{ Carbon\Carbon::parse($user->birth_date)->age }}</span>
                                <span class="age-unit">سنة</span>
                                @else
                                <span class="age-unknown">غير محدد</span>
                                @endif
                            </td>

                            <td class="user-role">
                                @switch($user->role)
                                @case('admin')
                                <span class="badge badge-admin">
                                    <i class="fas fa-user-shield"></i>
                                    مدير
                                </span>
                                @break
                                @case('خادم')
                                <span class="badge badge-servant">
                                    <i class="fas fa-user-tie"></i>
                                    خادم
                                </span>
                                @break
                                @case('مخدوم')
                                <span class="badge badge-student">
                                    <i class="fas fa-user-graduate"></i>
                                    مخدوم
                                </span>
                                @break
                                @default
                                <span class="badge badge-unknown">{{ $user->role }}</span>
                                @endswitch
                            </td>

                            <td class="user-class">
                                @if($user->my_class)
                                <span class="class-badge">{{ $user->my_class }}</span>
                                @else
                                <span class="class-unknown">غير محدد</span>
                                @endif
                            </td>

                            <td class="user-date">
                                <div class="date-main">{{ $user->created_at->format('Y-m-d') }}</div>
                                <div class="date-relative">{{ $user->created_at->diffForHumans() }}</div>
                            </td>

                            <td class="user-actions">
                                <div class="actions-container">
                                    <div class="modern-action-grid">
                                        @if($user->role != 'admin')
                                        <button type="button" class="modern-action-btn manager change-role-btn"
                                            data-user-id="{{ $user->id }}"
                                            data-new-role="admin"
                                            data-user-name="{{ $user->full_name }}"
                                            data-tooltip="جعل المستخدم مدير">
                                            <i class="fas fa-user-shield"></i>
                                            <span>مدير</span>
                                        </button>
                                        @endif
                                        @if($user->role != 'خادم')
                                        <button type="button" class="modern-action-btn servant change-role-btn"
                                            data-user-id="{{ $user->id }}"
                                            data-new-role="خادم"
                                            data-user-name="{{ $user->full_name }}"
                                            data-tooltip="جعل المستخدم خادم">
                                            <i class="fas fa-user-tie"></i>
                                            <span>خادم</span>
                                        </button>
                                        @endif
                                        @if($user->role != 'مخدوم')
                                        <button type="button" class="modern-action-btn served change-role-btn"
                                            data-user-id="{{ $user->id }}"
                                            data-new-role="مخدوم"
                                            data-user-name="{{ $user->full_name }}"
                                            data-tooltip="جعل المستخدم مخدوم">
                                            <i class="fas fa-user-graduate"></i>
                                            <span>مخدوم</span>
                                        </button>
                                        @endif

                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                            class="modern-action-btn view"
                                            data-tooltip="عرض تفاصيل المستخدم">
                                            <i class="fas fa-eye"></i>
                                            <span>عرض</span>
                                        </a>

                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="modern-action-btn edit"
                                            data-tooltip="تعديل بيانات المستخدم">
                                            <i class="fas fa-edit"></i>
                                            <span>تعديل</span>
                                        </a>

                                        <button type="button" class="modern-action-btn transfer transfer-class"
                                            data-user-id="{{ $user->id }}"
                                            data-current-class="{{ $user->my_class }}"
                                            data-user-name="{{ $user->full_name }}"
                                            data-tooltip="نقل المستخدم لفصل آخر">
                                            <i class="fas fa-exchange-alt"></i>
                                            <span>نقل</span>
                                        </button>

                                        <button type="button" class="modern-action-btn delete delete-user"
                                            data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->full_name }}"
                                            data-tooltip="حذف المستخدم">
                                            <i class="fas fa-trash"></i>
                                            <span>حذف</span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h4>لا توجد مستخدمين</h4>
                                    <p>قم بإضافة مستخدمين جدد أو تعديل فلاتر البحث</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-section">
                <div class="pagination-info">
                    <span>عرض {{ $users->firstItem() ?? 0 }} إلى {{ $users->lastItem() ?? 0 }} من {{ $users->total() }} نتيجة</span>
                </div>
                <div class="pagination-links">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal نقل الفصل -->
<div class="modal fade" id="transferClassModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">نقل المستخدم لفصل آخر</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="transferClassForm">
                <div class="modal-body">
                    <input type="hidden" id="transferUserId">
                    <div class="form-group">
                        <label for="newClass" class="form-label">الفصل الجديد</label>
                        <select class="form-select" id="newClass" name="my_class" required>
                            <option value="">اختر الفصل</option>
                            @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }} - {{ $class->stage }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">تأكيد النقل</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal تغيير الدور -->
<div class="modal fade" id="changeRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تغيير دور المستخدم</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="changeRoleMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" id="confirmChangeRole">تأكيد التغيير</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // إضافة tooltips للأزرار
        $('[data-tooltip]').addClass('tooltip');

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

            // رسالة تأكيد محسنة
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
                    // إضافة loading state
                    $(this).addClass('loading');

                    $.ajax({
                        url: `/admin/users/${userId}/role`,
                        method: 'POST',
                        data: {
                            role: newRole,
                            _token: '{{ csrf_token() }}'
                        },
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
                        error: function(xhr) {
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

        // نقل الفصل - تفعيل الأزرار
        $('.transfer-class').click(function() {
            const userId = $(this).data('user-id');
            const currentClass = $(this).data('current-class');
            const userName = $(this).data('user-name');

            $('#transferUserId').val(userId);
            if (currentClass) {
                $('#newClass').val(currentClass);
            }

            // تحديث عنوان النافذة
            $('#transferClassModal .modal-title').text(`نقل المستخدم: ${userName}`);
            $('#transferClassModal').modal('show');
        });

        // تأكيد نقل الفصل
        $('#transferClassForm').submit(function(e) {
            e.preventDefault();
            const userId = $('#transferUserId').val();
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
            $('#transferClassForm button[type="submit"]').prop('disabled', true).text('جاري النقل...');

            $.ajax({
                url: `/admin/users/${userId}/class`,
                method: 'PUT',
                data: {
                    my_class: newClass,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#transferClassModal').modal('hide');
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
                error: function(xhr) {
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
                    $('#transferClassForm button[type="submit"]').prop('disabled', false).text('تأكيد النقل');
                }
            });
        });

        // حذف المستخدم - تفعيل الأزرار مع تأكيد محسن
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
                    // إضافة loading state
                    $(this).addClass('loading');

                    $.ajax({
                        url: `/admin/users/${userId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
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
                        error: function(xhr) {
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

        // تحسين تجربة المستخدم - إضافة تأثيرات بصرية
        $('.modern-action-btn').hover(
            function() {
                $(this).addClass('btn-hover-effect');
            },
            function() {
                $(this).removeClass('btn-hover-effect');
            }
        );

        // إضافة تأثير النقر
        $('.modern-action-btn').click(function() {
            $(this).addClass('btn-click-effect');
            setTimeout(() => {
                $(this).removeClass('btn-click-effect');
            }, 200);
        });

        // تحسين عرض الجدول على الشاشات الصغيرة
        if ($(window).width() < 768) {
            $('.users-table').addClass('table-responsive');
        }

        // إضافة تأثيرات للبطاقات الإحصائية
        $('.stat-card').hover(
            function() {
                $(this).addClass('stat-hover-effect');
            },
            function() {
                $(this).removeClass('stat-hover-effect');
            }
        );
    });

    // إضافة تأثيرات CSS إضافية
    const additionalStyles = `
    .btn-hover-effect {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .btn-click-effect {
        transform: translateY(1px) scale(0.98);
    }

    .modern-action-btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-hover-effect {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    }

    .stat-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    @media (max-width: 768px) {
        .users-table {
            font-size: 12px;
        }

        .modern-action-btn {
            padding: 6px 8px;
            font-size: 11px;
        }

        .modern-action-btn span {
            display: none;
        }

        .modern-action-btn i {
            font-size: 14px;
        }
    }
`;

    const styleSheet = document.createElement('style');
    styleSheet.textContent = additionalStyles;
    document.head.appendChild(styleSheet);
</script>
@endpush
