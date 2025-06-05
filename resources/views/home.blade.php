@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lalezar&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&display=swap');

body {
    background-image: url('../images/download.png');
    background-size: 300px;
    background-color: #0A2A4F;
    background-blend-mode: multiply;
    font-family: 'Tajawal', sans-serif;
    text-align: center;
    direction: rtl;
    color: white;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

body::before {
    content: '';
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('{{ asset('images/coptic-pattern.png') }}') repeat;
    opacity: 0.08;
    z-index: 0;
    pointer-events: none;
    animation: patternFloat 60s linear infinite;
}

@keyframes patternFloat {
    0% { background-position: 0 0; }
    100% { background-position: 300px 300px; }
}

/* تعديل موضع شريط الأخبار */
.news-ticker-container {
    width: 100%;
    position: relative;
    margin-top: 80px;
    z-index: 1000;
    box-shadow: 0 4px 25px rgba(0,0,0,0.15);
}

.news-ticker {
    display: flex;
    align-items: center;
    background: linear-gradient(90deg, #ffd700 0%, #e6bb00 100%);
    color: #0a234f;
    padding: 0;
    overflow: hidden;
    height: 50px;
    position: relative;
    direction: rtl;
    box-shadow: 0 2px 12px rgba(255,215,0,0.2), inset 0 -2px 0 rgba(0,0,0,0.1);
    border-bottom: 2px solid #e6c200;
}

.news-ticker::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: radial-gradient(circle at 50% 50%, transparent 85%, rgba(255,215,0,0.6) 100%);
    pointer-events: none;
}

.news-ticker-label {
    background: #0a234f;
    color: #ffd700;
    font-weight: 700;
    padding: 8px 20px;
    white-space: nowrap;
    min-width: 120px;
    text-align: center;
    position: relative;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 4px 0 8px rgba(0,0,0,0.1);
    clip-path: polygon(0 0, 90% 0, 100% 50%, 90% 100%);
}

.news-ticker-label i {
    margin-left: 8px;
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.15); }
    100% { transform: scale(1); }
}

.ticker-wrapper {
    flex: 1;
    overflow: hidden;
    position: relative;
    height: 100%;
    padding: 0 50px;
}

.ticker-marquee {
    display: flex;
    align-items: center;
    height: 100%;
    white-space: nowrap;
    animation: ticker-marquee 35s linear infinite;
    direction: ltr;
}

.ticker-marquee:hover {
    animation-play-state: paused;
}

@keyframes ticker-marquee {
    0% { transform: translateX(-150%); }
    100% { transform: translateX(100%); }
}

.ticker-item {
    display: inline-flex;
    align-items: center;
    margin: 0 40px;
    font-size: 18px;
    font-weight: 600;
    opacity: 0.9;
    transition: all 0.3s ease;
}

.ticker-item:hover {
    transform: scale(1.05);
    opacity: 1;
}

.ticker-item i {
    margin-left: 12px;
    font-size: 1.2em;
    color: #0a234f;
}

/* تأثير الضباب */
.glass-effect {
    position: relative;
}

.glass-effect::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    backdrop-filter: blur(10px);
    z-index: -1;
    opacity: 0.7;
    border-radius: inherit;
}

/* عنوان الصفحة الرئيسي */
.header-section {
    text-align: center;
    padding: 60px 20px 30px;
    position: relative;
    overflow: hidden;
}

.golden-cross {
    position: absolute;
    opacity: 0.1;
    width: 80vw;
    height: 80vw;
    max-width: 800px;
    max-height: 800px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: url('{{ asset('images/coptic-cross.svg') }}') center/contain no-repeat;
    z-index: -1;
    animation: rotateSlow 60s linear infinite;
}

@keyframes rotateSlow {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}

.main-title-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
}

.main-title {
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 3.5rem;
    font-weight: 800;
    background: linear-gradient(90deg, #ffd700 30%, #fffbe6 100%);
    color: transparent;
    -webkit-background-clip: text;
    background-clip: text;
    text-align: center;
    margin: 0;
    padding: 0 20px;
    letter-spacing: 1px;
    line-height: 1.2;
    text-shadow: 0 2px 12px rgba(255, 215, 0, 0.3);
    position: relative;
    z-index: 2;
    animation: fadeInDown 1.2s cubic-bezier(.6,0,.4,1) both;
    margin-bottom: 20px;

}

.title-decoration {
    position: absolute;
    bottom: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 80%;
    height: 10px;
    background: url('{{ asset('images/coptic-pattern-line.svg') }}') center/cover no-repeat;
    opacity: 0.5;
}

.subtitle {
    font-family: 'Amiri', serif;
    font-size: 1.5rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 15px 0 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    animation: fadeIn 1.5s both;
    font-style: italic;
}

.decor-divider {
    width: 200px;
    height: 30px;
    margin: 30px auto;
    background: url('{{ asset('images/coptic-divider.svg') }}') center/contain no-repeat;
    opacity: 0.7;
    animation: fadeIn 2s 1.2s both;
}

/* الآية المتحركة */
.verse-container {
    background: rgba(255, 255, 255, 0.1);
    padding: 30px;
    margin: 30px auto 50px auto;
    max-width: 900px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 4px 30px rgba(0,0,0,0.15);
    animation: verseFadeIn 1.2s cubic-bezier(.6,0,.4,1) both;
    position: relative;
    overflow: hidden;
    text-align: center;
}
.verse-container::before {
    content: '';
    position: absolute;
    top: -50px;
    left: -50px;
    width: 100px;
    height: 100px;
    background: url('{{ asset('images/scroll-corner.svg') }}') center/contain no-repeat;
    opacity: 0.15;
    transform: rotate(0deg);
}
.verse-container::after {
    content: '';
    position: absolute;
    bottom: -50px;
    right: -50px;
    width: 100px;
    height: 100px;
    background: url('{{ asset('images/scroll-corner.svg') }}') center/contain no-repeat;
    opacity: 0.15;
    transform: rotate(180deg);
}

.verse-text {
    text-align: center;
}

.verse-reference {
    text-align: center;
    display: inline-block;
    margin-left: auto;
    margin-right: auto;
}

.verse-reference {
    color: rgba(255, 255, 255, 0.8);
    text-align: left;
    margin: 20px 0 0 0;
    font-size: 18px;
    font-family: 'Cairo', sans-serif;
    font-weight: 500;
    position: relative;
    display: inline-block;
    padding: 5px 25px;
    border-radius: 30px;
    background: rgba(255, 215, 0, 0.15);
}

/* تأثيرات التمرير */
.fade-in {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.fade-in.visible {
    opacity: 1;
    transform: translateY(0);
}

.slide-in-left {
    opacity: 0;
    transform: translateX(-50px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.slide-in-left.visible {
    opacity: 1;
    transform: translateX(0);
}

.slide-in-right {
    opacity: 0;
    transform: translateX(50px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.slide-in-right.visible {
    opacity: 1;
    transform: translateX(0);
}

.scale-in {
    opacity: 0;
    transform: scale(0.9);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.scale-in.visible {
    opacity: 1;
    transform: scale(1);
}

/* بطاقات المحتوى */
.cards-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

.glass-card {
    background: rgba(255,255,255,0.1);
    box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 30px;
    border: 1.5px solid rgba(255,255,255,0.2);
    margin: 60px auto;
    padding: 40px;
    max-width: 1200px;
    display: flex;
    align-items: center;
    gap: 50px;
    position: relative;
    overflow: visible;
    box-shadow: 0 0 0 4px rgba(255, 215, 0, 0.2), 0 8px 32px 0 rgba(31,38,135,0.2);
    animation: fadeInUp 1.2s cubic-bezier(.6,0,.4,1) both;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.glass-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 50px rgba(31,38,135,0.3), 0 0 0 6px rgba(255, 215, 0, 0.3);
}

.glass-card.reverse {
    flex-direction: row-reverse;
}

.glass-card::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 30px;
    padding: 2px;
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.5) 0%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 215, 0, 0.5) 100%);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    pointer-events: none;
}

@media (max-width: 900px) {
    .glass-card, .glass-card.reverse {
        flex-direction: column !important;
        gap: 30px;
        padding: 30px 20px;
    }
}

.card-img {
    flex: 0 0 380px;
    max-width: 380px;
    height: 450px;
    border-radius: 25px;
    box-shadow: 0 4px 32px rgba(10, 35, 79, 0.2), 0 0 0 6px rgba(255, 215, 0, 0.2);
    background: #fffbe6;
    position: relative;
    overflow: visible;
    z-index: 1;
    transition: transform 0.5s cubic-bezier(.6,0,.4,1), box-shadow 0.5s;
}

.card-img:hover {
    transform: scale(1.05) rotate(-2deg);
    box-shadow: 0 12px 58px rgba(255, 215, 0, 0.3), 0 0 0 10px rgba(255, 215, 0, 0.3);
}

.card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 25px;
    background: #fffbe6;
    display: block;
    transition: transform 0.7s;
}

.card-img:hover img {
    transform: scale(1.05);
}

.card-img::after {
    content: '';
    position: absolute;
    top: -30px; left: -30px; right: -30px; bottom: -30px;
    background: url('{{ asset('images/coptic-ornament.svg') }}') center/cover no-repeat;
    opacity: 0.15;
    z-index: 0;
    pointer-events: none;
    animation: rotate 40s linear infinite;
}

.img-frame {
    position: absolute;
    top: -10px; left: -10px; right: -10px; bottom: -10px;
    border: 3px solid rgba(255, 215, 0, 0.3);
    border-radius: 27px;
    z-index: -1;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.card-content {
    flex: 1 1 0%;
    text-align: right;
    color: #ffffff;
    position: relative;
    z-index: 2;
    font-size: 1.2rem;
    line-height: 2.1;
    padding: 0 10px;
    animation: fadeInRight 1.2s cubic-bezier(.6,0,.4,1) both;
}

.card-content h2 {
    font-family: 'Cairo', sans-serif;
    font-size: 2.3rem;
    font-weight: 800;
    background: linear-gradient(90deg, #ffd700 60%, #fffbe6 100%);
    color: transparent;
    -webkit-background-clip: text;
    background-clip: text;
    margin-bottom: 20px;
    text-shadow: 0 2px 12px rgba(255, 215, 0, 0.3);
    position: relative;
    z-index: 2;
    display: inline-block;
}

.card-content h2::after {
    content: '';
    position: absolute;
    bottom: -8px;
    right: 0;
    width: 80%;
    height: 3px;
    background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.7) 50%, transparent);
    border-radius: 50%;
}

.card-content p {
    margin-bottom: 25px;
    font-size: 1.15rem;
    font-weight: 400;
    opacity: 0.95;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}

.card-content .card-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(90deg, #ffd700 60%, #fffbe6 100%);
    color: #0a234f;
    font-weight: bold;
    font-size: 1.1rem;
    border: none;
    border-radius: 12px;
    padding: 14px 36px;
    box-shadow: 0 4px 20px rgba(255, 215, 0, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
    outline: none;
    margin-top: 15px;
    position: relative;
    overflow: hidden;
}

.card-content .card-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: 0.5s;
}

.card-content .card-btn:hover::before {
    left: 100%;
}

.card-content .card-btn:hover {
    background: linear-gradient(90deg, #fffbe6 60%, #ffd700 100%);
    color: #0a234f;
    transform: translateY(-4px) scale(1.04);
    box-shadow: 0 8px 28px rgba(255, 215, 0, 0.4);
}

.card-content .card-btn i {
    font-size: 1.3em;
}

/* إقتباسات */
.quote-box {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 24px;
    box-shadow: 0 4px 30px rgba(255, 215, 0, 0.15);
    margin: 60px auto;
    padding: 30px 25px;
    max-width: 800px;
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
    color: #ffffff;
    border: 1.5px solid rgba(255, 215, 0, 0.3);
    position: relative;
    z-index: 2;
    animation: fadeIn 1.5s 1.2s both;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    backdrop-filter: blur(5px);
    font-family: 'Amiri', serif;
}

.quote-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 35px rgba(255, 215, 0, 0.25);
}

.quote-box::before,
.quote-box::after {
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    color: rgba(255, 215, 0, 0.3);
    font-size: 3rem;
    position: absolute;
    opacity: 0.8;
}

.quote-box::before {
    content: '\f10d';
    left: 20px; 
    top: 10px;
}

.quote-box::after {
    content: '\f10e';
    right: 20px;
    bottom: 10px;
}

/* المميزات */
.features-section {
    padding: 70px 20px;
    background: rgba(10, 35, 79, 0.4);
    margin: 80px 0;
    position: relative;
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
}

.features-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('{{ asset('images/coptic-pattern.png') }}') repeat;
    opacity: 0.05;
    z-index: 0;
}

.features-title {
    font-family: 'Cairo', sans-serif;
    font-size: 2.5rem;
    font-weight: 800;
    text-align: center;
    margin-bottom: 50px;
    color: #ffd700;
    text-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
    position: relative;
}

.features-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #ffd700, transparent);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
}

.feature-card {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    position: relative;
    overflow: hidden;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    background: rgba(255, 255, 255, 0.15);
}

.feature-card::before {
    content: '';
    position: absolute;
    width: 150%;
    height: 150%;
    background: radial-gradient(circle, rgba(255, 215, 0, 0.2) 0%, transparent 70%);
    top: -25%;
    left: -25%;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.feature-card:hover::before {
    opacity: 1;
}

.feature-icon {
    font-size: 3rem;
    color: #ffd700;
    margin-bottom: 20px;
    transition: transform 0.3s ease;
}

.feature-card:hover .feature-icon {
    transform: scale(1.2);
}

.feature-title {
    font-size: 1.5rem;
    color: #ffd700;
    margin-bottom: 15px;
    font-weight: 700;
}

.feature-desc {
    color: #ffffff;
    font-size: 1.05rem;
    line-height: 1.7;
}

/* الفعاليات القادمة */
.events-section {
    padding: 50px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.events-title {
    font-family: 'Cairo', sans-serif;
    font-size: 2.5rem;
    font-weight: 800;
    text-align: center;
    margin-bottom: 50px;
    color: #ffd700;
    text-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
    position: relative;
}

.events-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #ffd700, transparent);
}

.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
}

.event-card {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
}

.event-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
}

.event-image {
    height: 200px;
    overflow: hidden;
    position: relative;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.event-card:hover .event-image img {
    transform: scale(1.1);
}

.event-date {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 215, 0, 0.9);
    color: #0a234f;
    padding: 10px 15px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

.event-content {
    padding: 25px;
    text-align: right;
}

.event-title {
    font-size: 1.4rem;
    color: #ffd700;
    margin-bottom: 15px;
    font-weight: 700;
}

.event-details {
    color: #ffffff;
    font-size: 1.05rem;
    line-height: 1.7;
    margin-bottom: 20px;
}

.event-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 215, 0, 0.2);
    color: #ffd700;
    padding: 8px 20px;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
}

.event-cta:hover {
    background: rgba(255, 215, 0, 0.9);
    color: #0a234f;
    transform: translateX(-5px);
}

/* تأثيرات حركية */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(60px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-40px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* التصميم المتجاوب */
@media (max-width: 1200px) {
    .glass-card { padding: 30px; gap: 30px; }
    .card-img { flex: 0 0 320px; max-width: 320px; height: 400px; }
    .event-card { margin-bottom: 20px; }
}

@media (max-width: 900px) {
    .main-title { font-size: 2.8rem; }
    .subtitle { font-size: 1.2rem; }
    .verse-text { font-size: 24px; }
    .glass-card, .glass-card.reverse { flex-direction: column; padding: 25px; }
    .card-img { max-width: 280px; height: 350px; margin: 0 auto; }
    .card-content { text-align: center; }
    .features-grid, .events-grid { grid-template-columns: 1fr; }
}

@media (max-width: 600px) {
    .main-title { font-size: 2rem; }
    .subtitle { font-size: 1rem; }
    .news-ticker-label { min-width: 100px; padding: 8px 10px; font-size: 0.9rem; }
    .ticker-item { font-size: 0.9rem; margin: 0 20px; }
    .verse-text { font-size: 20px; }
    .verse-reference { font-size: 14px; }
    .glass-card { padding: 20px 10px; }
    .card-img { max-width: 240px; height: 300px; }
    .card-content h2 { font-size: 1.6rem; }
    .card-content p { font-size: 1rem; line-height: 1.8; }
    .card-content .card-btn { font-size: 0.9rem; padding: 10px 20px; }
    .quote-box { font-size: 1.2rem; padding: 20px 15px; }
    .feature-card, .event-card { padding: 20px; }
}

/* زر سيرة القديس */
.saint-bio-button {
    display: inline-block;
    background: linear-gradient(135deg, #ffd700 0%, #e6c200 100%);
    color: #0a234f;
    padding: 15px 30px;
    border-radius: 50px;
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 1.2rem;
    text-decoration: none;
    margin: 20px auto;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    border: 2px solid rgba(255, 215, 0, 0.5);
}

.saint-bio-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    color: #0a234f;
}

.saint-bio-button i {
    margin-left: 8px;
}

/* تنسيق زر المشرف */
.admin-news-btn {
    position: absolute;
    top: -40px;
    right: 20px;
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
    transition: all 0.3s ease;
    z-index: 1000;
}

.admin-news-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
}

/* تنسيق النافذة المنبثقة */
.news-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 2000;
    backdrop-filter: blur(5px);
}

.news-modal-content {
    position: relative;
    background: #0A2A4F;
    margin: 5% auto;
    padding: 20px;
    width: 80%;
    max-width: 800px;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(255, 215, 0, 0.2);
    border: 2px solid rgba(255, 215, 0, 0.3);
    animation: modalFadeIn 0.3s ease;
    max-height: 80vh;
    display: flex;
    flex-direction: column;
}

.news-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(255, 215, 0, 0.3);
}

.news-modal-header h2 {
    color: #ffd700;
    margin: 0;
    font-size: 1.8rem;
}

.close-modal {
    background: none;
    border: none;
    color: #ffd700;
    font-size: 2rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.close-modal:hover {
    transform: rotate(90deg);
    color: #fff;
}

.news-list {
    flex: 1;
    overflow-y: auto;
    padding-right: 10px;
    margin-bottom: 20px;
    max-height: 400px;
}

.news-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(255, 255, 255, 0.1);
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.news-item:hover {
    background: rgba(255, 255, 255, 0.15);
}

.news-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.news-actions button {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    padding: 5px;
}

.news-actions button:hover {
    transform: scale(1.1);
}

.news-arrows {
    display: flex;
    flex-direction: row;
    gap: 5px;
    align-items: center;
}

.news-text {
    flex: 1;
    margin: 0 15px;
    text-align: right;
    display: flex;
    align-items: center;
    gap: 10px;
}

.news-text i {
    color: #ffd700;
    font-size: 1.2em;
}

/* تنسيق شريط التمرير */
.news-list::-webkit-scrollbar {
    width: 8px;
}

.news-list::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

.news-list::-webkit-scrollbar-thumb {
    background: #ffd700;
    border-radius: 4px;
}

.news-list::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 215, 0, 0.7);
}

.add-news-form h3 {
    color: #ffd700;
    margin-bottom: 15px;
}

.form-group {
    display: flex;
    gap: 10px;
}

#newNewsText {
    flex: 1;
    padding: 10px 15px;
    border: 2px solid rgba(255, 215, 0, 0.3);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    font-size: 1rem;
}

.add-news-btn {
    background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.add-news-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
}

.news-arrows button {
    background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
    border: none;
    border-radius: 6px;
    padding: 6px 10px;
    margin: 0 2px;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
    display: flex;
    align-items: center;
}
.news-arrows button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
.news-arrows i {
    color: #fff !important;
    font-size: 1.1em;
}

.news-actions button {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    padding: 5px;
    border-radius: 6px;
    display: flex;
    align-items: center;
}
.news-actions button:hover {
    background: rgba(255, 215, 0, 0.1);
    transform: scale(1.1);
}
.news-actions .fa-pen-to-square {
    color: #ffd700;
}
.news-actions .fa-trash {
    color: #ff4444;
}

/* أزرار التعديل (حفظ/إلغاء) */
.edit-btn-save {
    background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 6px 10px;
    margin-left: 4px;
    font-size: 1.1em;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
    display: inline-flex;
    align-items: center;
}
.edit-btn-cancel {
    background: linear-gradient(135deg, #ff4444 0%, #d32f2f 100%);
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 6px 10px;
    margin-left: 4px;
    font-size: 1.1em;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
    display: inline-flex;
    align-items: center;
}
.edit-btn-save i, .edit-btn-cancel i {
    color: #fff !important;
}

.edit-news-input {
    background: #f7f7f7;
    color: #222;
    border: 2px solid #ffd700;
    border-radius: 8px;
    padding: 7px 14px;
    font-size: 1.05em;
    margin-left: 8px;
    outline: none;
    transition: border 0.2s, box-shadow 0.2s;
    min-width: 180px;
    max-width: 300px;
}
.edit-news-input:focus {
    border: 2.5px solid #ffea70;
    box-shadow: 0 0 0 2px #ffe06644;
}

/* تنسيق زر إدارة الآيات */
.admin-verse-btn {
    position: absolute;
    top: -40px;
    right: 20px;
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
    transition: all 0.3s ease;
    z-index: 1000;
}

.admin-verse-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
}

.verse-input {
    flex: 1;
    padding: 10px 15px;
    border: 2px solid rgba(255, 215, 0, 0.3);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    font-size: 1rem;
    margin-left: 10px;
}

.verse-input:focus {
    border-color: #ffd700;
    outline: none;
}

.edit-verse-input {
    background: #f7f7f7;
    color: #222;
    border: 2px solid #ffd700;
    border-radius: 8px;
    padding: 7px 14px;
    font-size: 1.05em;
    margin-left: 8px;
    outline: none;
    transition: border 0.2s, box-shadow 0.2s;
    min-width: 180px;
    max-width: 300px;
}

.edit-verse-input:focus {
    border: 2.5px solid #ffea70;
    box-shadow: 0 0 0 2px #ffe06644;
}
</style>

<!-- رأس الصفحة والعنوان الرئيسي -->
<header class="header-section">
    <div class="golden-cross"></div>
    <div class="main-title-wrapper">
        <h1 class="main-title">كنيسة القديسة دميانه والأنباء توماس السائح</h1>
        <div class="title-decoration"></div>
    </div>
    <p class="subtitle">بيت الله - بوابة السماء</p>
</header>

<!-- الآية المتحركة -->
<div class="verse-container slide-in-left">
    <button class="admin-verse-btn" onclick="openVerseModal()">
        <i class="fas fa-cog"></i> إدارة لآيات
    </button>
    <p class="verse-text" id="current-verse"></p>
    <p class="verse-reference" id="current-reference"></p>
</div>

<div class="decor-divider"></div>

<!-- شريط الأخبار المتحرك المُحسّن -->
<div class="news-ticker-container fade-in">
    @if(auth()->check())
        <!-- Debug Info -->
        <div style="position: absolute; top: -60px; right: 20px; color: white; background: rgba(0,0,0,0.5); padding: 5px; border-radius: 5px;">
            User ID: {{ auth()->id() }}<br>
            Is Admin: {{ auth()->user()->is_admin ? 'Yes' : 'No' }}
        </div>
    @endif
    <button class="admin-news-btn" onclick="openNewsModal()">
        <i class="fas fa-cog"></i> إدارة الأخبار
    </button>
    <div class="news-ticker">
        <div class="news-ticker-label">
            <i class="fas fa-newspaper"></i> أخبار الكنيسة
        </div>
        <div class="ticker-wrapper">
            <div class="ticker-marquee"></div>
                </div>
    </div>
</div>

<!-- بطاقات المحتوى المُحسّنة -->
<div class="cards-container">
    <div class="glass-card slide-in-right">
        <div class="card-img">
            <div class="img-frame"></div>
            <img src="{{ asset('images/stthomas (3).jpg') }}" alt="الأنبا توماس السائح">
        </div>
        <div class="card-content">
            <h2>الأنبا توماس السائح (شفيع الكنيسة)</h2>
            <p>
                وُلد أنبا توماس بشنشيف (شنشيف)، بإقليم أخميم، من أبوين تقيين محبين لله، فربياه بآداب الكنيسة. التهب قلبه بمحبة الله، وإذ كان يميل إلى الحياة التأملية انطلق إلى جبل مجاور يمارس فيه رياضته الروحية. كان محبًا للصلاة والتسبيح بصوته الرخيم، جادًا في نسكه حتى صار فيما بعد يأكل مرة واحدة في الأسبوع، يحفظ الكتاب المقدس عن ظهر قلب ليمارس وصاياه ويعيش إنجيله بفرح.
            </p>
            <p>
                فاحت رائحة المسيح فيه، فكان بعض الإخوة القاطنين في الجبل يأتون إليه ليشتركوا معه في بعض الصلوات. في يومٍ إذ كان قد بدأ يسبح بمزاميره التفت خلفه فرأى ثلاثة رجال بلباسٍ أبيض يسبحون معه، وكانت أصواتهم كأصوات ملائكة.
            </p>
            <a href="{{ route('saints.thomas') }}" class="card-btn"><i class="fas fa-book-open"></i> إقرأ المزيد عن حياة القديس</a>
        </div>
    </div>

    <div class="glass-card reverse slide-in-left">
        <div class="card-img">
            <div class="img-frame"></div>
            <img src="{{ asset('images/القديسة-دميانة.jpg') }}" alt="القديسة دميانه">
        </div>
        <div class="card-content">
            <h2>القديسة العفيفة دميانه (شفيعة الكنيسة)</h2>
            <p>
                من قديسات القرون الأولى فى المسيحية وهى أول راهبة فى التاريخ وارتبط اسمها بقصة الأربعين عذراء. وُلدت من أبوين مسيحيين تقيين فى أواخر القرن الثالث، وكان أبوها مرقس واليًا على البرلس.
            </p>
            <p>
                فى سن الثامنة عشر كشفت عن عزمها على حياة البتولية، فرحب والدها بهذا الاتجاه، ولتحقيق هذه الرغبة بنى لها قصرًا فى جهة الزعفران بناء على طلبها، لتنفرد فيه للعبادة، واجتمع حولها أربعون من العذارى اللاتى نذرن البتولية.
            </p>
            <a href="{{ route('saints.demiana') }}" class="card-btn"><i class="fas fa-book-open"></i> إقرأ المزيد عن سيرة القديسة</a>
        </div>
    </div>
</div>

<!-- فقرة الإقتباس المُحسّنة -->
<div class="quote-box scale-in">
    "اِفْرَحُوا فِي الرَّبِّ كُلَّ حِينٍ، وَأَقُولُ أَيْضًا: افْرَحُوا" (في 4: 4)
</div>

<!-- قسم المميزات الجديد -->
<section class="features-section">
    <h2 class="features-title fade-in">خدمات الكنيسة</h2>
    <div class="features-grid">
        <div class="feature-card slide-in-left">
            <div class="feature-icon">
                <i class="fas fa-bible"></i>
            </div>
            <h3 class="feature-title">مدارس الأحد</h3>
            <p class="feature-desc">دروس روحية وتعليمية لمختلف الأعمار تقام كل أسبوع لتنمية الإيمان لدى أبنائنا وتعليمهم مبادئ المسيحية والكتاب المقدس.</p>
        </div>
        
        <div class="feature-card fade-in">
            <div class="feature-icon">
                <i class="fas fa-hands-helping"></i>
            </div>
            <h3 class="feature-title">الخدمات الاجتماعية</h3>
            <p class="feature-desc">مساعدات مادية وعينية للمحتاجين، زيارات للمرضى والمسنين، ودعم للأسر الفقيرة لتعكس محبة المسيح في المجتمع.</p>
        </div>
        
        <div class="feature-card slide-in-right">
            <div class="feature-icon">
                <i class="fas fa-music"></i>
            </div>
            <h3 class="feature-title">كورال الكنيسة</h3>
            <p class="feature-desc">فريق من المرتلين الموهوبين يقدمون الترانيم والألحان الكنسية التقليدية والمعاصرة في القداسات والمناسبات المختلفة.</p>
        </div>
    </div>
</section>

<!-- قسم الفعاليات القادمة -->
<section class="events-section">
    <h2 class="events-title fade-in">الفعاليات القادمة</h2>
    <div class="events-grid">
        <div class="event-card slide-in-left">
            <div class="event-image">
                <img src="{{ asset('images/prayer-meeting.jpg') }}" alt="اجتماع صلاة">
                <div class="event-date">25 مايو</div>
            </div>
            <div class="event-content">
                <h3 class="event-title">نهضة صلاة للسيدة العذراء</h3>
                <p class="event-details">اجتماع صلاة خاص يقام لمدة ثلاثة أيام متتالية بمناسبة صوم السيدة العذراء، يتخلله عظات روحية وترانيم.</p>
                <a href="#" class="event-cta">التفاصيل <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        
        <div class="event-card fade-in">
            <div class="event-image">
                <img src="{{ asset('images/youth-meeting.jpg') }}" alt="اجتماع الشباب">
                <div class="event-date">30 مايو</div>
            </div>
            <div class="event-content">
                <h3 class="event-title">اجتماع شباب مع أبونا باخوم</h3>
                <p class="event-details">اجتماع خاص للشباب يتناول موضوعات إيمانية معاصرة ومشاكل الشباب مع أنشطة ترفيهية وروحية.</p>
                <a href="#" class="event-cta">التفاصيل <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        
        <div class="event-card slide-in-right">
            <div class="event-image">
                <img src="{{ asset('images/charity-event.jpg') }}" alt="مبادرة خيرية">
                <div class="event-date">5 يونيو</div>
            </div>
            <div class="event-content">
                <h3 class="event-title">مبادرة "يد المحبة" الخيرية</h3>
                <p class="event-details">حملة لجمع التبرعات والملابس والأدوية لتوزيعها على المحتاجين في المنطقة المحيطة بالكنيسة.</p>
                <a href="#" class="event-cta">التفاصيل <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Modal إدارة الأخبار -->
<div id="newsModal" class="news-modal">
    <div class="news-modal-content">
        <div class="news-modal-header">
            <h2>إدارة الأخبار</h2>
            <button class="close-modal" onclick="closeNewsModal()">&times;</button>
        </div>
        <div class="news-list">
            <!-- سيتم ملؤها ديناميكياً -->
        </div>
        <div class="add-news-form">
            <h3>إضافة خبر جديد</h3>
            <div class="form-group">
                <input type="text" id="newNewsText" placeholder="نص الخبر الجديد">
                <button onclick="addNews()" class="add-news-btn">
                    <i class="fas fa-plus"></i> إضافة
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal إدارة الآيات -->
<div id="verseModal" class="news-modal">
    <div class="news-modal-content">
        <div class="news-modal-header">
            <h2>إدارة الآيات</h2>
            <button class="close-modal" onclick="closeVerseModal()">&times;</button>
        </div>
        <div class="news-list">
            <!-- سيتم ملؤها ديناميكياً -->
        </div>
        <div class="add-news-form">
            <h3>إضافة آية جديدة</h3>
            <div class="form-group">
                <input type="text" id="newVerseText" placeholder="نص الآية" class="verse-input">
                <input type="text" id="newVerseReference" placeholder="الشاهد" class="verse-input">
                <button onclick="addVerse()" class="add-news-btn">
                    <i class="fas fa-plus"></i> إضافة
                </button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css" />
<script>
console.log("Script loaded, ticker-marquee:", document.querySelector('.ticker-marquee'));

document.addEventListener('DOMContentLoaded', function() {
    // تأثيرات التمرير
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // تطبيق المراقبة على جميع العناصر
    document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in').forEach(element => {
        observer.observe(element);
    });

    // إدارة الأخبار
    window.newsItems = [
        { id: 1, text: "مرحباً بكم في موقعنا الرسمي الجديد" },
        { id: 2, text: "قداس الأحد القادم الساعة 9 صباحاً" },
        { id: 3, text: "نهضة صلاة للسيدة العذراء الأسبوع القادم" },
        { id: 4, text: "عظة الأب أنطونيوس الجمعة القادمة" },
        { id: 5, text: "حملة التبرع بالملابس مستمرة حتى نهاية الشهر" }
    ];

    // تحميل الأخبار المحفوظة عند تحميل الصفحة
    const savedNews = localStorage.getItem('churchNews');
    if (savedNews) {
        window.newsItems = JSON.parse(savedNews);
    }
    window.updateTicker(); // تأكد من تحديث الشريط عند تحميل الصفحة
});

// دوال إدارة الأخبار
window.openNewsModal = function() {
    document.getElementById('newsModal').style.display = 'block';
    window.updateNewsList();
}

window.closeNewsModal = function() {
    document.getElementById('newsModal').style.display = 'none';
}

window.updateNewsList = function() {
    const newsList = document.querySelector('.news-list');
    newsList.innerHTML = '';

    // اعكس ترتيب الأخبار لعرض الأحدث أولاً
    window.newsItems.slice().reverse().forEach((item, revIndex, arr) => {
        // احسب الفهرس الأصلي في المصفوفة الأصلية
        const index = window.newsItems.length - 1 - revIndex;
        const newsItem = document.createElement('div');
        newsItem.className = 'news-item';

        // أزرار التحرك (يمين - أفقياً)
        const arrowsDiv = document.createElement('div');
        arrowsDiv.className = 'news-arrows';
        arrowsDiv.innerHTML = `
            <button onclick="moveNews(${index}, 'up')" ${index === 0 ? 'disabled' : ''}>
                <i class="fa-solid fa-arrow-up" style="color: #fff;"></i>
            </button>
            <button onclick="moveNews(${index}, 'down')" ${index === window.newsItems.length - 1 ? 'disabled' : ''}>
                <i class="fa-solid fa-arrow-down" style="color: #fff;"></i>
            </button>
        `;

        // نص الخبر مع أيقونة
        const newsTextDiv = document.createElement('div');
        newsTextDiv.className = 'news-text';
        newsTextDiv.innerHTML = `
            <i class="fa-solid fa-newspaper" style="margin-right:12px;color:#0a234f;"></i>
            <span id="news-text-${index}">${item.text}</span>
        `;

        // أزرار التعديل والحذف (شمال)
        const actionsDiv = document.createElement('div');
        actionsDiv.className = 'news-actions';
        actionsDiv.innerHTML = `
            <button onclick="editNews(${index})">
                <i class="fa-solid fa-pen-to-square" style="color: #4CAF50;"></i>
            </button>
            <button onclick="deleteNews(${index})">
                <i class="fa-solid fa-trash" style="color: #ff4444;"></i>
            </button>
        `;

        newsItem.appendChild(arrowsDiv);
        newsItem.appendChild(newsTextDiv);
        newsItem.appendChild(actionsDiv);
        newsList.appendChild(newsItem);
    });

    window.updateTicker();
}

window.addNews = function() {
    console.log("addNews called");
    const newText = document.getElementById('newNewsText').value.trim();
    if (newText) {
        window.newsItems.unshift({
            id: Date.now(),
            text: newText
        });
        console.log("newsItems after add:", window.newsItems);
        document.getElementById('newNewsText').value = '';
        window.updateNewsList();
        window.saveNews();
    } else {
        console.log("No text entered");
    }
}

window.editNews = function(index) {
    const newsTextSpan = document.getElementById(`news-text-${index}`);
    const oldText = window.newsItems[index].text;
    // استبدل النص بـ input وزر حفظ
    newsTextSpan.innerHTML = `
        <input id="edit-input-${index}" class="edit-news-input" value="${oldText}">
        <button onclick="saveEdit(${index})" class="edit-btn-save"><i class="fa-solid fa-check"></i></button>
        <button onclick="cancelEdit(${index}, '${oldText.replace(/'/g, "\\'")}')" class="edit-btn-cancel"><i class="fa-solid fa-times"></i></button>
    `;
}

window.saveEdit = function(index) {
    const newText = document.getElementById(`edit-input-${index}`).value.trim();
    if (newText) {
        window.newsItems[index].text = newText;
        window.updateNewsList();
        window.saveNews();
    }
}

window.cancelEdit = function(index, oldText) {
    window.newsItems[index].text = oldText;
    window.updateNewsList();
}

window.deleteNews = function(index) {
    if (confirm('هل أنت متأكد من حذف هذا الخبر؟')) {
        window.newsItems.splice(index, 1);
        window.updateNewsList();
        window.saveNews();
    }
}

window.moveNews = function(index, direction) {
    if (direction === 'up' && index > 0) {
        [window.newsItems[index], window.newsItems[index - 1]] = [window.newsItems[index - 1], window.newsItems[index]];
    } else if (direction === 'down' && index < window.newsItems.length - 1) {
        [window.newsItems[index], window.newsItems[index + 1]] = [window.newsItems[index + 1], window.newsItems[index]];
    }
    window.updateNewsList();
    window.saveNews();
}

window.updateTicker = function() {
    console.log("updateTicker called");
    const tickerMarquee = document.querySelector('.ticker-marquee');
    if (!tickerMarquee) {
        console.log("tickerMarquee not found!");
        return;
    }
    tickerMarquee.innerHTML = '';
    // اعرض الأخبار من الأحدث للأقدم (الجديد أولاً من اليمين)
    window.newsItems.slice().reverse().forEach(item => {
        console.log("Adding to ticker:", item.text);
        const tickerItem = document.createElement('div');
        tickerItem.className = 'ticker-item';
        tickerItem.innerHTML = `${item.text} <i class='fa-solid fa-newspaper' style='margin-right:12px;color:#0a234f;'></i>`;
        tickerMarquee.appendChild(tickerItem);
    });
}

window.saveNews = function() {
    localStorage.setItem('churchNews', JSON.stringify(window.newsItems));
}

// إغلاق النافذة عند النقر خارجها
window.onclick = function(event) {
    const modal = document.getElementById('newsModal');
    if (event.target == modal) {
        window.closeNewsModal();
    }
}

// إدارة الآيات
window.verses = [
    { id: 1, text: "هَذَا هُوَ الْيَوْمُ الَّذِي صَنَعَهُ الرَّبُّ. نَبْتَهِجُ وَنَفْرَحُ فِيهِ", reference: "مزمور 118: 24" },
    { id: 2, text: "اِفْرَحُوا فِي الرَّبِّ كُلَّ حِينٍ، وَأَقُولُ أَيْضًا: افْرَحُوا", reference: "في 4: 4" },
    { id: 3, text: "كُلُّ شَيْءٍ يُمْكِنُ لِلَّذِي يُؤْمِنُ", reference: "مر 9: 23" }
];

let currentVerseIndex = 0;
let verseInterval;

// تحميل الآيات المحفوظة عند تحميل الصفحة
const savedVerses = localStorage.getItem('churchVerses');
if (savedVerses) {
    window.verses = JSON.parse(savedVerses);
}

// تحديث الآية الحالية
window.updateCurrentVerse = function() {
    const verse = window.verses[currentVerseIndex];
    document.getElementById('current-verse').textContent = `"${verse.text}"`;
    document.getElementById('current-reference').textContent = verse.reference;
}

// بدء عرض الآيات بشكل دوري
window.startVerseRotation = function() {
    if (verseInterval) clearInterval(verseInterval);
    verseInterval = setInterval(() => {
        currentVerseIndex = (currentVerseIndex + 1) % window.verses.length;
        window.updateCurrentVerse();
    }, 5000);
}

// دوال إدارة الآيات
window.openVerseModal = function() {
    document.getElementById('verseModal').style.display = 'block';
    window.updateVerseList();
}

window.closeVerseModal = function() {
    document.getElementById('verseModal').style.display = 'none';
}

window.updateVerseList = function() {
    const verseList = document.querySelector('#verseModal .news-list');
    verseList.innerHTML = '';

    window.verses.slice().reverse().forEach((item, revIndex, arr) => {
        const index = window.verses.length - 1 - revIndex;
        const verseItem = document.createElement('div');
        verseItem.className = 'news-item';

        // أزرار التحرك
        const arrowsDiv = document.createElement('div');
        arrowsDiv.className = 'news-arrows';
        arrowsDiv.innerHTML = `
            <button onclick="moveVerse(${index}, 'up')" ${index === 0 ? 'disabled' : ''}>
                <i class="fa-solid fa-arrow-up" style="color: #fff;"></i>
            </button>
            <button onclick="moveVerse(${index}, 'down')" ${index === window.verses.length - 1 ? 'disabled' : ''}>
                <i class="fa-solid fa-arrow-down" style="color: #fff;"></i>
            </button>
        `;

        // نص الآية والشاهد
        const verseTextDiv = document.createElement('div');
        verseTextDiv.className = 'news-text';
        verseTextDiv.innerHTML = `
            <i class="fa-solid fa-book-bible" style="margin-right:12px;color:#0a234f;"></i>
            <span id="verse-text-${index}">${item.text}</span>
            <span id="verse-reference-${index}" style="margin-right:10px;color:#ffd700;">${item.reference}</span>
        `;

        // أزرار التعديل والحذف
        const actionsDiv = document.createElement('div');
        actionsDiv.className = 'news-actions';
        actionsDiv.innerHTML = `
            <button onclick="editVerse(${index})">
                <i class="fa-solid fa-pen-to-square" style="color: #4CAF50;"></i>
            </button>
            <button onclick="deleteVerse(${index})">
                <i class="fa-solid fa-trash" style="color: #ff4444;"></i>
            </button>
        `;

        verseItem.appendChild(arrowsDiv);
        verseItem.appendChild(verseTextDiv);
        verseItem.appendChild(actionsDiv);
        verseList.appendChild(verseItem);
    });
}

window.addVerse = function() {
    const newText = document.getElementById('newVerseText').value.trim();
    const newReference = document.getElementById('newVerseReference').value.trim();
    if (newText && newReference) {
        window.verses.unshift({
            id: Date.now(),
            text: newText,
            reference: newReference
        });
        document.getElementById('newVerseText').value = '';
        document.getElementById('newVerseReference').value = '';
        window.updateVerseList();
        window.saveVerses();
    }
}

window.editVerse = function(index) {
    const verseTextSpan = document.getElementById(`verse-text-${index}`);
    const verseReferenceSpan = document.getElementById(`verse-reference-${index}`);
    const oldText = window.verses[index].text;
    const oldReference = window.verses[index].reference;

    verseTextSpan.innerHTML = `
        <input id="edit-verse-text-${index}" class="edit-verse-input" value="${oldText}">
    `;
    verseReferenceSpan.innerHTML = `
        <input id="edit-verse-reference-${index}" class="edit-verse-input" value="${oldReference}">
        <button onclick="saveVerseEdit(${index})" class="edit-btn-save"><i class="fa-solid fa-check"></i></button>
        <button onclick="cancelVerseEdit(${index}, '${oldText.replace(/'/g, "\\'")}', '${oldReference.replace(/'/g, "\\'")}')" class="edit-btn-cancel"><i class="fa-solid fa-times"></i></button>
    `;
}

window.saveVerseEdit = function(index) {
    const newText = document.getElementById(`edit-verse-text-${index}`).value.trim();
    const newReference = document.getElementById(`edit-verse-reference-${index}`).value.trim();
    if (newText && newReference) {
        window.verses[index].text = newText;
        window.verses[index].reference = newReference;
        window.updateVerseList();
        window.saveVerses();
    }
}

window.cancelVerseEdit = function(index, oldText, oldReference) {
    window.verses[index].text = oldText;
    window.verses[index].reference = oldReference;
    window.updateVerseList();
}

window.deleteVerse = function(index) {
    if (confirm('هل أنت متأكد من حذف هذه الآية؟')) {
        window.verses.splice(index, 1);
        window.updateVerseList();
        window.saveVerses();
    }
}

window.moveVerse = function(index, direction) {
    if (direction === 'up' && index > 0) {
        [window.verses[index], window.verses[index - 1]] = [window.verses[index - 1], window.verses[index]];
    } else if (direction === 'down' && index < window.verses.length - 1) {
        [window.verses[index], window.verses[index + 1]] = [window.verses[index + 1], window.verses[index]];
    }
    window.updateVerseList();
    window.saveVerses();
}

window.saveVerses = function() {
    localStorage.setItem('churchVerses', JSON.stringify(window.verses));
}

// إغلاق النافذة عند النقر خارجها
window.onclick = function(event) {
    const modal = document.getElementById('verseModal');
    if (event.target == modal) {
        window.closeVerseModal();
    }
}

// بدء عرض الآيات عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    window.updateCurrentVerse();
    window.startVerseRotation();
});
</script>
@endsection
