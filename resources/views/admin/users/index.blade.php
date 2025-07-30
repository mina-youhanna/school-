@extends('layouts.app')

@section('title', 'إدارة المستخدمين')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin-users.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Golden Titles and Right-Aligned Data - Applied to entire page */
    .golden-title {
        color: #FFD700 !important;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        font-weight: 700;
    }

    .golden-text {
        color: #FFD700 !important;
        font-weight: 600;
    }

    /* Page Headers - Golden */
    .page-header h1,
    .page-header h2,
    .page-header h3,
    .section-title,
    .card-header h3,
    .modal-title {
        color: #FFD700 !important;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        font-weight: 700;
    }

    /* Filter Labels - Golden */
    .filter-label,
    .form-label,
    .form-group label {
        color: #FFD700 !important;
        font-weight: 600;
    }

    /* Statistics Cards - Golden Titles */
    .stat-card .stat-label {
        color: #FFD700 !important;
        font-weight: 600;
    }

    /* Pagination - Golden */
    .pagination-info {
        color: #FFD700 !important;
        font-weight: 600;
    }

    /* Table Headers - Golden */
    .table-header th,
    .table thead th {
        color: #FFD700 !important;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        font-weight: 700;
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border: none;
        padding: 15px 10px;
        text-align: center;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    /* Data Alignment - Right to Left */
    .table td {
        text-align: right;
        vertical-align: middle;
        padding: 12px 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* User Name and Phone - Right Aligned */
    .user-name {
        text-align: right;
        direction: rtl;
    }

    .user-name .name {
        font-weight: 600;
        color: #fff;
        margin-bottom: 5px;
    }

    .user-name .phone {
        font-size: 12px;
        color: #ccc;
    }

    /* Email - Right Aligned */
    .user-email {
        text-align: right;
        direction: rtl;
    }

    /* Type and Age - Right Aligned */
    .user-type,
    .user-age {
        text-align: center;
    }

    /* Role - Right Aligned */
    .user-role {
        text-align: center;
    }

    /* Class - Right Aligned */
    .user-class {
        text-align: center;
    }

    /* Date - Right Aligned and Hide White Icon */
    .user-date {
        text-align: right;
        direction: rtl;
        position: relative;
    }

    .user-date .date-main {
        font-weight: 600;
        color: #fff;
    }

    .user-date .date-relative {
        font-size: 12px;
        color: #ccc;
    }

    /* Hide White Icon on Date - More Specific */
    .user-date::before,
    .user-date::after,
    .user-date i,
    .user-date .icon,
    .user-date .date-icon {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
    }

    /* Actions - Right Aligned */
    .user-actions {
        text-align: center;
    }

    /* Overall Page Styling */
    .admin-users-page {
        direction: rtl;
        text-align: right;
    }

    /* Table Container */
    .table-container {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
        background: transparent;
    }

    .table tbody tr {
        background: rgba(255, 255, 255, 0.05);
        transition: background 0.3s ease;
    }

    .table tbody tr:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* Modal Headers - Golden */
    .modal-header h5 {
        color: #FFD700 !important;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        font-weight: 700;
    }

    /* Form Labels - Golden */
    .form-group label {
        color: #FFD700 !important;
        font-weight: 600;
    }

    /* Additional Golden Elements */
    .header-title h1,
    .header-title p,
    .filter-section h4,
    .stats-section h3 {
        color: #FFD700 !important;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        font-weight: 700;
    }

    /* Responsive Design */
    @media (max-width: 768px) {

        .table td,
        .table th {
            padding: 8px 5px;
            font-size: 12px;
        }

        .user-name .name {
            font-size: 14px;
        }

        .user-name .phone {
            font-size: 11px;
        }
    }

    /* Force Hide Any White Icons on Date */
    .user-date * {
        color: inherit !important;
    }

    .user-date .icon,
    .user-date i,
    .user-date::before,
    .user-date::after {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        width: 0 !important;
        height: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
    }
</style>
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
                    <label for="is_deacon"><i class="fas fa-cross"></i> الشماسية</label>
                    <select class="modern-form-select" id="is_deacon" name="is_deacon">
                        <option value="">جميع المستخدمين</option>
                        <option value="1" {{ request('is_deacon') == '1' ? 'selected' : '' }}>شماس</option>
                        <option value="0" {{ request('is_deacon') == '0' ? 'selected' : '' }}>ليس شماس</option>
                    </select>
                </div>

                <div class="modern-filter-group">
                    <label for="deacon_rank"><i class="fas fa-crown"></i> رتبة الشماسية</label>
                    <select class="modern-form-select" id="deacon_rank" name="deacon_rank">
                        <option value="">جميع الرتب</option>
                        <option value="شماس إنجيلي" {{ request('deacon_rank') == 'شماس إنجيلي' ? 'selected' : '' }}>شماس إنجيلي</option>
                        <option value="شماس إبصالتوس" {{ request('deacon_rank') == 'شماس إبصالتوس' ? 'selected' : '' }}>شماس إبصالتوس</option>
                        <option value="شماس أناغنوستيس" {{ request('deacon_rank') == 'شماس أناغنوستيس' ? 'selected' : '' }}>شماس أناغنوستيس</option>
                        <option value="شماس إيبودياكون" {{ request('deacon_rank') == 'شماس إيبودياكون' ? 'selected' : '' }}>شماس إيبودياكون</option>
                        <option value="شماس دياكون" {{ request('deacon_rank') == 'شماس دياكون' ? 'selected' : '' }}>شماس دياكون</option>
                        <option value="شماس أرشدياكون" {{ request('deacon_rank') == 'شماس أرشدياكون' ? 'selected' : '' }}>شماس أرشدياكون</option>
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
                        <option value="dob" {{ request('sort_by') == 'dob' ? 'selected' : '' }}>تاريخ الميلاد</option>
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
                <div class="table-scroll-wrapper">
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>النوع</th>
                                <th>السن</th>
                                <th>الدور</th>
                                <th>الشماسية</th>
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
                                    @if($user->dob)
                                    <span class="age-number">{{ Carbon\Carbon::parse($user->dob)->age }}</span>
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

                                <td class="user-deacon">
                                    @if($user->is_deacon)
                                    <div class="deacon-info">
                                        <span class="badge badge-deacon">
                                            <i class="fas fa-cross"></i>
                                            شماس
                                        </span>
                                        @if($user->deacon_rank)
                                        <div class="deacon-rank">
                                            @switch($user->deacon_rank)
                                            @case('شماس إنجيلي')
                                            <span class="badge badge-evangelist">إنجيلي</span>
                                            @break
                                            @case('شماس إبصالتوس')
                                            <span class="badge badge-epsaltos">إبصالتوس</span>
                                            @break
                                            @case('شماس أناغنوستيس')
                                            <span class="badge badge-anagnostis">أناغنوستيس</span>
                                            @break
                                            @case('شماس إيبودياكون')
                                            <span class="badge badge-ipodiakon">إيبودياكون</span>
                                            @break
                                            @case('شماس دياكون')
                                            <span class="badge badge-diakon">دياكون</span>
                                            @break
                                            @case('شماس أرشدياكون')
                                            <span class="badge badge-archdiakon">أرشدياكون</span>
                                            @break
                                            @default
                                            <span class="badge badge-deacon-rank">{{ $user->deacon_rank }}</span>
                                            @endswitch
                                        </div>
                                        @endif
                                    </div>
                                    @else
                                    <span class="badge badge-not-deacon">
                                        <i class="fas fa-user"></i>
                                        ليس شماس
                                    </span>
                                    @endif
                                </td>

                                <td class="user-class">
                                    @if($user->my_class_id && $user->studyClass)
                                    <span class="class-badge">
                                        <i class="fas fa-graduation-cap"></i>
                                        {{ $user->studyClass->name }} - {{ $user->studyClass->stage }}
                                    </span>
                                    @else
                                    <span class="class-unknown">
                                        <i class="fas fa-question-circle"></i>
                                        غير محدد
                                    </span>
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
                                                data-current-class="{{ $user->my_class_id }}"
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
<script src="{{ asset('js/admin-users.js') }}"></script>
@endpush
