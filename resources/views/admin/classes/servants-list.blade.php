@if($servants->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهاتف</th>
                    <th>الدور</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servants as $index => $servant)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($servant->profile_image)
                                    <img src="{{ $servant->profile_image_url }}" 
                                         class="rounded-circle me-2" 
                                         width="32" 
                                         height="32"
                                         alt="{{ $servant->full_name }}">
                                @else
                                    <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                         style="width: 32px; height: 32px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                @endif
                                <span>{{ $servant->full_name }}</span>
                            </div>
                        </td>
                        <td>{{ $servant->email }}</td>
                        <td>{{ $servant->phone ?? 'غير محدد' }}</td>
                        <td>
                            @if($servant->is_main_servant)
                                <span class="badge bg-primary">خادم رئيسي</span>
                            @else
                                <span class="badge bg-secondary">خادم مساعد</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="text-center py-4">
        <i class="fas fa-user-tie fa-3x text-muted mb-3"></i>
        <h5 class="text-muted">لا يوجد خدام مسجلين</h5>
        <p class="text-muted">لم يتم تسجيل أي خدام في هذا الفصل بعد</p>
    </div>
@endif 