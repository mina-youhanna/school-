@extends('layouts.app')

@section('title', 'الفصول الدراسية')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<style>
.dropdown-menu {
    background-color: #0A2A4F !important;
    border: 1px solid #FFD700 !important;
    text-align: right !important;
}

body {
    margin: 0;
    padding: 0;
    background-color: #0A2A4F;
    background-size: 300px;
    background-repeat: repeat;
    background-blend-mode: multiply;
    font-family: 'Tajawal', sans-serif;
    text-align: center;
    direction: rtl;
    color: #ffffff;
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: -1;
}

.main-title {
    font-size: 44px;
    font-weight: bold;
    color: #FFD700;
    margin-top: 40px;
    margin-bottom: 80px;
    padding: 15px 25px;
    border-bottom: 4px solid #FFD700;
    display: inline-block;
    background: rgba(255, 215, 0, 0.2);
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(255, 215, 0, 0.5);
}

.container {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
    margin-top: 40px;
}

.card {
    width: 340px;
    background: rgba(20, 50, 90, 0.95);
    border: 3px solid #FFD700;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s, box-shadow 0.3s;
    padding-bottom: 15px;
    position: relative;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 0 30px 5px #FFD700, 0 0 15px 5px #FFD700;
}

.image-container {
    width: 280px;
    height: 280px;
    margin: 20px auto 10px;
    border-radius: 50%;
    overflow: hidden;
    border: 5px solid #FFD700;
    transition: transform 0.3s;
    position: relative;
    user-select: none;
}

.image-container img {
    width: 100%;
    height: 130%;
    object-fit: cover;
    transition: transform 0.4s;
    pointer-events: none;
}

.image-container:hover img {
    transform: scale(1.1);
}

.card-title {
    font-size: 26px;
    font-weight: bold;
    color: #FFD700;
    text-shadow: 0px 0px 8px rgba(255, 215, 0, 0.8);
    margin-bottom: 10px;
}

.card-text {
    color: #f0f0f0;
    font-size: 18px;
    line-height: 1.8;
    padding: 0 15px;
}

.card-text strong {
    color: #FFD700;
}

.card:hover {
    transform: scale(1.05) !important;
    box-shadow: 0 0 30px 5px #FFD700, 0 0 15px 5px #FFD700 !important;
}

.image-container:hover img {
    transform: scale(1.1) !important;
}

.main-title {
    font-size: 44px !important;
    font-weight: bold !important;
    color: #FFD700 !important;
    border-bottom: 4px solid #FFD700 !important;
    background: rgba(255, 215, 0, 0.2) !important;
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
    margin: 5px;
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
    color: #f0f0f0;
}

.empty-state i {
    font-size: 4rem;
    color: #FFD700;
    margin-bottom: 20px;
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #FFD700;
}

.empty-state p {
    color: #f0f0f0;
}

.loading {
    text-align: center;
    padding: 40px;
    color: #f0f0f0;
}

.loading i {
    font-size: 2rem;
    animation: spin 1s linear infinite;
    color: #FFD700;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.class-actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}
</style>

<div class="container">
    <h1 class="main-title">فصول المدرسة</h1>
    
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
    document.querySelectorAll('.gender-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    event.target.classList.add('active');
    document.getElementById('stage-filter').style.display = 'flex';
    const filtered = allClasses.filter(cls => cls.gender === (gender === 'male' ? 'ذكر' : 'أنثى'));
    displayClasses(filtered);
}

function filterByStage(stage) {
    document.querySelectorAll('.stage-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
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
        <div class="card">
            <div class="image-container">
                <img src="${classItem.saint_image}" alt="${classItem.name}">
            </div>
            
            <div class="card-body">
                <h5 class="card-title">${classItem.name}</h5>
                
                <div class="card-text">
                    <strong>المرحلة:</strong> ${classItem.stage}<br>
                    <strong>النوع:</strong> ${classItem.gender || 'غير محدد'}<br>
                    <strong>الجدول:</strong> ${classItem.schedule || 'غير محدد'}<br>
                    <strong>المكان:</strong> ${classItem.place || 'غير محدد'}<br>
                    <strong>الطلاب:</strong> ${classItem.students_count || 0}<br>
                    <strong>الخدام:</strong> ${classItem.servants_count || 0}
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
        </div>
    `).join('');
    
    contentDiv.innerHTML = `<div class="container">${classesHtml}</div>`;
}
</script>
@endsection 