@extends('layouts.app')

@section('title', 'الفصول الدراسية')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lalezar&display=swap');

.classes-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.page-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 40px 20px;
    background: linear-gradient(135deg, #0a234f 0%, #1e3a8a 100%);
    border-radius: 20px;
    color: white;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset('images/coptic-pattern.png') }}') repeat;
    opacity: 0.1;
    animation: patternFloat 60s linear infinite;
}

.page-title {
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 3rem;
    font-weight: 800;
    color: #ffd700;
    margin-bottom: 15px;
    text-shadow: 0 2px 12px rgba(255, 215, 0, 0.3);
    position: relative;
    z-index: 2;
}

.page-subtitle {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 0;
    position: relative;
    z-index: 2;
}

.gender-tabs {
    display: flex;
    justify-content: center;
    margin-bottom: 40px;
    gap: 20px;
}

.gender-tab {
    padding: 15px 30px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid transparent;
    border-radius: 50px;
    color: white;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    cursor: pointer;
    backdrop-filter: blur(10px);
}

.gender-tab:hover {
    background: rgba(255, 215, 0, 0.2);
    border-color: #ffd700;
    color: #ffd700;
    transform: translateY(-2px);
}

.gender-tab.active {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #0a234f;
    border-color: #ffd700;
    box-shadow: 0 4px 20px rgba(255, 215, 0, 0.3);
}

.stage-filter {
    display: flex;
    justify-content: center;
    margin-bottom: 40px;
    gap: 15px;
    flex-wrap: wrap;
}

.stage-btn {
    padding: 12px 25px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid transparent;
    border-radius: 25px;
    color: white;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    cursor: pointer;
    backdrop-filter: blur(10px);
}

.stage-btn:hover {
    background: rgba(255, 215, 0, 0.2);
    border-color: #ffd700;
    color: #ffd700;
    transform: translateY(-2px);
}

.stage-btn.active {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #0a234f;
    border-color: #ffd700;
    box-shadow: 0 4px 20px rgba(255, 215, 0, 0.3);
}

.classes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.class-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 3px solid transparent;
    position: relative;
    overflow: hidden;
}

.class-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #ffd700, #ffed4a);
}

.class-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    border-color: #ffd700;
}

.class-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.class-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #0a234f, #1e3a8a);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 15px;
    color: #ffd700;
    font-size: 1.5rem;
}

.class-info {
    flex: 1;
}

.class-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: #0a234f;
    margin-bottom: 5px;
}

.class-stage {
    font-size: 1rem;
    color: #666;
    font-weight: 500;
}

.class-details {
    margin-bottom: 20px;
}

.detail-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    font-size: 0.95rem;
    color: #555;
}

.detail-item i {
    margin-left: 10px;
    color: #ffd700;
    width: 20px;
    text-align: center;
}

.class-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 20px;
}

.stat-item {
    text-align: center;
    padding: 15px;
    background: rgba(10, 35, 79, 0.05);
    border-radius: 10px;
    border: 1px solid rgba(10, 35, 79, 0.1);
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0a234f;
    display: block;
}

.stat-label {
    font-size: 0.85rem;
    color: #666;
    margin-top: 5px;
}

.class-actions {
    display: flex;
    gap: 10px;
}

.btn {
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-align: center;
    flex: 1;
}

.btn-primary {
    background: linear-gradient(45deg, #0a234f, #1e3a8a);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #1e3a8a, #0a234f);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(10, 35, 79, 0.3);
}

.btn-secondary {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #0a234f;
}

.btn-secondary:hover {
    background: linear-gradient(45deg, #ffed4a, #ffd700);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.empty-state i {
    font-size: 4rem;
    color: #ddd;
    margin-bottom: 20px;
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #999;
}

.loading {
    text-align: center;
    padding: 40px;
    color: #666;
}

.loading i {
    font-size: 2rem;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes patternFloat {
    0% { background-position: 0 0; }
    100% { background-position: 300px 300px; }
}

@media (max-width: 768px) {
    .classes-grid {
        grid-template-columns: 1fr;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .gender-tabs {
        flex-direction: column;
        align-items: center;
    }
    
    .class-card {
        padding: 20px;
    }
}
</style>

<div class="classes-container">
    <div class="page-header">
        <h1 class="page-title">📚 الفصول الدراسية</h1>
        <p class="page-subtitle">اكتشف فصول مدرسة الأحد واختر الفصل المناسب لك</p>
    </div>

    <div class="gender-tabs">
        <button class="gender-tab active" onclick="showClasses('male')">
            👦 فصول الأولاد
        </button>
        <button class="gender-tab" onclick="showClasses('female')">
            👧 فصول البنات
        </button>
    </div>

    <div class="stage-filter" style="display: none;" id="stage-filter">
        <button class="stage-btn active" onclick="filterByStage('all')">جميع المراحل</button>
        <button class="stage-btn" onclick="filterByStage('A3')">A3</button>
        <button class="stage-btn" onclick="filterByStage('A2')">A2</button>
        <button class="stage-btn" onclick="filterByStage('A1')">A1</button>
        <button class="stage-btn" onclick="filterByStage('B3')">B3</button>
        <button class="stage-btn" onclick="filterByStage('B2')">B2</button>
        <button class="stage-btn" onclick="filterByStage('B1')">B1</button>
        <button class="stage-btn" onclick="filterByStage('تمهيدي2')">تمهيدي 2</button>
        <button class="stage-btn" onclick="filterByStage('تمهيدي1')">تمهيدي 1</button>
        <button class="stage-btn" onclick="filterByStage('خاص')">خاص</button>
        <button class="stage-btn" onclick="filterByStage('الخدام')">الخدام</button>
    </div>

    <div id="classes-content">
        <div class="loading">
            <i class="fas fa-spinner"></i>
            <p>جاري تحميل الفصول...</p>
        </div>
    </div>
</div>

<script>
let allClasses = [];
let currentGender = 'male';

// تحميل البيانات عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/classes')
        .then(response => response.json())
        .then(data => {
            allClasses = data;
            showClasses('male');
        })
        .catch(error => {
            console.error('Error loading classes:', error);
            document.getElementById('classes-content').innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>حدث خطأ في تحميل الفصول</h3>
                    <p>يرجى المحاولة مرة أخرى</p>
                </div>
            `;
        });
});

function showClasses(gender) {
    currentGender = gender;
    // تحديث التبويبات
    document.querySelectorAll('.gender-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    event.target.classList.add('active');
    // إظهار مرشح المراحل
    document.getElementById('stage-filter').style.display = 'flex';
    // فلترة الفصول حسب النوع
    const filtered = allClasses.filter(cls => cls.gender === (gender === 'male' ? 'ذكر' : 'أنثى'));
    displayClasses(filtered);
}

function filterByStage(stage) {
    document.querySelectorAll('.stage-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    // فلترة حسب النوع أولاً ثم المرحلة
    const filtered = allClasses.filter(cls => cls.gender === (currentGender === 'male' ? 'ذكر' : 'أنثى'));
    const filteredByStage = stage === 'all' ? filtered : filtered.filter(cls => cls.stage === stage);
    displayClasses(filteredByStage);
}

function displayClasses(classes) {
    const contentDiv = document.getElementById('classes-content');
    
    if (!classes || classes.length === 0) {
        contentDiv.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h3>لا توجد فصول متاحة</h3>
                <p>سيتم إضافة الفصول قريباً</p>
            </div>
        `;
        return;
    }
    
    const classesHtml = classes.map(classItem => `
        <div class="class-card">
            <div class="class-header">
                <div class="class-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="class-info">
                    <div class="class-name">${classItem.name}</div>
                    <div class="class-stage">${classItem.stage}</div>
                </div>
            </div>
            
            <div class="class-details">
                <div class="detail-item">
                    <i class="fas fa-clock"></i>
                    <span>الموعد: ${classItem.schedule || 'غير محدد'}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>المكان: ${classItem.place || 'غير محدد'}</span>
                </div>
            </div>
            
            <div class="class-stats">
                <div class="stat-item">
                    <span class="stat-number">${classItem.students_count || 0}</span>
                    <span class="stat-label">الطلاب</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">${classItem.servants_count || 0}</span>
                    <span class="stat-label">الخدام</span>
                </div>
            </div>
            
            <div class="class-actions">
                <a href="/classes/${classItem.id}/details" class="btn btn-primary">
                    <i class="fas fa-info-circle"></i> التفاصيل
                </a>
                <a href="/classes/${classItem.id}/attendance" class="btn btn-secondary">
                    <i class="fas fa-clipboard-check"></i> الحضور
                </a>
            </div>
        </div>
    `).join('');
    
    contentDiv.innerHTML = `<div class="classes-grid">${classesHtml}</div>`;
}
</script>
@endsection 