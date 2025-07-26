@extends('layouts.app')

@section('title', 'الامتحانات والدرجات')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- قسم الامتحانات المتاحة -->
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">الامتحانات المتاحة</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($availableExams ?? [] as $exam)
                        <div class="col-md-6 mb-3">
                            <div class="exam-card p-3 border rounded">
                                <h4>{{ $exam->title }}</h4>
                                <p class="text-muted">{{ $exam->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-info">الوقت: {{ $exam->duration }} دقيقة</span>
                                    <a href="{{ route('exams.take', $exam->id) }}" class="btn btn-primary">ابدأ الامتحان</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <p class="text-center">لا توجد امتحانات متاحة حالياً</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- قسم النتائج السابقة -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">النتائج السابقة</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>الامتحان</th>
                                    <th>التاريخ</th>
                                    <th>الدرجة</th>
                                    <th>النسبة المئوية</th>
                                    <th>الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($examResults ?? [] as $result)
                                <tr>
                                    <td>{{ $result->exam->title }}</td>
                                    <td>{{ $result->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $result->score }}/{{ $result->exam->total_marks }}</td>
                                    <td>{{ ($result->score / $result->exam->total_marks) * 100 }}%</td>
                                    <td>
                                        @if(($result->score / $result->exam->total_marks) * 100 >= 60)
                                            <span class="badge bg-success">ناجح</span>
                                        @else
                                            <span class="badge bg-danger">راسب</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">لا توجد نتائج سابقة</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.exam-card {
    transition: all 0.3s ease;
    background: #fff;
}

.exam-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.table {
    direction: rtl;
}

.table th {
    font-weight: bold;
}

.badge {
    padding: 8px 12px;
    font-size: 0.9em;
}

.btn-primary {
    background: #0A2A4F;
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #FFD700;
    color: #0A2A4F;
    transform: translateY(-2px);
}
</style>
@endsection 