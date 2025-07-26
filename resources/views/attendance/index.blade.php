@extends('layouts.app')

@section('title', 'سجل الحضور والغياب')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">سجل الحضور والغياب</h3>
                </div>
                <div class="card-body">
                    <!-- إحصائيات سريعة -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="stats-card bg-success text-white p-3 rounded">
                                <h4>نسبة الحضور</h4>
                                <h2>{{ $attendancePercentage ?? 0 }}%</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card bg-info text-white p-3 rounded">
                                <h4>أيام الحضور</h4>
                                <h2>{{ $presentDays ?? 0 }}</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card bg-danger text-white p-3 rounded">
                                <h4>أيام الغياب</h4>
                                <h2>{{ $absentDays ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>

                    <!-- جدول الحضور -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>التاريخ</th>
                                    <th>الحالة</th>
                                    <th>ملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendanceRecords ?? [] as $record)
                                <tr>
                                    <td>{{ $record->date->format('Y-m-d') }}</td>
                                    <td>
                                        @if($record->status == 'present')
                                            <span class="badge bg-success">حاضر</span>
                                        @else
                                            <span class="badge bg-danger">غائب</span>
                                        @endif
                                    </td>
                                    <td>{{ $record->notes }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">لا توجد سجلات حضور</td>
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
.stats-card {
    transition: transform 0.3s ease;
    text-align: center;
}

.stats-card:hover {
    transform: translateY(-5px);
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
</style>
@endsection 