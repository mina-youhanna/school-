@extends('layouts.app')

@section('title', 'سجل الامتحانات')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
    .exams-page {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        min-height: 100vh;
        padding: 20px;
        font-family: 'Cairo', sans-serif;
    }

    .page-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .title-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #FF9800, #F57C00);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 4px 15px rgba(255, 152, 0, 0.3);
    }

    .title-text h1 {
        color: white;
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .header-actions {
        display: flex;
        gap: 15px;
    }

    .btn {
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        color: white;
    }

    .btn-primary {
        background: linear-gradient(135deg, #FF9800, #F57C00);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    .search-section {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .search-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        align-items: end;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        color: white;
        font-weight: 600;
        font-size: 14px;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        padding: 12px 15px;
        color: white;
        font-size: 14px;
    }

    .form-control:focus {
        outline: none;
        border-color: #FF9800;
        box-shadow: 0 0 0 2px rgba(255, 152, 0, 0.2);
    }

    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .search-result-item {
        padding: 10px 15px;
        cursor: pointer;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        color: #333;
        transition: background-color 0.2s ease;
    }

    .search-result-item:hover {
        background-color: rgba(255, 152, 0, 0.1);
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .table-container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 215, 0, 0.1));
        color: #FFD700;
        font-weight: 700;
        padding: 12px;
        text-align: center;
        border-bottom: 2px solid #FFD700;
        font-size: 13px;
    }

    .table td {
        padding: 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.9);
        text-align: center;
        vertical-align: middle;
    }

    .table tr:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .score-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .score-excellent {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
    }

    .score-very-good {
        background: linear-gradient(135deg, #FF9800, #F57C00);
        color: white;
    }

    .score-good {
        background: linear-gradient(135deg, #2196F3, #1976D2);
        color: white;
    }

    .score-pass {
        background: linear-gradient(135deg, #00BCD4, #0097A7);
        color: white;
    }

    .score-fail {
        background: linear-gradient(135deg, #F44336, #D32F2F);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    .btn-warning {
        background: linear-gradient(135deg, #FF9800, #F57C00);
        color: white;
    }

    .btn-danger {
        background: linear-gradient(135deg, #F44336, #D32F2F);
        color: white;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .page-link {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        text-decoration: none;
    }

    .page-item.active .page-link {
        background: #FF9800;
        border-color: #FF9800;
    }

    @media (max-width: 768px) {
        .exams-page {
            padding: 15px;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .search-form {
            grid-template-columns: 1fr;
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            font-size: 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="exams-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-title">
                <div class="title-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="title-text">
                    <h1>سجل الامتحانات</h1>
                    <p>إدارة سجلات الامتحانات للطلاب</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.enhanced-exams.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    <span>إضافة امتحان جديد</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <form method="GET" action="{{ route('admin.enhanced-exams.index') }}" class="search-form">
            <div class="form-group">
                <label for="exam_date">تاريخ الامتحان:</label>
                <input type="date" name="exam_date" id="exam_date" class="form-control" value="{{ request('exam_date') }}">
            </div>
            <div class="form-group">
                <label for="start_date">من تاريخ:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="form-group">
                <label for="end_date">إلى تاريخ:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="form-group">
                <label for="user_search">الطالب:</label>
                <input type="text"
                    name="user_search"
                    id="user_search"
                    class="form-control"
                    placeholder="اكتب اسم الطالب للبحث..."
                    value="{{ request('user_search') }}"
                    autocomplete="off">
                <input type="hidden" name="user_id" id="user_id" value="{{ request('user_id') }}">
                <div id="user_search_results" class="search-results" style="display: none;"></div>
            </div>
            <div class="form-group">
                <label for="class_id">الفصل:</label>
                <select name="class_id" id="class_id" class="form-control">
                    <option value="">اختر الفصل</option>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="subject_name">المادة:</label>
                <input type="text" name="subject_name" id="subject_name" class="form-control" placeholder="اسم المادة" value="{{ request('subject_name') }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                    <span>بحث</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>الطالب</th>
                    <th>الفصل</th>
                    <th>المادة</th>
                    <th>تاريخ الامتحان</th>
                    <th>الدرجة</th>
                    <th>النسبة المئوية</th>
                    <th>التقييم</th>
                    <th>ملاحظات</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($examRecords as $record)
                <tr>
                    <td>{{ $record->user->full_name }}</td>
                    <td>{{ $record->class->name }}</td>
                    <td>{{ $record->subject_name }}</td>
                    <td>{{ $record->exam_date->format('Y-m-d') }}</td>
                    <td>{{ $record->score }}/{{ $record->max_score }}</td>
                    <td>
                        <span class="score-badge score-{{ $record->percentage >= 90 ? 'excellent' : ($record->percentage >= 80 ? 'very-good' : ($record->percentage >= 70 ? 'good' : ($record->percentage >= 60 ? 'pass' : 'fail'))) }}">
                            {{ $record->percentage }}%
                        </span>
                    </td>
                    <td>{{ $record->evaluation }}</td>
                    <td>{{ $record->notes ?? '-' }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.enhanced-exams.edit', $record->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.enhanced-exams.destroy', $record->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا السجل؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px;">
                        <div style="color: rgba(255, 255, 255, 0.7);">
                            <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px;"></i>
                            <p>لا توجد سجلات امتحانات</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($examRecords->hasPages())
    <div class="pagination">
        {{ $examRecords->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userSearch = document.getElementById('user_search');
        const userSearchResults = document.getElementById('user_search_results');
        const userIdInput = document.getElementById('user_id');

        if (userSearch) {
            userSearch.addEventListener('input', function() {
                const query = this.value.trim();

                if (query.length < 2) {
                    userSearchResults.style.display = 'none';
                    return;
                }

                // إرسال طلب AJAX للبحث
                fetch(`/admin/users/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        userSearchResults.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(user => {
                                const item = document.createElement('div');
                                item.className = 'search-result-item';
                                item.textContent = user.full_name;
                                item.addEventListener('click', function() {
                                    userSearch.value = user.full_name;
                                    userIdInput.value = user.id;
                                    userSearchResults.style.display = 'none';
                                });
                                userSearchResults.appendChild(item);
                            });
                            userSearchResults.style.display = 'block';
                        } else {
                            userSearchResults.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            // إخفاء النتائج عند النقر خارج البحث
            document.addEventListener('click', function(e) {
                if (!userSearch.contains(e.target) && !userSearchResults.contains(e.target)) {
                    userSearchResults.style.display = 'none';
                }
            });
        }
    });
</script>
@endsection