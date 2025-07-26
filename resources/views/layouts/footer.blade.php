<footer class="main-footer">
    <div class="footer-content">
        <div class="footer-section about">
            <h3>كنيسة القديسة دميانة والأنبا توماس السائح</h3>
            <p>بيت الله - بوابة السماء<br>العنوان: شارع الكنيسة، مدينة السلام، القاهرة</p>
        </div>
        <div class="footer-section links">
            <h4>روابط سريعة</h4>
            <ul>
                <li><a href="/">الرئيسية</a></li>
                <li><a href="/profile">الملف الشخصي</a></li>
                <li><a href="/saints/st-thomas">سيرة القديسين</a></li>
                <li><a href="/">تواصل معنا</a></li>
            </ul>
        </div>
        <div class="footer-section social">
            <h4>تابعنا</h4>
            <div class="social-icons">
                <a href="#" title="فيسبوك"><i class="fab fa-facebook-f"></i></a>
                <a href="#" title="انستجرام"><i class="fab fa-instagram"></i></a>
                <a href="#" title="يوتيوب"><i class="fab fa-youtube"></i></a>
                <a href="#" title="واتساب"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <span>جميع الحقوق محفوظة &copy; {{ date('Y') }} لكنيسة القديسة دميانة والأنبا توماس السائح</span>
    </div>
</footer>
<style>
.main-footer {
    background: linear-gradient(120deg, #0a234f 80%, #ffd700 120%);
    color: #ffd700;
    font-family: 'Cairo', sans-serif;
    padding: 0;
    margin-top: 60px;
    box-shadow: 0 -2px 24px #0a234f44;
    position: relative;
    z-index: 10;
}
.footer-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-start;
    max-width: 1200px;
    margin: 0 auto;
    padding: 38px 18px 18px 18px;
    gap: 30px;
}
.footer-section {
    flex: 1 1 220px;
    min-width: 200px;
    margin-bottom: 18px;
}
.footer-section.about h3 {
    color: #ffd700;
    font-size: 1.3rem;
    font-family: 'Lalezar', 'Cairo', sans-serif;
    margin-bottom: 10px;
}
.footer-section.about p {
    color: #fffbe6;
    font-size: 1.05rem;
    margin-bottom: 0;
    line-height: 1.7;
}
.footer-section.links h4,
.footer-section.social h4 {
    color: #ffd700;
    font-size: 1.1rem;
    margin-bottom: 10px;
    font-weight: bold;
}
.footer-section.links ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.footer-section.links ul li {
    margin-bottom: 8px;
}
.footer-section.links ul li a {
    color: #fffbe6;
    text-decoration: none;
    font-size: 1.05rem;
    transition: color 0.2s;
}
.footer-section.links ul li a:hover {
    color: #ffd700;
    text-decoration: underline;
}
.footer-section.social .social-icons {
    display: flex;
    gap: 14px;
    margin-top: 8px;
}
.footer-section.social .social-icons a {
    color: #ffd700;
    background: rgba(255,255,255,0.08);
    border-radius: 50%;
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    transition: background 0.2s, color 0.2s, transform 0.2s;
    box-shadow: 0 2px 8px #ffd70022;
}
.footer-section.social .social-icons a:hover {
    background: #ffd700;
    color: #0a234f;
    transform: scale(1.12);
}
.footer-bottom {
    background: rgba(10,35,79,0.98);
    color: #ffd700;
    text-align: center;
    padding: 14px 10px 10px 10px;
    font-size: 1.08rem;
    border-top: 1.5px solid #ffd70044;
    letter-spacing: 1px;
}
@media (max-width: 900px) {
    .footer-content {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
        padding: 28px 8px 8px 8px;
    }
    .footer-section {
        margin-bottom: 10px;
    }
}
</style>
<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css" /> 