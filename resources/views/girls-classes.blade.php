@extends('layouts.app')

@section('title', 'فصول البنات')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lalezar&display=swap');

.girls-classes-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.page-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 40px 20px;
    background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
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

.search-section {
    margin-bottom: 30px;
    display: flex;
    justify-content: center;
}

.search-container {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 50px;
    padding: 5px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 100%;
}

.search-input {
    flex: 1;
    border: none;
    outline: none;
    padding: 15px 20px;
    font-size: 1rem;
    background: transparent;
    color: #0a234f;
    direction: rtl;
}

.search-input::placeholder {
    color: #999;
    font-style: italic;
}

.search-btn {
    background: linear-gradient(45deg, #e91e63, #c2185b);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 15px 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.search-btn:hover {
    background: linear-gradient(45deg, #c2185b, #e91e63);
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(233, 30, 99, 0.3);
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
    color: #c2185b;
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
    background: linear-gradient(90deg, #e91e63, #c2185b);
}

.class-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    border-color: #e91e63;
}

.class-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.class-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #e91e63, #c2185b);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 15px;
    color: white;
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
    color: #e91e63;
    width: 20px;
    text-align: center;
}

.servants-list {
    margin-bottom: 20px;
}

.servants-title {
    font-weight: 600;
    color: #0a234f;
    margin-bottom: 10px;
    font-size: 0.95rem;
}

.servants-names {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
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
    background: linear-gradient(45deg, #e91e63, #c2185b);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #c2185b, #e91e63);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
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
    
    .stage-filter {
        flex-direction: column;
        align-items: center;
    }
    
    .class-card {
        padding: 20px;
    }
}
</style>

<div class="girls-classes-container">
    <div class="page-header">
        <h1 class="page-title">👧 فصول البنات</h1>
        <p class="page-subtitle">فصول مدرسة الأحد للبنات</p>
    </div>

    <div class="search-section">
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="ابحث باسم الفصل أو اسم الخادم..." class="search-input">
            <button onclick="performSearch()" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="stage-filter">
        <button class="stage-btn active" onclick="filterByStage('all')">جميع المراحل</button>
        <button class="stage-btn" onclick="filterByStage('B3')">B3</button>
        <button class="stage-btn" onclick="filterByStage('B2')">B2</button>
        <button class="stage-btn" onclick="filterByStage('B1')">B1</button>
        <button class="stage-btn" onclick="filterByStage('A2')">A2</button>
        <button class="stage-btn" onclick="filterByStage('A1')">A1</button>
        <button class="stage-btn" onclick="filterByStage('تمهيدي2')">تمهيدي 2</button>
        <button class="stage-btn" onclick="filterByStage('تمهيدي1')">تمهيدي 1</button>
        <button class="stage-btn" onclick="filterByStage('خاص')">خاص</button>
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
let currentStage = 'all';
let currentSearch = '';

// تحميل البيانات عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    loadClasses();
    
    // إضافة مستمع للبحث عند الكتابة
    document.getElementById('searchInput').addEventListener('input', function() {
        currentSearch = this.value;
        performSearch();
    });
    
    // إضافة مستمع للبحث عند الضغط على Enter
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
});

function loadClasses() {
    const contentDiv = document.getElementById('classes-content');
    contentDiv.innerHTML = `
        <div class="loading">
            <i class="fas fa-spinner"></i>
            <p>جاري تحميل الفصول...</p>
        </div>
    `;
    
    fetch('/api/classes/female')
        .then(response => response.json())
        .then(data => {
            allClasses = data;
            displayClasses(data);
        })
        .catch(error => {
            console.error('Error loading classes:', error);
            contentDiv.innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>حدث خطأ في تحميل الفصول</h3>
                    <p>يرجى المحاولة مرة أخرى</p>
                </div>
            `;
        });
}

function filterByStage(stage) {
    currentStage = stage;
    
    // تحديث الأزرار
    document.querySelectorAll('.stage-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // تصفية الفصول
    const filteredClasses = stage === 'all' 
        ? allClasses 
        : allClasses.filter(classItem => classItem.stage === stage);
    
    displayClasses(filteredClasses);
}

function displayClasses(classes) {
    const contentDiv = document.getElementById('classes-content');
    
    if (!classes || classes.length === 0) {
        contentDiv.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h3>لا توجد فصول متاحة</h3>
                <p>لا توجد فصول في هذه المرحلة</p>
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
            
            <div class="servants-list">
                <div class="servants-title">الخدام:</div>
                <div class="servants-names">${classItem.servants ? classItem.servants.join('، ') : 'غير محدد'}</div>
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