@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exam-management.css">
@endpush

@section('content')
<div class="exam-list-container">
    <div class="page-header">
        <h1 class="page-title">📝 إدارة الامتحانات</h1>
        <a href="{{ route('admin.exams.create') }}" class="add-exam-btn">
            <span>➕</span>
            <span>إضافة امتحان جديد</span>
        </a>
    </div>

    @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif

    @if($exams->count() > 0)
    <div class="table-responsive">
        <table class="exam-table">
            <thead>
                <tr>
                    <th>📋 اسم الامتحان</th>
                    <th>📚 المادة</th>
                    <th>🎯 النوع/المستوى</th>
                    <th>👁️ طريقة العرض</th>
                    <th>⏰ الزمن</th>
                    <th>🕐 وقت البداية</th>
                    <th>🕙 وقت النهاية</th>
                    <th>⚙️ الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exams as $exam)
                <tr>
                    <td>
                        <strong>{{ $exam->title }}</strong>
                    </td>
                    <td>
                        <span class="stage-badge">{{ $exam->subject->name ?? 'غير محدد' }}</span>
                    </td>
                    <td>
                        @if($exam->class_id)
                        <span class="stage-badge" style="background: #17a2b8; color: white;">فصل محدد</span>
                        <br><small style="color: #666;">{{ $exam->studyClass->name ?? 'غير محدد' }}</small>
                        @else
                        <span class="stage-badge">{{ $exam->stage ?? 'غير محدد' }}</span>
                        @endif
                    </td>
                    <td>
                        <span class="display-mode-badge {{ $exam->display_mode == 'one_by_one' ? 'one-by-one' : 'all-at-once' }}">
                            {{ $exam->display_mode == 'one_by_one' ? 'سؤال بسؤال' : 'كل الأسئلة معًا' }}
                        </span>
                    </td>
                    <td>
                        @if($exam->total_time)
                        <span class="stage-badge">{{ $exam->total_time }} دقيقة</span>
                        @else
                        <span style="color: #999; font-style: italic;">غير محدد</span>
                        @endif
                    </td>
                    <td>
                        <small>{{ \Carbon\Carbon::parse($exam->start_time)->format('Y-m-d H:i') }}</small>
                    </td>
                    <td>
                        <small>{{ \Carbon\Carbon::parse($exam->end_time)->format('Y-m-d H:i') }}</small>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.exams.show', $exam) }}" class="btn btn-info" title="عرض">
                                <span>👁️</span>
                            </a>
                            <a href="{{ route('admin.exams.edit', $exam) }}" class="btn btn-primary" title="تعديل">
                                <span>✏️</span>
                            </a>
                            <form action="{{ route('admin.exams.destroy', $exam) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="حذف"
                                    onclick="return confirm('⚠️ هل أنت متأكد من حذف هذا الامتحان؟')">
                                    <span>🗑️</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state">
        <h3>📝 لا توجد امتحانات</h3>
        <p>لم يتم إنشاء أي امتحانات بعد. ابدأ بإنشاء امتحان جديد!</p>
        <a href="{{ route('admin.exams.create') }}" class="add-exam-btn">
            <span>➕</span>
            <span>إضافة امتحان جديد</span>
        </a>
    </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects to table rows
        const tableRows = document.querySelectorAll('.exam-table tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
            });

            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Add confirmation for delete buttons
        const deleteButtons = document.querySelectorAll('.btn-danger');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('⚠️ هل أنت متأكد من حذف هذا الامتحان؟')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection