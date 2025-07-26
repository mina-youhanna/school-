@extends('layouts.app')

@section('title', 'مكتبة الألحان')

@section('content')
<style>
.hymns-header {
    text-align: center;
    margin: 40px 0 20px 0;
}
.hymns-title {
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 2.7rem;
    color: #ffd700;
    text-shadow: 0 2px 12px #ffd70099, 0 2px 8px #0a234f44;
    margin-bottom: 0;
}
.hymns-search-bar {
    display: flex;
    justify-content: center;
    margin: 30px 0 20px 0;
    gap: 12px;
}
.hymns-search-bar input {
    padding: 10px 18px;
    border-radius: 12px;
    border: 2px solid #ffd700;
    font-size: 1.1rem;
    min-width: 220px;
    background: #fffbe6;
    color: #0a234f;
}
.hymns-search-bar select {
    padding: 10px 14px;
    border-radius: 12px;
    border: 2px solid #ffd700;
    font-size: 1.1rem;
    background: #fffbe6;
    color: #0a234f;
}
.hymns-list {
    max-width: 900px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 18px;
}
.hymn-card {
    background: rgba(10,35,79,0.92);
    border: 2px solid #ffd700;
    border-radius: 18px;
    padding: 22px 18px;
    box-shadow: 0 4px 24px #ffd70022;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    transition: box-shadow 0.2s, transform 0.2s;
}
.hymn-card:hover {
    box-shadow: 0 8px 32px #ffd70055;
    transform: translateY(-2px) scale(1.02);
}
.hymn-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.hymn-title {
    font-size: 1.3rem;
    color: #ffd700;
    font-weight: bold;
    margin-bottom: 2px;
}
.hymn-category {
    color: #fffbe6;
    font-size: 1rem;
    opacity: 0.8;
}
.hymn-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}
.hymn-details-btn {
    background: linear-gradient(90deg, #ffd700 60%, #fffbe6 100%);
    color: #0a234f;
    border: none;
    border-radius: 10px;
    padding: 8px 22px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
    box-shadow: 0 2px 8px #ffd70033;
}
.hymn-details-btn:hover {
    background: #0a234f;
    color: #ffd700;
}

/* Modal */
#hymnDetailsModal {
    display: none;
    position: fixed;
    top: 0; left: 0; width: 100vw; height: 100vh;
    background: rgba(0,0,0,0.7);
    z-index: 3000;
    align-items: center;
    justify-content: center;
}
#hymnDetailsModal .modal-content {
    background: #0a234f;
    border-radius: 18px;
    max-width: 600px;
    width: 95vw;
    padding: 32px 24px;
    color: #fff;
    box-shadow: 0 8px 32px #ffd70055;
    position: relative;
}
#hymnDetailsModal .close-modal {
    position: absolute;
    top: 12px; left: 12px;
    background: none;
    border: none;
    color: #ffd700;
    font-size: 2rem;
    cursor: pointer;
}
#hymnDetailsModal .hymn-modal-title {
    color: #ffd700;
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 10px;
    text-align: right;
}
#hymnDetailsModal .hymn-modal-category {
    color: #fffbe6;
    font-size: 1rem;
    margin-bottom: 18px;
    text-align: right;
}
#hymnDetailsModal .hymn-modal-text {
    font-size: 1.1rem;
    color: #fff;
    margin-bottom: 18px;
    text-align: right;
    white-space: pre-line;
}
#hymnDetailsModal .hymn-modal-audio {
    width: 100%;
    margin-bottom: 10px;
}
#hymnDetailsModal .hymn-modal-note {
    margin-top: 10px;
    text-align: right;
}
.hymns-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap: 32px 18px;
    max-width: 1200px;
    margin: 0 auto 40px auto;
    padding: 0 10px;
}
.hymn-card-v2 {
  background: linear-gradient(135deg, #fffbe6 60%, #f7f3e3 100%);
  border-radius: 24px;
  box-shadow: 0 4px 24px #0a234f22, 0 0 0 2.5px #ffd70055;
  overflow: hidden;
  transition: box-shadow 0.25s, transform 0.2s;
  position: relative;
  min-height: 540px;
  display: flex;
  flex-direction: column;
}
.hymn-card-v2:hover {
  box-shadow: 0 12px 40px #ffd70055, 0 0 0 3px #ffd700;
  transform: translateY(-6px) scale(1.03);
}
.hymn-card-img {
  width: 100%;
  height: 340px;
  object-fit: cover;
  border-bottom-left-radius: 24px;
  border-bottom-right-radius: 24px;
}
.hymn-category-badge {
  position: absolute;
  top: 14px;
  left: 14px;
  background: #ffd700;
  color: #0a234f;
  padding: 7px 18px;
  border-radius: 18px 6px 18px 6px;
  font-weight: bold;
  font-size: 1rem;
  box-shadow: 0 2px 8px #ffd70033;
  display: flex;
  align-items: center;
  gap: 6px;
}
.hymn-card-body {
    padding: 22px 16px 18px 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1 1 0;
    text-align: center;
}
.hymn-title-v2 {
  font-family: 'Lalezar', 'Cairo', sans-serif;
  font-size: 1.4rem;
  color: #0a234f;
  font-weight: bold;
  margin: 18px 0 8px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.hymn-title-v2 i {
  color: #ffd700;
  font-size: 1.2em;
}
.hymn-coptic {
    font-family: 'Amiri', serif;
    font-size: 1.15rem;
    color: #7a6c3a;
    margin-bottom: 12px;
    margin-top: 0;
    letter-spacing: 1px;
}
.hymn-details-btn-v2 {
  background: linear-gradient(90deg, #ffd700 60%, #fffbe6 100%);
  color: #0a234f;
  border: none;
  border-radius: 18px;
  padding: 12px 32px;
  font-size: 1.1rem;
  font-weight: bold;
  margin-top: 18px;
  box-shadow: 0 2px 8px #ffd70033;
  transition: background 0.2s, color 0.2s, transform 0.1s;
}
.hymn-details-btn-v2:hover {
  background: #0a234f;
  color: #ffd700;
  transform: scale(1.05);
}
</style>

<div class="hymns-header">
    <h1 class="hymns-title">مكتبة الألحان الكنسية</h1>
    <p style="color:#fffbe6;opacity:0.8;">ابحث عن لحن أو تصفح حسب المناسبة</p>
</div>
<div class="hymns-search-bar">
    <input type="text" id="hymnSearchInput" placeholder="ابحث باسم اللحن..." oninput="filterHymnsV2()">
    <select id="hymnCategorySelect" onchange="filterHymnsV2()">
        <option value="">كل التصنيفات</option>
    </select>
</div>
<div class="hymns-grid" id="hymnsGrid"></div>

<script>
window.hymns = {!! $hymns->map(function($h) {
    $category = '';
    if ($h->breadcrumb) {
        $parts = explode('>', $h->breadcrumb);
        $category = trim(end($parts));
    }
    return [
        'id' => $h->id,
        'title' => $h->title, // العنوان كما هو (ثلاث سطور أو سطر واحد)
        'category' => $category,
        'image' => $h->image_url ?: '/images/hymns/default.jpg',
    ];
})->toJson(JSON_UNESCAPED_UNICODE) !!};

window.getHymnCategories = function() {
    const cats = window.hymns.map(h => h.category);
    return [...new Set(cats)];
}

function fillHymnCategories() {
    const select = document.getElementById('hymnCategorySelect');
    select.innerHTML = '<option value="">كل التصنيفات</option>';
    const cats = window.getHymnCategories();
    cats.forEach(cat => {
        const opt = document.createElement('option');
        opt.value = cat;
        opt.textContent = cat;
        select.appendChild(opt);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    fillHymnCategories();
    filterHymnsV2();
});

window.filterHymnsV2 = function() {
    const search = document.getElementById('hymnSearchInput').value.trim().toLowerCase();
    const cat = document.getElementById('hymnCategorySelect').value;
    const grid = document.getElementById('hymnsGrid');
    grid.innerHTML = '';
    let filtered = window.hymns.filter(h =>
        (!search || h.title.toLowerCase().includes(search)) &&
        (!cat || h.category === cat)
    );
    if(filtered.length === 0) {
        grid.innerHTML = '<div style="color:#ffd700;text-align:center;grid-column:1/-1;">لا توجد ألحان مطابقة</div>';
        return;
    }
    filtered.forEach(h => {
        const card = document.createElement('div');
        card.className = 'hymn-card-v2';
        card.innerHTML = `
            <div style='position:relative;'>
                <img src='${h.image}' alt='${h.title}' class='hymn-card-img'>
                <div class='hymn-category-badge'>${h.category}</div>
            </div>
            <div class='hymn-card-body'>
                <div class='hymn-title-v2' style="white-space:pre-line;">${h.title}</div>
                <a href='/hymns/${h.id}' class='hymn-details-btn-v2'>تصفح اللحن</a>
            </div>
        `;
        grid.appendChild(card);
    });
}
</script>
@endsection 