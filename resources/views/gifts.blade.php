@extends('layouts.app')
@section('title', 'معرض الهدايا')
@section('content')

<!-- Subscription Check Modal -->
<div id="subscriptionModal" class="modal-gift-admin" style="display:none;">
    <div class="modal-content" style="min-width:400px;max-width:600px;">
        <span class="close-modal" onclick="closeSubscriptionModal()">&times;</span>
        <h2 style="color:#ffd700;text-align:center;margin-bottom:20px;">تنبيه الاشتراك</h2>
        <div style="text-align:center;color:#fff;font-size:1.1rem;line-height:1.6;margin-bottom:25px;">
            <i class="fas fa-exclamation-triangle" style="color:#ffd700;font-size:2rem;margin-bottom:15px;display:block;"></i>
            <p>برجاء دفع قيمة الاشتراك لخادم الفصل المسؤول لدخول المعرض</p>
            <p style="color:#ffd700;font-weight:bold;margin-top:10px;">قيمة الاشتراك: 80 جنيه سنوياً</p>
            <p style="color:#ffd700;font-size:0.9rem;margin-top:5px;">تاريخ انتهاء الاشتراك: 11 سبتمبر من كل عام</p>
        </div>
        <div style="text-align:center;">
            <button onclick="closeSubscriptionModal()" style="background:#ffd700;color:#0a234f;border:none;padding:10px 25px;border-radius:20px;font-weight:bold;cursor:pointer;">حسناً</button>
        </div>
    </div>
</div>
<style>
.gifts-header {
    text-align: center;
    margin: 40px 0 30px 0;
}
.gifts-title {
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 2.7rem;
    color: #ffd700;
    text-shadow: 0 2px 12px #ffd70099, 0 2px 8px #0a234f44;
    margin-bottom: 10px;
}
.gifts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap: 32px 24px;
    max-width: 1200px;
    margin: 0 auto 40px auto;
}
.gift-card {
    background: linear-gradient(135deg, rgba(10,35,79,0.95) 60%, rgba(255,215,0,0.10) 100%);
    border-radius: 22px;
    box-shadow: 0 4px 32px #0a234f22, 0 0 0 3px #ffd70033;
    padding: 32px 18px 24px 18px;
    text-align: center;
    position: relative;
    border: 1.5px solid #ffd70055;
    transition: transform 0.25s, box-shadow 0.25s, background 0.25s;
    cursor: pointer;
    overflow: hidden;
}
.gift-card:hover {
    transform: translateY(-8px) scale(1.04);
    box-shadow: 0 12px 40px #ffd70044, 0 2px 18px #0a234f22;
}
.gift-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 16px;
    margin-bottom: 18px;
    border: 2.5px solid #ffd700;
    background: #fffbe6;
    box-shadow: 0 4px 18px #ffd70033;
}
.gift-name {
    color: #ffd700;
    font-size: 1.3rem;
    font-weight: bold;
    margin-bottom: 8px;
}
.gift-points {
    color: #fff;
    font-size: 1.1rem;
    margin-bottom: 6px;
}
.gift-qty {
    color: #fffbe6;
    font-size: 1rem;
    margin-bottom: 12px;
}
.gift-btn {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #1e3c72;
    text-decoration: none;
    padding: 10px 28px;
    border-radius: 25px;
    font-size: 1.05rem;
    font-weight: bold;
    transition: all 0.3s;
    box-shadow: 0 4px 15px #ffd70044;
    border: 2px solid transparent;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 8px;
}
.gift-btn:disabled {
    background: #ccc;
    color: #888;
    cursor: not-allowed;
}
.gift-btn:hover:not(:disabled) {
    background: linear-gradient(45deg, #fffbe6, #ffd700);
    color: #0a234f;
    border-color: #1e3c72;
    transform: translateY(-2px) scale(1.04);
}
.gifts-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-bottom: 18px;
}
.gifts-actions button, .gifts-actions a {
    background: linear-gradient(135deg, #ffd700 0%, #e6c200 100%);
    color: #0a234f;
    border: none;
    padding: 8px 15px;
    border-radius: 20px;
    cursor: pointer;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
    font-size: 1rem;
    text-decoration: none;
}
.gifts-actions button:hover, .gifts-actions a:hover {
    background: #0a234f;
    color: #ffd700;
    border: 2px solid #ffd700;
}
.gift-admin-btn {
    background: linear-gradient(135deg, #ffd700 0%, #e6c200 100%);
    color: #0a234f;
    border: none;
    padding: 10px 28px;
    border-radius: 25px;
    font-size: 1.1rem;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: all 0.3s;
    margin-bottom: 10px;
}
.gift-admin-btn:hover {
    background: #0a234f;
    color: #ffd700;
    border: 2px solid #ffd700;
}
.gift-notify-center {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    min-width: 260px;
    max-width: 90vw;
    text-align: center;
}
.modal-gift-admin {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.6);
    z-index: 10000;
}
.modal-content {
    background: #0a234f;
    border-radius: 18px;
    padding: 32px 24px;
    min-width: 320px;
    max-width: 95vw;
    box-shadow: 0 8px 40px #ffd70044;
    position: relative;
    text-align: center;
}
.close-modal {
    position: absolute;
    top: 12px;
    left: 18px;
    font-size: 2rem;
    color: #ffd700;
    background: none;
    border: none;
    cursor: pointer;
    transition: color 0.2s;
}
.close-modal:hover {
    color: #fff;
}
.custom-file-upload {
    display: flex;
    align-items: center;
    gap: 12px;
}
#giftImageLabel {
    background: #ffd700;
    color: #0a234f;
    padding: 8px 18px;
    border-radius: 12px;
    cursor: pointer;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 10px;
    border: 2px solid #ffd700;
    transition: background 0.2s, color 0.2s;
}
#giftImageLabel:hover {
    background: #0a234f;
    color: #ffd700;
}
#giftImagePreview {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    object-fit: cover;
    border: 2px solid #ffd700;
    box-shadow: 0 2px 8px #ffd70033;
}
</style>
<div class="gifts-header">
    <h1 class="gifts-title">معرض الهدايا (الأوزي)</h1>
</div>
@php $is_server = auth()->check() && (auth()->user()->role === 'خادم'); @endphp
@php $is_main_servant = auth()->check() && (auth()->user()->role === 'خادم' && auth()->user()->is_main_servant); @endphp
@if(auth()->check() && auth()->user()->is_admin)
    <div style="text-align:center;margin-bottom:24px;">
        <button class="gift-admin-btn" onclick="openGiftsAdminModal()"><i class="fas fa-cog"></i> إدارة الهدايا</button>
    </div>
@endif
@if($is_main_servant)
    <div style="text-align:center;margin-bottom:24px;">
        <button class="gift-admin-btn" onclick="openClassRequestsModal()"><i class="fas fa-users"></i> طلبات فصلي</button>
    </div>
@endif
<div class="gifts-grid" id="giftsGrid">
    <!-- سيتم ملؤها ديناميكياً بالجافاسكريبت -->
</div>
<!-- Modals: إدارة الهدايا، طلبات الفصل، إشعارات -->
@if(auth()->check() && auth()->user()->is_admin)
<div id="giftsAdminModal" class="modal-gift-admin" style="display:none;">
    <div class="modal-content" style="min-width:600px;max-width:1000px;">
        <span class="close-modal" onclick="closeGiftsAdminModal()">&times;</span>
        <h2 style="color:#ffd700;text-align:center;">إدارة الهدايا</h2>
        <form id="addGiftForm" style="display:flex;gap:8px;flex-wrap:wrap;justify-content:center;margin-bottom:18px;align-items:center;">
            <input type="text" id="giftName" name="name" placeholder="اسم الهدية" required style="flex:1 1 120px;padding:6px 10px;border-radius:6px;border:1.5px solid #ffd700;">
            <input type="number" id="giftPoints" name="points" placeholder="النقاط" min="0" required style="width:80px;padding:6px 8px;border-radius:6px;border:1.5px solid #ffd700;">
            <input type="number" id="giftQty" name="quantity" placeholder="الكمية" min="0" required style="width:80px;padding:6px 8px;border-radius:6px;border:1.5px solid #ffd700;">
            <div class="custom-file-upload">
                <label for="giftImage" id="giftImageLabel">
                    <span id="giftImageText">اختر صورة</span>
                    <img id="giftImagePreview" src="/images/logo.png" style="display:none;"/>
                </label>
                <input type="file" id="giftImage" name="image" accept="image/*" style="display:none;">
            </div>
            <button type="submit" class="gift-admin-btn" style="padding:8px 18px;font-size:1rem;">إضافة</button>
        </form>
        <div id="giftsAdminTableWrap" style="overflow-x:auto;">
            <table id="giftsAdminTable" style="width:100%;border-collapse:collapse;background:#fffbe6;color:#0a234f;border-radius:12px;overflow:hidden;">
                <thead>
                    <tr style="background:#ffd700;color:#0a234f;font-weight:bold;">
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>النقاط</th>
                        <th>الكمية</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endif
<div id="classRequestsModal" class="modal-gift-admin" style="display:none;z-index:10001;">
    <div class="modal-content" style="min-width:600px;max-width:900px;">
        <span class="close-modal" onclick="closeClassRequestsModal()">&times;</span>
        <h2 style="color:#ffd700;text-align:center;">طلبات هدايا الفصل</h2>
        <div id="classRequestsTableWrap" style="overflow-x:auto;">
            <table id="classRequestsTable" style="width:100%;border-collapse:collapse;background:#fffbe6;color:#0a234f;border-radius:12px;overflow:hidden;">
                <thead>
                    <tr style="background:#ffd700;color:#0a234f;font-weight:bold;">
                        <th>الصورة</th>
                        <th>اسم الطالب</th>
                        <th>الهدية</th>
                        <th>النقاط</th>
                        <th>العدد</th>
                        <th>تاريخ الطلب</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<div id="giftNotify" class="gift-notify-center" style="display:none;"></div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css" />
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const user = {
    is_admin: @json(auth()->check() && auth()->user()->is_admin),
    is_server: @json(auth()->check() && auth()->user()->role === 'خادم' && auth()->user()->is_main_servant),
    id: @json(auth()->check() ? auth()->user()->id : null),
    score: @json(auth()->check() ? auth()->user()->score : 0),
    name: @json(auth()->check() ? auth()->user()->name : ''),
};

// جلب الهدايا من API
async function fetchGifts() {
    try {
        const res = await axios.get('/api/gifts');
        return res.data;
    } catch (e) {
        notify('تعذر تحميل الهدايا', true);
        return [];
    }
}

// عرض الهدايا
async function renderGifts() {
    const grid = document.getElementById('giftsGrid');
    grid.innerHTML = '<div style="text-align:center;width:100%">جاري التحميل...</div>';
    
    // فحص نوع المستخدم
    const isStudent = !user.is_admin && !user.is_server;
    
    // للمخدومين: فحص الاشتراك أولاً
    if (isStudent) {
        try {
            const subscriptionResponse = await axios.get('/api/subscriptions/check-status');
            if (!subscriptionResponse.data.has_active_subscription) {
                // لا نحتاج لعرض الهدايا للمخدومين غير المشتركين
                return;
            }
        } catch (error) {
            console.error('خطأ في فحص الاشتراك:', error);
            return;
        }
    } else if (!user.is_admin) {
        // للخدام: إظهار رسالة مناسبة بدون ذكر الزر
        grid.innerHTML = `
            <div style="text-align:center;width:100%;color:#fff;font-size:1.2rem;padding:40px;">
                <i class="fas fa-users" style="color:#ffd700;font-size:3rem;margin-bottom:20px;display:block;"></i>
                <p style="color:#ffd700;font-size:1rem;margin-top:10px;">الهدايا متاحة للمخدومين المشتركين فقط</p>
            </div>
        `;
        return;
    }
    
    const gifts = await fetchGifts();
    if (!gifts.length) {
        grid.innerHTML = '<div style="text-align:center;width:100%">لا توجد هدايا متاحة حالياً</div>';
        return;
    }
    grid.innerHTML = '';
    gifts.forEach(gift => {
        const card = document.createElement('div');
        card.className = 'gift-card';
        card.innerHTML = `
            <img src="${gift.image ? '/storage/' + gift.image : '/images/logo.png'}" class="gift-img" alt="${gift.name}">
            <div class="gift-name">${gift.name}</div>
            <div class="gift-points"><i class='fas fa-coins'></i> ${gift.points} نقطة</div>
            <div class="gift-qty">المتاح: ${gift.quantity}</div>
            <div style='margin-bottom:8px;display:flex;flex-direction:column;align-items:center;'>
                <label for='gift-qty-${gift.id}' style='color:#ffd700;font-size:0.98rem;margin-bottom:3px;'>عدد القطع المطلوبة:</label>
                <input type='number' min='1' max='${gift.quantity}' value='1' style='width:70px;text-align:center;font-size:1.1rem;padding:4px 0;border-radius:8px;border:1.5px solid #ffd700;background:#fffbe6;color:#0a234f;font-weight:bold;' class='gift-quantity-input' id='gift-qty-${gift.id}'>
            </div>
            <button class='gift-btn' onclick='requestGift(${gift.id}, this)' ${gift.quantity < 1 ? 'disabled' : ''}>طلب الهدية <i class='fas fa-gift'></i></button>
            ${user.is_admin ? `<button class='gift-btn' style='margin-top:8px;background:#fffbe6;color:#0a234f;border:2px solid #ffd700;' onclick='openGiftsAdminModalAndEdit(${gift.id})'><i class='fas fa-edit'></i> تعديل</button>` : ''}
        `;
        grid.appendChild(card);
    });
}

// طلب هدية
async function requestGift(giftId, btn) {
    // فحص نوع المستخدم
    const isStudent = !user.is_admin && !user.is_server;
    
    if (isStudent) {
        // للمخدومين: فحص الاشتراك أولاً
        try {
            const subscriptionResponse = await axios.get('/api/subscriptions/check-status');
            if (!subscriptionResponse.data.has_active_subscription) {
                notify('برجاء دفع قيمة الاشتراك لخادم الفصل المسؤول لدخول المعرض', true);
                document.getElementById('subscriptionModal').style.display = 'flex';
                return;
            }
        } catch (error) {
            console.error('خطأ في فحص الاشتراك:', error);
            return;
        }
    }
    
    btn.disabled = true;
    btn.innerHTML = '...جاري الطلب';
    const qtyInput = document.getElementById('gift-qty-' + giftId);
    const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
    try {
        const res = await axios.post('/api/gift-requests', { gift_id: giftId, quantity });
        notify(res.data.message || 'تم إرسال طلبك للخادم');
        btn.innerHTML = 'تم إرسال الطلب';
    } catch (e) {
        let msg = e.response?.data?.message || 'حدث خطأ';
        notify(msg, true);
        btn.innerHTML = 'طلب الهدية <i class="fas fa-gift"></i>';
        btn.disabled = false;
    }
}

// إشعار عائم
function notify(msg, error = false) {
    const n = document.getElementById('giftNotify');
    n.innerHTML = `<div style="background:${error ? '#d32f2f' : '#ffd700'};color:${error ? '#fff' : '#0a234f'};padding:20px 32px;border-radius:18px;box-shadow:0 4px 18px #0002;font-size:1.2rem;display:inline-block;">${msg}</div>`;
    n.style.display = 'block';
    setTimeout(() => { n.style.display = 'none'; }, 3500);
}

// عند تحميل الصفحة
window.addEventListener('DOMContentLoaded', async function() {
    // فحص الاشتراك أولاً
    await checkSubscriptionStatus();
    
    // ثم عرض الهدايا
    await renderGifts();
    const addGiftForm = document.getElementById('addGiftForm');
    if (addGiftForm) {
        addGiftForm.onsubmit = function(e) {
            e.preventDefault();
            const data = new FormData(addGiftForm);

            // تأكد أن الصورة فعلاً ملف وليست مجرد اسم
            const fileInput = document.getElementById('giftImage');
            if (fileInput.files.length > 0) {
                data.set('image', fileInput.files[0]);
            }

            axios.post('/api/gifts', data, { withCredentials: true })
                .then(response => {
                    notify('تمت إضافة الهدية بنجاح');
                    addGiftForm.reset();
                    renderGiftsAdminTable();
                    renderGifts();
                })
                .catch(error => {
                    notify(error.response?.data?.message || 'حدث خطأ', true);
                    console.log(error.response?.data);
                });
        };
    }
    document.getElementById('giftImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('giftImagePreview');
        const text = document.getElementById('giftImageText');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                preview.src = ev.target.result;
                preview.style.display = 'inline-block';
                text.textContent = file.name;
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '/images/logo.png';
            preview.style.display = 'none';
            text.textContent = 'اختر صورة';
        }
    });
});

// مودال إدارة الهدايا
function openGiftsAdminModal() {
    document.getElementById('giftsAdminModal').style.display = 'flex';
    renderGiftsAdminTable();
}
function closeGiftsAdminModal() {
    document.getElementById('giftsAdminModal').style.display = 'none';
}

async function renderGiftsAdminTable() {
    const table = document.querySelector('#giftsAdminTable tbody');
    table.innerHTML = '<tr><td colspan="5" style="text-align:center;">جاري التحميل...</td></tr>';
    const gifts = await fetchGifts();
    if (!gifts.length) {
        table.innerHTML = '<tr><td colspan="5" style="text-align:center;">لا توجد هدايا</td></tr>';
        return;
    }
    table.innerHTML = '';
    gifts.forEach(gift => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><img src="${gift.image ? '/storage/' + gift.image : '/images/logo.png'}" style="width:48px;height:48px;border-radius:8px;"></td>
            <td><span class="gift-name-span">${gift.name}</span></td>
            <td><span class="gift-points-span">${gift.points}</span></td>
            <td><span class="gift-qty-span">${gift.quantity}</span></td>
            <td>
                <button onclick="editGiftRow(this, ${gift.id})" style="background:#ffd700;color:#0a234f;border:none;padding:4px 10px;border-radius:8px;font-size:1em;margin-left:4px;">تعديل</button>
                <button onclick="deleteGift(${gift.id}, this)" style="background:#d32f2f;color:#fff;border:none;padding:4px 10px;border-radius:8px;font-size:1em;">حذف</button>
            </td>
        `;
        tr.dataset.giftId = gift.id;
        table.appendChild(tr);
    });
}

// إضافة هدية جديدة
// const addGiftForm = document.getElementById('addGiftForm'); // This line is now redundant as it's moved inside DOMContentLoaded
// addGiftForm.onsubmit = async function(e) { // This line is now redundant as it's moved inside DOMContentLoaded
//     e.preventDefault();
//     const name = document.getElementById('giftName').value.trim();
//     const points = +document.getElementById('giftPoints').value;
//     const quantity = +document.getElementById('giftQty').value;
//     const image = document.getElementById('giftImage').value.trim();
//     if (!name || points < 0 || quantity < 0) return notify('يرجى ملء جميع الحقول بشكل صحيح', true);
//     try {
//         await axios.post('/api/gifts', { name, points, quantity, image });
//         notify('تمت إضافة الهدية بنجاح');
//         addGiftForm.reset();
//         renderGiftsAdminTable();
//         renderGifts();
//     } catch (e) {
//         notify(e.response?.data?.message || 'حدث خطأ', true);
//     }
// };

// حذف هدية
async function deleteGift(id, btn) {
    if (!confirm('هل أنت متأكد من حذف هذه الهدية؟')) return;
    btn.disabled = true;
    try {
        await axios.delete(`/api/gifts/${id}`);
        notify('تم حذف الهدية');
        renderGiftsAdminTable();
        renderGifts();
    } catch (e) {
        notify(e.response?.data?.message || 'حدث خطأ', true);
    }
    btn.disabled = false;
}

// تعديل هدية (صف تفاعلي)
function editGiftRow(btn, id) {
    const tr = btn.closest('tr');
    const name = tr.querySelector('.gift-name-span').textContent;
    const points = tr.querySelector('.gift-points-span').textContent;
    const qty = tr.querySelector('.gift-qty-span').textContent;
    const imgSrc = tr.querySelector('img').src;

    // HTML منسق لاختيار صورة مع زر وستايل ومعاينة
    tr.innerHTML = `
        <td>
            <div class="custom-file-upload" style="flex-direction:column;align-items:center;gap:6px;">
                <label class="editGiftImageLabel" style="background:#ffd700;color:#0a234f;padding:6px 14px;border-radius:10px;cursor:pointer;font-weight:bold;display:flex;align-items:center;gap:8px;border:2px solid #ffd700;transition:background 0.2s, color 0.2s;">
                    <span class="editGiftImageText">اختر صورة</span>
                    <img class="editGiftImagePreview" src="${imgSrc}" style="width:40px;height:40px;border-radius:8px;object-fit:cover;border:2px solid #ffd700;box-shadow:0 2px 8px #ffd70033;${imgSrc ? 'display:inline-block;' : 'display:none;'}" />
                    <input type="file" class="edit-gift-img" accept="image/*" style="display:none;">
                </label>
            </div>
        </td>
        <td><input type="text" value="${name}" class="edit-gift-name" style="width:90px;"></td>
        <td><input type="number" value="${points}" class="edit-gift-points" style="width:60px;"></td>
        <td><input type="number" value="${qty}" class="edit-gift-qty" style="width:60px;"></td>
        <td>
            <button onclick="saveGiftEdit(this, ${id})" style="background:#4CAF50;color:#fff;border:none;padding:4px 10px;border-radius:8px;font-size:1em;margin-left:4px;">حفظ</button>
            <button onclick="renderGiftsAdminTable()" style="background:#888;color:#fff;border:none;padding:4px 10px;border-radius:8px;font-size:1em;">إلغاء</button>
        </td>
    `;

    // JS: معاينة الصورة الجديدة عند اختيارها
    const fileInput = tr.querySelector('.edit-gift-img');
    const preview = tr.querySelector('.editGiftImagePreview');
    const text = tr.querySelector('.editGiftImageText');
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                preview.src = ev.target.result;
                preview.style.display = 'inline-block';
                text.textContent = file.name;
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = imgSrc;
            text.textContent = 'اختر صورة';
        }
    });
}

// حفظ التعديل
async function saveGiftEdit(btn, id) {
    const tr = btn.closest('tr');
    const fileInput = tr.querySelector('.edit-gift-img');
    const name = tr.querySelector('.edit-gift-name').value.trim();
    const points = +tr.querySelector('.edit-gift-points').value;
    const quantity = +tr.querySelector('.edit-gift-qty').value;

    if (!name || points < 0 || quantity < 0) return notify('يرجى ملء جميع الحقول بشكل صحيح', true);

    btn.disabled = true;

    // استخدم FormData لو فيه صورة جديدة
    const formData = new FormData();
    formData.append('name', name);
    formData.append('points', points);
    formData.append('quantity', quantity);

    if (fileInput.files.length > 0) {
        formData.append('image', fileInput.files[0]);
    }

    try {
        await axios.post(`/api/gifts/${id}?_method=PUT`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        });
        notify('تم حفظ التعديلات');
        renderGiftsAdminTable();
        renderGifts();
    } catch (e) {
        notify(e.response?.data?.message || 'حدث خطأ', true);
    }
    btn.disabled = false;
}

function openGiftsAdminModalAndEdit(giftId) {
    openGiftsAdminModal(); // تفتح المودال

    // نبحث عن الصف كل 100ms حتى يظهر أو حتى تمر ثانية واحدة
    let tries = 0;
    function tryEdit() {
        const tr = document.querySelector(`#giftsAdminTable tbody tr[data-gift-id='${giftId}']`);
        if (tr) {
            const editBtn = tr.querySelector('button[onclick^="editGiftRow"]');
            if (editBtn) editBtn.click();
        } else if (tries < 10) {
            tries++;
            setTimeout(tryEdit, 100);
        }
    }
    tryEdit();
}

// فحص حالة الاشتراك
async function checkSubscriptionStatus() {
    // فحص نوع المستخدم أولاً
    const isStudent = !user.is_admin && !user.is_server;
    
    // للخدام: لا نحتاج لفحص الاشتراك
    if (!isStudent) {
        return;
    }
    
    try {
        const response = await axios.get('/api/subscriptions/check-status');
        const data = response.data;
        
        if (!data.has_active_subscription) {
            // للمخدومين: إخفاء الهدايا وإظهار رسالة الاشتراك
            document.getElementById('giftsGrid').innerHTML = `
                <div style="text-align:center;width:100%;color:#fff;font-size:1.2rem;padding:40px;">
                    <i class="fas fa-lock" style="color:#ffd700;font-size:3rem;margin-bottom:20px;display:block;"></i>
                    <p>${data.message}</p>
                    <p style="color:#ffd700;font-weight:bold;margin-top:15px;">قيمة الاشتراك: 80 جنيه سنوياً</p>
                    <p style="color:#ffd700;font-size:1rem;margin-top:10px;">تاريخ انتهاء الاشتراك: 11 سبتمبر من كل عام</p>
                </div>
            `;
            
            // إظهار modal الاشتراك
            setTimeout(() => {
                document.getElementById('subscriptionModal').style.display = 'flex';
            }, 1000);
        } else if (data.is_expiring_soon && data.days_until_expiry > 0) {
            // إظهار تنبيه أن الاشتراك سينتهي قريباً
            const warningDiv = document.createElement('div');
            warningDiv.style.cssText = `
                background: linear-gradient(135deg, #ff9800, #f57c00);
                color: white;
                padding: 15px 20px;
                border-radius: 10px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: bold;
                box-shadow: 0 4px 15px rgba(255, 152, 0, 0.3);
            `;
            warningDiv.innerHTML = `
                <i class="fas fa-exclamation-triangle"></i>
                تنبيه: اشتراكك سينتهي خلال ${data.days_until_expiry} يوم
                <br><small>تاريخ الانتهاء: ${new Date(data.subscription.expiry_date).toLocaleDateString('ar-EG')}</small>
            `;
            
            const giftsGrid = document.getElementById('giftsGrid');
            giftsGrid.parentNode.insertBefore(warningDiv, giftsGrid);
        }
    } catch (error) {
        console.error('خطأ في فحص حالة الاشتراك:', error);
    }
}

// إغلاق modal الاشتراك
function closeSubscriptionModal() {
    document.getElementById('subscriptionModal').style.display = 'none';
}

function openClassRequestsModal() {
    document.getElementById('classRequestsModal').style.display = 'flex';
    renderClassRequestsTable();
}
function closeClassRequestsModal() {
    document.getElementById('classRequestsModal').style.display = 'none';
}
async function renderClassRequestsTable() {
    const table = document.querySelector('#classRequestsTable tbody');
    table.innerHTML = '<tr><td colspan="6" style="text-align:center;">جاري التحميل...</td></tr>';
    try {
        const res = await axios.get('/api/class-gift-requests');
        const requests = res.data.requests;
        if (!requests.length) {
            table.innerHTML = '<tr><td colspan="6" style="text-align:center;">لا توجد طلبات حالياً</td></tr>';
            return;
        }
        table.innerHTML = '';
        requests.forEach(req => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><img src="${req.gift_image ? '/storage/' + req.gift_image : '/images/logo.png'}" style="width:48px;height:48px;border-radius:8px;"></td>
                <td>${req.student_name}</td>
                <td>${req.gift_name}</td>
                <td>${req.gift_points}</td>
                <td>${req.quantity}</td>
                <td>${req.requested_at}</td>
            `;
            table.appendChild(tr);
        });
    } catch (e) {
        table.innerHTML = '<tr><td colspan="6" style="text-align:center;">تعذر تحميل الطلبات</td></tr>';
    }
}
</script>
@endsection 