@if($students->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهاتف</th>
                    <th>النقاط</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($student->profile_image)
                                    <img src="{{ $student->profile_image_url }}" 
                                         class="rounded-circle me-2" 
                                         width="32" 
                                         height="32"
                                         alt="{{ $student->full_name }}">
                                @else
                                    <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                         style="width: 32px; height: 32px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                @endif
                                <span>{{ $student->full_name }}</span>
                            </div>
                        </td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone ?? 'غير محدد' }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $student->score ?? 0 }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="text-center py-4">
        <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
        <h5 class="text-muted">لا يوجد طلاب مسجلين</h5>
        <p class="text-muted">لم يتم تسجيل أي طلاب في هذا الفصل بعد</p>
    </div>
@endif 