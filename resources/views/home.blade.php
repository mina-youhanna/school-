@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lalezar&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&display=swap');

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
    margin-top: 0; /* Changed from 80px to 0 for correct positioning below fixed navbar */
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
    max-width: 1100px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 48px;
    padding: 0 20px;
}

.glass-card {
    border: 3px solid #ffd700;
    border-radius: 24px;
    background: rgba(10, 35, 79, 0.92);
    box-shadow: 0 8px 40px rgba(10, 35, 79, 0.2);
    padding: 0;
    min-height: 270px;
    display: flex;
    align-items: center;
    backdrop-filter: blur(10px);
    overflow: hidden;
}

.card-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-end;
    padding: 48px 36px 48px 24px;
    text-align: right;
}

.card-title {
    font-size: 2.1rem;
    color: #ffd700;
    margin-bottom: 18px;
    text-shadow: 0 2px 12px rgba(255, 215, 0, 0.33);
    font-weight: bold;
    position: relative;
}

.card-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    right: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    border-radius: 2px;
}

.card-text {
    font-size: 1.15rem;
    color: #fff;
    margin-bottom: 28px;
    text-align: right;
    line-height: 1.8;
    opacity: 0.95;
}

.card-btn {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #1e3c72;
    text-decoration: none;
    padding: 12px 32px;
    border-radius: 25px;
    font-size: 1.05rem;
    font-weight: bold;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    border: 2px solid transparent;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.card-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    border-color: #1e3c72;
    color: #1e3c72;
    text-decoration: none;
}

.card-image {
    flex: 0 0 340px;
    max-width: 340px;
    min-width: 220px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 32px 32px 32px 0;
}

.card-image img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(255, 215, 0, 0.26);
    transition: transform 0.3s ease;
}

.card-image img:hover {
    transform: scale(1.05);
}

/* كارت عن الكنيسة - بدون صورة */
.about-card {
    background: rgba(10, 35, 79, 0.92);
    border: 3px solid #ffd700;
    border-radius: 24px;
    padding: 48px 36px;
    text-align: center;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 40px rgba(10, 35, 79, 0.2);
}

.about-card .card-title {
    font-size: 2.4rem;
    margin-bottom: 24px;
}

.about-card .card-title::after {
    left: 50%;
    transform: translateX(-50%);
    right: auto;
}

.about-card .card-text {
    font-size: 1.2rem;
    text-align: center;
    max-width: 800px;
    margin: 0 auto 32px auto;
}

.church-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 24px auto;
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: #1e3c72;
    box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .glass-card {
        flex-direction: column;
        min-height: auto;
    }

    .card-content {
        padding: 32px 24px;
        text-align: center;
        align-items: center;
    }

    .card-image {
        flex: none;
        max-width: 100%;
        padding: 0 24px 32px 24px;
    }

    .card-image img {
        height: 200px;
    }

    .card-title {
        font-size: 1.8rem;
    }

    .card-title::after {
        left: 50%;
        transform: translateX(-50%);
        right: auto;
    }

    .card-text {
        font-size: 1.1rem;
        text-align: center;
    }

    .about-card {
        padding: 32px 24px;
    }

    .about-card .card-title {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .cards-container {
        gap: 32px;
    }

    .card-title {
        font-size: 1.6rem;
    }

    .card-text {
        font-size: 1rem;
    }

    .about-card .card-title {
        font-size: 1.8rem;
    }

    .church-icon {
        width: 60px;
        height: 60px;
        font-size: 2rem;
    }
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

.features-grid > div {
    box-shadow: 0 4px 24px #0a234f22;
    border-radius: 22px;
    border: 1.5px solid #ffd70055;
    transition: transform 0.25s, box-shadow 0.25s, background 0.25s;
    padding: 32px 18px 24px 18px;
    text-align: center;
    position: relative;
    cursor: pointer;
    overflow: hidden;
}

.features-grid > div:hover {
    transform: translateY(-8px) scale(1.04);
    box-shadow: 0 12px 40px #ffd70044, 0 2px 18px #0a234f22;
}

.features-grid .feature-title {
    color: #ffd700;
    font-family: 'Cairo', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    margin-bottom: 12px;
    transition: color 0.2s;
}

.features-grid > div:hover .feature-title {
    color: #fffbe6;
}

.features-grid .feature-desc {
    color: #fff;
    font-size: 1.08rem;
    margin-bottom: 0;
    transition: color 0.2s;
}

.features-grid > div:hover .feature-desc {
    color: #ffd700;
}

.feature-icon {
    font-size: 3rem;
    color: #ffd700;
    margin-bottom: 20px;
    transition: transform 0.3s, color 0.2s;
}

.features-grid > div:hover .feature-icon {
    transform: scale(1.18) rotate(-6deg);
    color: #fffbe6;
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
    margin-bottom: 18px;
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

@media (max-width: 900px) {
    .events-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }
}
@media (max-width: 600px) {
    .events-grid {
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    #eventsArrows {
        flex-direction: row !important;
        justify-content: center !important;
        margin-top: 10px !important;
        margin-bottom: 0 !important;
        display: flex !important;
        gap: 12px !important;
    }
}

.event-card {
    background: linear-gradient(135deg, rgba(10,35,79,0.95) 60%, rgba(255,215,0,0.10) 100%);
    border-radius: 22px;
    box-shadow: 0 4px 32px #0a234f22, 0 0 0 3px #ffd70033;
    padding: 0 0 28px 0;
    text-align: center;
    min-width: 220px;
    max-width: 340px;
    transition: transform 0.25s, box-shadow 0.25s, background 0.25s;
    position: relative;
    overflow: hidden;
    border: 1.5px solid #ffd70055;
    cursor: pointer;
    display: flex;
    flex-direction: column;
}

.event-card:hover {
    background: linear-gradient(135deg, #ffd700 0%, #fffbe6 100%);
    box-shadow: 0 12px 40px #ffd70044, 0 2px 18px #0a234f22;
    transform: translateY(-8px) scale(1.04);
}

.event-image {
    width: 100%;
    height: 200px;
    position: relative;
    background: #fffbe6;
    border-top-left-radius: 22px;
    border-top-right-radius: 22px;
    overflow: hidden;
    margin: 0; /* أزل أي هامش */
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    display: block;
    border-top-left-radius: 22px;
    border-top-right-radius: 22px;
    margin: 0;
    transition: transform 0.3s;
}

.event-card:hover .event-image img {
    transform: scale(1.05);
}

.event-date {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(255, 215, 0, 0.95);
    color: #0a234f;
    padding: 8px 16px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 1.05rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.10);
    z-index: 2;
    pointer-events: none;
}

.event-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* أو stretch */
    padding: 10px 16px 0 16px; /* قلل padding-top من 22px إلى 10px مثلاً */
    text-align: center;
    background: none;
    flex: 1 1 auto;
}

.event-title, .event-details {
    text-align: center; /* حتى يظل النص في المنتصف */
    width: 100%;
}

.event-title {
    font-size: 1.5rem;
    color: #ffd700;
    margin-bottom: 1px;
    font-weight: bold;
    text-shadow: 0 2px 8px #0a234f44;
    font-family: 'Cairo', 'Lalezar', sans-serif;
    height: 3.6em;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    align-items: flex-end;
    justify-content: center;
    text-align: center;
}

.event-details {
    display: -webkit-box;
    -webkit-line-clamp: 2; /* أو 3 للسطر الثالث */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    min-height: 2.8em; /* حسب حجم الخط */
    max-height: 3.2em;
    margin-bottom: 1px; /* نفس المسافة */
    font-size: 1.08rem;
    color: #fff;
    line-height: 1.7;
    text-align: justify;
    background: rgba(10,42,79,0.15);
    padding: 18px 14px;
    border-radius: 15px;
    border: 1.5px solid #ffd70055;
    box-shadow: 0 2px 10px #0a234f22;
    font-family: 'Amiri', serif;
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
    border: 2px solid #ffd700;
    font-size: 1rem;
    margin: 0 auto; /* وسط البطاقة */
    width: auto;
    min-width: unset;
    max-width: 100%;
    justify-content: center;
    margin-top: 0; /* أو margin-top: auto إذا أردت الزر في الأسفل دائماً */
}

.event-cta:hover {
    background: #0a234f;
    color: #ffd700;
    border: 2px solid #ffd700;
    transform: translateY(-2px) scale(1.04);
}

.event-cta:active,
.event-cta:focus {
    background: rgba(255, 215, 0, 0.2);
    color: #ffd700;
    border: 2px solid #ffd700;
    transform: none;
    outline: none;
}

.event-card:hover .event-title {
    color: #0a234f;
}

.event-card:hover .event-details {
    color: #0a234f;
}

@media (max-width: 600px) {
    .event-title { font-size: 1.1rem; }
    .event-card { padding: 0 0 12px 0; }
    .event-content { padding: 15px 6px 0 6px; }
    .event-image { height: 140px; }
    .event-content { padding: 12px 4px 0 4px; }
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
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #ffd700 0%, #e6c200 100%);
    color: #0a234f;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 1.6rem;
    text-decoration: none;
    margin: 0 10px;
    transition: all 0.2s;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.18);
    border: 2px solid rgba(255, 215, 0, 0.5);
    cursor: pointer;
    outline: none;
    position: relative;
}
.saint-bio-button i {
    margin: 0 !important;
    font-size: 1.3em;
}
.saint-bio-button:hover, .saint-bio-button:focus {
    background: #0a234f;
    color: #ffd700;
    box-shadow: 0 8px 24px rgba(10,35,79,0.25);
    border: 2.5px solid #ffd700;
    transform: translateY(-2px) scale(1.07);
}
#eventsArrows {
    text-align: center;
    margin-top: 18px;
    margin-bottom: 0;
    display: flex;
    justify-content: center;
    gap: 18px;
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
    padding: 32px 24px;
    width: 80%;
    max-width: 800px;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(255, 215, 0, 0.2);
    border: 2px solid rgba(255, 215, 0, 0.3);
    animation: modalFadeIn 0.3s ease;
    height: auto;
    min-height: unset;
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

.admin-news-btn, .admin-verse-btn {
    background: linear-gradient(135deg, #ffd700 0%, #e6c200 100%);
    color: #0a234f;
    border: none;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    z-index: 1000;
    box-shadow: 0 2px 8px rgba(255, 215, 0, 0.18);
}
.admin-news-btn:hover, .admin-verse-btn:hover {
    background: #0a234f;
    color: #ffd700;
    border: 2px solid #ffd700;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.25);
}
.admin-news-btn i, .admin-verse-btn i {
    transition: color 0.3s;
}
.admin-news-btn:hover i, .admin-verse-btn:hover i {
    color: #ffd700;
}

.features-grid > div:hover {
    transform: translateY(-8px) scale(1.04);
    box-shadow: 0 12px 40px #ffd70044, 0 2px 18px #0a234f22;
}



.features-grid .feature-title {
    color: #ffd700;
}
.features-grid .feature-desc {
    color: #fff;
}

.services-header {
    text-align: center;
    margin-bottom: 32px;
    position: relative;
}
.services-title {
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 2.5rem;
    color: #ffd700;
    text-shadow: 0 2px 12px rgba(255, 215, 0, 0.3);
    margin-bottom: 0;
    letter-spacing: 1px;
    background: linear-gradient(90deg, #ffd700 60%, #fffbe6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.services-title-decoration {
    width: 120px;
    height: 8px;
    margin: 0 auto;
    background: url('{{ asset('images/coptic-pattern-line.svg') }}') center/cover no-repeat;
    opacity: 0.5;
    margin-top: 8px;
}
#servicesGrid {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap: 32px 24px;
    justify-items: center;
}
.service-card {
    background: linear-gradient(135deg, rgba(10,35,79,0.95) 60%, rgba(255,215,0,0.10) 100%);
    border-radius: 22px;
    box-shadow: 0 4px 32px #0a234f22, 0 0 0 3px #ffd70033;
    padding: 38px 22px 28px 22px;
    text-align: center;
    min-width: 220px;
    max-width: 340px;
    transition: transform 0.25s, box-shadow 0.25s, background 0.25s;
    position: relative;
    overflow: hidden;
    border: 1.5px solid #ffd70055;
    cursor: pointer;
}
.service-card:hover {
    background: linear-gradient(135deg, #ffd700 0%, #fffbe6 100%);
    box-shadow: 0 12px 40px #ffd70044, 0 2px 18px #0a234f22;
    transform: translateY(-8px) scale(1.04);
}
.service-card .service-icon {
    font-size: 3.2rem;
    color: #ffd700;
    margin-bottom: 18px;
    transition: transform 0.3s, color 0.2s;
}
.service-card:hover .service-icon {
    color: #0a234f;
    transform: scale(1.18) rotate(-6deg);
}
.service-card .service-title {
    color: #ffd700;
    font-family: 'Cairo', sans-serif;
    font-size: 1.3rem;
    font-weight: 800;
    margin-bottom: 14px;
    transition: color 0.2s;
}
.service-card:hover .service-title {
    color: #0a234f;
}
.service-card .service-desc {
    color: #fff;
    font-size: 1.08rem;
    margin-bottom: 0;
    transition: color 0.2s;
}
.service-card:hover .service-desc {
    color: #0a234f;
}
@media (max-width: 600px) {
    .services-title { font-size: 1.5rem; }
    .service-card { padding: 22px 8px 18px 8px; }
}

/* أضف هذا في نهاية قسم الستايلات */
.details-modal-img {
    max-width: 90%;
    border-radius: 22px;
    box-shadow: 0 4px 24px #ffd70044;
    margin-bottom: 18px;
    margin-top: 10px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    background: #fffbe6;
    padding: 8px;
}

/* تأكيد أن زر التفصيل صغير */
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
    border: 2px solid #ffd700;
    font-size: 1rem;
    margin: 0 auto; /* وسط البطاقة */
    width: auto;
    min-width: unset;
    max-width: 100%;
    justify-content: center;
}

// ... existing code ...
// عدل دالة showEventDetails في السكريبت:
window.showEventDetails = function(idx) {
    const e = window.events[idx];
    document.getElementById('detailsModalTitle').textContent = e.title;
    document.getElementById('detailsModalBody').innerHTML = `
        <div style="display: flex; flex-direction: row; gap: 32px; align-items: flex-start; justify-content: center;">
            <div style="min-width: 260px; max-width: 320px; width: 280px; text-align: center; flex-shrink:0;">
                <div class="image-container" style="height:340px;display:flex;flex-direction:column;align-items:center;justify-content:flex-start;">
                    <img src='${e.image}' alt='${e.title}' class='details-modal-img' style='height:320px;max-width:100%;object-fit:cover;'>
                    <div class='date-badge'>${e.date}</div>
                </div>
            </div>
            <div style="flex: 1 1 0; direction: rtl; display: flex; align-items: flex-start;">
                <div class='event-details' style="font-size:1.15rem; width:100%; background:rgba(10,42,79,0.15); min-height:120px; overflow:visible; display:block; -webkit-line-clamp:unset;">${e.details}</div>
            </div>
        </div>
    `;
    document.getElementById('detailsModal').style.display = 'block';
    // أضف هذا في دالة showEventDetails بعد فتح المودال
    setTimeout(() => {
        document.activeElement && document.activeElement.blur && document.activeElement.blur();
    }, 100);
}
// ... existing code ...
/* --- تفاصيل مودال الفعالية العصري بالألوان الكنسية --- */
.details-modal-img {
    width: 100%;
    max-width: 260px;
    height: auto;
    border-radius: 18px;
    border: 3px solid #ffd700;
    box-shadow: 0 10px 24px #0a234f55;
    background: #fffbe6;
    margin-bottom: 18px;
    margin-top: 10px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    padding: 6px;
    transition: transform 0.3s;
}
.details-modal-img:hover {
    transform: scale(1.05);
}
.image-container {
    position: relative;
    display: inline-block;
    margin-bottom: 18px;
}
.date-badge {
    position: absolute;
    top: -12px;
    right: -12px;
    background: linear-gradient(90deg, #ffd700 60%, #fffbe6 100%);
    color: #0a234f;
    padding: 8px 18px;
    border-radius: 20px;
    font-size: 1rem;
    font-weight: bold;
    box-shadow: 0 4px 12px #ffd70044;
    border: 2px solid #0a234f;
    z-index: 2;
}
.event-title {
    font-size: 1.5rem;
    color: #ffd700;
    margin-bottom: 1px;
    font-weight: bold;
    text-shadow: 0 2px 8px #0a234f44;
    font-family: 'Cairo', 'Lalezar', sans-serif;
    height: 3.6em;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    align-items: flex-end;
    justify-content: center;
    text-align: center;
}
.event-details {
    display: -webkit-box;
    -webkit-line-clamp: 2; /* أو 3 للسطر الثالث */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    min-height: 2.8em; /* حسب حجم الخط */
    max-height: 3.2em;
    margin-bottom: 18px; /* نفس المسافة */
    font-size: 1.08rem;
    color: #fff;
    line-height: 1.7;
    text-align: justify;
    background: rgba(10,42,79,0.15);
    padding: 18px 14px;
    border-radius: 15px;
    border: 1.5px solid #ffd70055;
    box-shadow: 0 2px 10px #0a234f22;
    font-family: 'Amiri', serif;
}
@media (max-width: 600px) {
    .details-modal-img { width: 140px; height: 180px; }
    .event-title { font-size: 1.1rem; }
    .event-details { font-size: 0.95rem; padding: 10px 6px; }
}
/* --- نهاية تفاصيل المودال --- */

.custom-main-card {
    display: flex;
    flex-direction: row;
    align-items: center;
    background: rgba(10,35,79,0.92);
    border: 3px solid #ffd700;
    border-radius: 32px;
    box-shadow: 0 8px 40px #0a234f33;
    padding: 0 0 0 0;
    margin: 60px auto 60px auto;
    max-width: 1400px;
    min-height: 420px;
    position: relative;
    overflow: visible;
    transition: box-shadow 0.35s, filter 0.35s;
}
.custom-main-card:hover {
    box-shadow: 0 0 32px 8px #ffd70099, 0 8px 40px #0a234f44;
    filter: brightness(1.07) drop-shadow(0 0 16px #ffd70088);
    z-index: 2;
}
.custom-main-card .custom-card-img {
    flex: 0 0 540px;
    max-width: 540px;
    min-width: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 40px 0 40px 40px;
}
.custom-main-card .custom-card-img img {
    width: 100%;
    height: 340px;
    object-fit: cover;
    border-radius: 32px; /* Border radius for rounded corners */
    box-shadow: 0 8px 32px #ffd70044;
    background: #fffbe6;
    display: block;
    transition: transform 0.35s cubic-bezier(.6,0,.4,1), box-shadow 0.35s;
}
.custom-main-card .custom-card-img img:hover {
    transform: scale(1.07); /* Zoom on hover */
    box-shadow: 0 12px 40px #ffd70099;
    z-index: 3;
}
.custom-main-card .custom-card-content {
    flex: 1 1 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-end;
    padding: 60px 60px 60px 0;
    text-align: right;
    position: relative;
}
.custom-main-card .custom-card-title {
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 2.8rem;
    color: #ffd700;
    margin-bottom: 18px;
    text-shadow: 0 4px 18px #ffd70099, 0 2px 8px #0a234f44;
    font-weight: bold;
    letter-spacing: 1px;
    text-align: center;
    position: relative;
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.custom-main-card .custom-card-title::after {
    content: '';
    display: block;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: -10px;
    width: 120px;
    height: 5px;
    background: linear-gradient(90deg, #ffd700 60%, #fffbe6 100%);
    border-radius: 3px;
    opacity: 0.7;
}
.custom-main-card .custom-card-text {
    font-family: 'Amiri', serif;
    font-size: 1.35rem;
    color: #fff;
    margin-bottom: 38px;
    line-height: 2.1;
    max-width: 700px;
    text-align: right;
}
.custom-main-card .custom-card-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(90deg, #ffd700 60%, #fffbe6 100%);
    color: #0a234f;
    font-weight: bold;
    font-size: 1.25rem;
    border: none;
    border-radius: 16px;
    padding: 18px 48px;
    box-shadow: 0 6px 32px #ffd70044, 0 2px 8px #0a234f22;
    cursor: pointer;
    transition: all 0.3s;
    outline: none;
    margin-top: 0;
    text-decoration: none;
    align-self: flex-start; /* زرار على اليمين */
}
.custom-main-card .custom-card-btn i {
    font-size: 1.3em;
}
.custom-main-card .custom-card-btn:hover {
    background: linear-gradient(90deg, #fffbe6 60%, #ffd700 100%);
    color: #0a234f;
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 12px 40px #ffd70055;
}
@media (max-width: 1100px) {
    .custom-main-card .custom-card-img { max-width: 340px; min-width: 180px; padding: 30px 0 30px 10px; }
    .custom-main-card .custom-card-img img { height: 220px; }
    .custom-main-card .custom-card-content { padding: 30px 10px 30px 0; }
}
@media (max-width: 800px) {
    .custom-main-card { flex-direction: column; min-height: unset; }
    .custom-main-card .custom-card-img { width: 100%; max-width: 100%; min-width: 0; padding: 20px 0 0 0; }
    .custom-main-card .custom-card-img img { width: 90vw; height: 180px; border-radius: 24px; }
    .custom-main-card .custom-card-content { align-items: center; text-align: center; padding: 24px 8vw 24px 8vw; }
    .custom-main-card .custom-card-title { justify-content: center; text-align: center; }
    .custom-main-card .custom-card-btn { align-self: center; }
}

.main-cards-container {
    display: flex;
    flex-direction: column;
    gap: 48px;
    max-width: 1400px;
    margin: 0 auto 60px auto;
}
.main-card {
    display: flex;
    flex-direction: row;
    background: rgba(10, 35, 79, 0.92);
    border: 3px solid #ffd700;
    border-radius: 24px;
    box-shadow: 0 8px 40px rgba(10, 35, 79, 0.2);
    overflow: hidden;
    min-height: 320px;
    align-items: stretch;
    transition: box-shadow 0.35s, filter 0.35s;
    position: relative;
}
.main-card:hover {
    box-shadow: 0 0 32px 8px #ffd70099, 0 8px 40px #0a234f44;
    filter: brightness(1.04) drop-shadow(0 0 16px #ffd70088);
    z-index: 2;
}
.main-card-reverse {
    flex-direction: row-reverse;
}
.main-card-img {
    flex: 0 0 420px;
    max-width: 420px;
    min-width: 260px;
    display: flex;
    align-items: stretch;
    justify-content: center;
    background: #fffbe6;
    padding: 32px 24px;
    border-radius: 0 18px 18px 0;
    box-sizing: border-box;
}
.main-card-reverse .main-card-img {
    border-radius: 18px 0 0 18px;
}
.main-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 18px;
    border: 3px solid #ffd700;
    box-shadow: 0 4px 24px #ffd70033;
    background: #fffbe6;
    transition: transform 0.35s cubic-bezier(.6,0,.4,1), box-shadow 0.35s;
}
.main-card-img img:hover {
    transform: scale(1.06);
    box-shadow: 0 8px 32px #ffd70066;
    z-index: 3;
}
.main-card-content {
    flex: 1 1 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-end;
    padding: 48px 36px;
    text-align: right;
}
.main-card-title {
    font-size: 2.4rem;
    color: #ffd700;
    margin-bottom: 18px;
    font-weight: bold;
    text-shadow: 0 2px 12px #ffd70099, 0 2px 8px #0a234f44;
    text-align: right;
    align-self: flex-end;
}
.main-card-text {
    font-size: 1.2rem;
    color: #fff;
    margin-bottom: 32px;
    line-height: 1.8;
    text-align: right;
    align-self: flex-end;
}
.main-card-btn {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #1e3c72;
    text-decoration: none;
    padding: 16px 38px;
    border-radius: 25px;
    font-size: 1.15rem;
    font-weight: bold;
    transition: all 0.3s;
    box-shadow: 0 4px 15px #ffd70044;
    border: 2px solid transparent;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    align-self: flex-end;
}
.main-card-btn:hover {
    background: linear-gradient(45deg, #fffbe6, #ffd700);
    color: #0a234f;
    border-color: #1e3c72;
    transform: translateY(-2px) scale(1.04);
}
@media (max-width: 900px) {
    .main-card, .main-card-reverse { flex-direction: column !important; }
    .main-card-img { max-width: 100%; min-width: 0; height: 220px; padding: 12px 8px; border-radius: 18px 18px 0 0 !important; }
    .main-card-img img { height: 220px; }
    .main-card-content { align-items: center; text-align: center; padding: 32px 18px; }
    .main-card-title, .main-card-text, .main-card-btn { align-self: center; text-align: center; }
}

<div class="main-cards-container">
    <!-- عن الكنيسة -->
    <div class="main-card">
        <div class="main-card-img">
            <img src="ضع_مسار_الصورة_هنا" alt="عن الكنيسة">
        </div>
        <div class="main-card-content">
            <h2 class="main-card-title">عن الكنيسة</h2>
            <p class="main-card-text">
                كنيسة القديسة دميانة والأنبا توماس السائح هي بيت الله ومركز للعبادة والخدمة الروحية. نسعى جاهدين لنشر رسالة المحبة والسلام من خلال خدماتنا المتنوعة.
            </p>
            <a href="#features-section" class="main-card-btn">
                اقرأ المزيد <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>
    <!-- خدماتنا (صورة يسار نص يمين) -->
    <div class="main-card main-card-reverse">
        <div class="main-card-img">
            <img src="ضع_مسار_الصورة_هنا" alt="خدمات الكنيسة">
        </div>
        <div class="main-card-content">
            <h2 class="main-card-title">خدماتنا</h2>
            <p class="main-card-text">
                نقدم مجموعة متنوعة من الخدمات الروحية والاجتماعية تشمل مدارس الأحد، الكورال، الخدمات الاجتماعية، وبرامج الشباب.
            </p>
            <a href="#features-section" class="main-card-btn">
                تعرف على خدماتنا <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>
    <!-- فعالياتنا (صورة يمين نص يسار) -->
    <div class="main-card">
        <div class="main-card-img">
            <img src="ضع_مسار_الصورة_هنا" alt="فعاليات الكنيسة">
        </div>
        <div class="main-card-content">
            <h2 class="main-card-title">فعالياتنا</h2>
            <p class="main-card-text">
                نقيم العديد من الفعاليات والمناسبات على مدار العام، من اجتماعات صلاة ونهضات روحية إلى مؤتمرات روحية وترفيهية.
            </p>
            <a href="#events-section" class="main-card-btn">
                تصفح الفعاليات <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>
</div>
<!-- نهاية الدفّات الرئيسية -->

<style>
.main-cards-container {
    display: flex;
    flex-direction: column;
    gap: 48px;
    max-width: 1400px;
    margin: 0 auto 60px auto;
}
.main-card {
    display: flex;
    flex-direction: row;
    background: rgba(10, 35, 79, 0.92);
    border: 3px solid #ffd700;
    border-radius: 24px;
    box-shadow: 0 8px 40px rgba(10, 35, 79, 0.2);
    overflow: hidden;
    min-height: 320px;
    align-items: stretch;
    transition: box-shadow 0.35s, filter 0.35s;
    position: relative;
}
.main-card:hover {
    box-shadow: 0 0 32px 8px #ffd70099, 0 8px 40px #0a234f44;
    filter: brightness(1.04) drop-shadow(0 0 16px #ffd70088);
    z-index: 2;
}
.main-card-reverse {
    flex-direction: row-reverse;
}
.main-card-img {
    flex: 0 0 420px;
    max-width: 420px;
    min-width: 260px;
    display: flex;
    align-items: stretch;
    justify-content: center;
    background: #fffbe6;
    padding: 32px 24px;
    border-radius: 0 18px 18px 0;
    box-sizing: border-box;
}
.main-card-reverse .main-card-img {
    border-radius: 18px 0 0 18px;
}
.main-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 18px;
    border: 3px solid #ffd700;
    box-shadow: 0 4px 24px #ffd70033;
    background: #fffbe6;
    transition: transform 0.35s cubic-bezier(.6,0,.4,1), box-shadow 0.35s;
}
.main-card-img img:hover {
    transform: scale(1.06);
    box-shadow: 0 8px 32px #ffd70066;
    z-index: 3;
}
.main-card-content {
    flex: 1 1 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-end;
    padding: 48px 36px;
    text-align: right;
}
.main-card-title {
    font-size: 2.4rem;
    color: #ffd700;
    margin-bottom: 18px;
    font-weight: bold;
    text-shadow: 0 2px 12px #ffd70099, 0 2px 8px #0a234f44;
    text-align: right;
    align-self: flex-end;
}
.main-card-text {
    font-size: 1.2rem;
    color: #fff;
    margin-bottom: 32px;
    line-height: 1.8;
    text-align: right;
    align-self: flex-end;
}
.main-card-btn {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #1e3c72;
    text-decoration: none;
    padding: 16px 38px;
    border-radius: 25px;
    font-size: 1.15rem;
    font-weight: bold;
    transition: all 0.3s;
    box-shadow: 0 4px 15px #ffd70044;
    border: 2px solid transparent;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    align-self: flex-end;
}
.main-card-btn:hover {
    background: linear-gradient(45deg, #fffbe6, #ffd700);
    color: #0a234f;
    border-color: #1e3c72;
    transform: translateY(-2px) scale(1.04);
}
@media (max-width: 900px) {
    .main-card, .main-card-reverse { flex-direction: column !important; }
    .main-card-img { max-width: 100%; min-width: 0; height: 220px; padding: 12px 8px; border-radius: 18px 18px 0 0 !important; }
    .main-card-img img { height: 220px; }
    .main-card-content { align-items: center; text-align: center; padding: 32px 18px; }
    .main-card-title, .main-card-text, .main-card-btn { align-self: center; text-align: center; }
}
</style>

</style>

<!-- رأس الصفحة والعنوان الرئيسي -->
<header class="header-section">
    <div class="golden-cross"></div>
    <div class="main-title-wrapper">
        <h1 class="main-title">كنيسة الشهيدة دميانة والأنبا توماس السائح</h1>
        <div class="title-decoration"></div>
    </div>
    <p class="subtitle">بيت الله - بوابة السماء</p>
</header>

@if(auth()->check() && auth()->user()->is_admin)
<!-- زر إدارة الآيات خارج الحاوية مع ضبط مكانه -->
<button class="admin-verse-btn" onclick="openVerseModal()" style="display:block; margin: 0 auto 10px auto; position:relative; top:0; right:0; min-width: 110px; min-height: 32px; font-size: 0.95rem;">
    <i class="fas fa-cog"></i> إدارة الآيات
</button>
@endif

<!-- الآية المتحركة -->
<div class="verse-container slide-in-left" style="position:relative;">
    <p class="verse-text" id="current-verse"></p>
    <p class="verse-reference" id="current-reference"></p>
</div>

<div class="decor-divider"></div>

<!-- شريط الأخبار المتحرك المُحسّن -->
<div class="news-ticker-container fade-in" style="position:relative;">
    @if(auth()->check() && auth()->user()->is_admin)
    <button class="admin-news-btn" onclick="openNewsModal()" style="position:absolute; top:-38px; right:18px; min-width: 110px; min-height: 32px; font-size: 0.95rem; padding: 6px 12px; border-radius: 14px;">
        <i class="fas fa-cog"></i> إدارة الأخبار
    </button>
    @endif
    <div class="news-ticker">
        <div class="news-ticker-label">
            <i class="fas fa-newspaper"></i> أخبار الكنيسة
        </div>
        <div class="ticker-wrapper">
            <div class="ticker-marquee"></div>
                </div>
    </div>
</div>

<!-- بطاقات المحتوى الرئيسية الجديدة بتصميم أفقي كبير -->
<div style="display: flex; flex-direction: column; gap: 48px; margin: 48px auto 60px auto; max-width: 1400px;">
    <!-- عن الكنيسة -->
    <div class="custom-main-card" style="margin: 0 auto;">
        <div class="custom-card-img" style="z-index:2;">
            <img src="{{ asset('images/church-front.jpg') }}" alt="عن الكنيسة" style="margin-left: -80px;">
        </div>
        <div class="custom-card-content">
            <div class="custom-card-title">عن الكنيسة</div>
            <div class="custom-card-text">
                كنيسة القديسة دميانة والأنبا توماس السائح هي بيت الله ومركز للعبادة والخدمة الروحية. نسعى جاهدين لنشر رسالة المحبة والسلام من خلال خدماتنا المتنوعة.
            </div>
            <a href="#features-section" class="custom-card-btn" onclick="scrollToSection('features-section'); return false;">
                اقرأ المزيد <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>
    <!-- خدماتنا -->
    <div class="custom-main-card" style="flex-direction: row-reverse; margin: 0 auto;">
        <div class="custom-card-img">
            <img src="{{ asset('images/IMG-20250704-WA0011.jpg') }}" alt="خدمات الكنيسة">
        </div>
        <div class="custom-card-content">
            <div class="custom-card-title">خدماتنا</div>
            <div class="custom-card-text">
                نقدم مجموعة متنوعة من الخدمات الروحية والاجتماعية تشمل مدارس الأحد، الكورال، الخدمات الاجتماعية، وبرامج الشباب.
            </div>
            <a href="#features-section" class="custom-card-btn" onclick="scrollToSection('features-section'); return false;">
                تعرف على خدماتنا <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>
    <!-- فعالياتنا -->
    <div class="custom-main-card" style="margin: 0 auto;">
        <div class="custom-card-img" style="z-index:2;">
            <img src="{{ asset('images/IMG-20250403-WA0260.jpg') }}" alt="فعاليات الكنيسة" style="margin-left: -80px;">
        </div>
        <div class="custom-card-content">
            <div class="custom-card-title">فعالياتنا</div>
            <div class="custom-card-text">
                نقيم العديد من الفعاليات والمناسبات على مدار العام، من اجتماعات صلاة ونهضات روحية إلى مؤتمرات روحية وترفيهية.
            </div>
            <a href="#events-section" class="custom-card-btn" onclick="scrollToSection('events-section'); return false;">
                تصفح الفعاليات <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>
</div>
<!-- نهاية البطاقات الرئيسية الجديدة -->

<!-- احذف أو علّق البطاقات القديمة -->
{{-- <div class="cards-container"> ... البطاقات القديمة ... </div> --}}

<!-- فقرة الإقتباس المُحسّنة -->
<div class="quote-box scale-in">
    "اِفْرَحُوا فِي الرَّبِّ كُلَّ حِينٍ، وَأَقُولُ أَيْضًا: افْرَحُوا" (في 4: 4)
</div>

<!-- قسم المميزات الجديد -->
<div id="features-section" style="margin: 40px 0 0 0;">
    <div class="services-header">
      <h2 class="services-title">خدمات الكنيسة</h2>
      <div class="services-title-decoration"></div>
    </div>
    <div class="features-grid" id="servicesGrid" style="background:none;box-shadow:none;padding:0;display:grid;grid-template-columns:repeat(auto-fit,minmax(270px,1fr));gap:32px 24px;justify-items:center;"></div>
</div>

<!-- قسم الفعاليات القادمة -->
<section class="events-section" id="events-section">
    <div style="text-align:center;">
        <h2 class="events-title fade-in" style="margin-bottom: 0;">الفعاليات القادمة</h2>
        @if(auth()->check() && auth()->user()->is_admin)
        <button class="admin-news-btn" style="min-width: 110px; min-height: 32px; font-size: 0.95rem; padding: 6px 12px; border-radius: 14px; margin: 10px auto 30px auto; display:inline-block; position:relative; top:0;" onclick="openManageEventsModal()">
            <i class="fas fa-cog"></i> إدارة الفعاليات
        </button>
        @endif
    </div>
    <div class="events-grid" id="eventsGrid">
        <!-- سيتم ملؤها ديناميكياً -->
    </div>
    <div id="eventsArrows" style="text-align:center; margin-top:10px; display:none;">
        <button onclick="scrollEvents('left'); this.blur();" class="saint-bio-button" style="margin-left:10px;"><i class="fas fa-arrow-right"></i></button>
        <button onclick="scrollEvents('right'); this.blur()" class="saint-bio-button"><i class="fas fa-arrow-left"></i></button>
    </div>
</section>
<!-- Modal إدارة الفعاليات -->
<div id="manageEventsModal" class="news-modal" dir="rtl">
    <div class="news-modal-content" style="max-width:900px; min-width:350px; direction:rtl; overflow-y:auto; max-height:90vh;">
        <div class="news-modal-header" style="flex-direction:row-reverse;">
            <div class="d-flex align-items-center">
                <h5 class="modal-title mb-0">إدارة الفعاليات</h5>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="closeManageEventsModal()"></button>
        </div>
        <div id="manageEventsBody" style="overflow-y:auto; max-height:65vh;">
            <!-- سيتم ملؤها ديناميكياً -->
        </div>
        <!-- نموذج إضافة فعالية جديدة -->
        <div style="margin-top:18px;padding:14px 10px;background:rgba(255,255,255,0.09);border-radius:12px;">
            <h4 style="color:#ffd700;margin-bottom:10px;text-align:right;">إضافة فعالية جديدة</h4>
            <form id="addEventForm" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;flex-direction:row-reverse;">
                <div style="display:flex;flex-direction:column;align-items:center;">
                    <label style="color:#ffd700;font-size:0.95rem;">صورة</label>
                    <input id="newEventImage" type="file" accept="image/*" style="width:120px;">
                </div>
                <input id="newEventTitle" type="text" placeholder="اسم الفعالية" style="flex:1 1 120px;padding:6px 10px;border-radius:6px;border:1.5px solid #ffd700;font-weight:bold;font-size:1.1rem;text-align:right;">
                <input id="newEventDetails" type="text" placeholder="وصف مختصر" style="flex:2 1 220px;padding:6px 10px;border-radius:6px;border:1.5px solid #ffd700;font-size:1rem;text-align:right;">
                <input id="newEventDate" type="text" placeholder="تاريخ (مثال: 1 يوليو)" style="width:90px;padding:6px 8px;border-radius:6px;border:1.5px solid #ffd700;font-size:0.95rem;text-align:right;">
                <button type="button" onclick="addNewEvent()" class="add-news-btn" style="background:linear-gradient(135deg,#4CAF50 0%,#45a049 100%);"><i class="fas fa-plus"></i> إضافة</button>
            </form>
        </div>
    </div>
</div>

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

<!-- Modal إضافة خدمة -->
<div id="addServiceModal" class="news-modal">
    <div class="news-modal-content">
        <div class="news-modal-header">
            <h2>إضافة خدمة جديدة</h2>
            <button class="close-modal" onclick="closeAddServiceModal()">&times;</button>
        </div>
        <div>
            <p style="text-align:center; color:#ffd700;">(سيتم تنفيذ النموذج لاحقًا)</p>
        </div>
    </div>
</div>
<!-- Modal إضافة فعالية -->
<div id="addEventModal" class="news-modal">
    <div class="news-modal-content">
        <div class="news-modal-header">
            <h2>إضافة فعالية جديدة</h2>
            <button class="close-modal" onclick="closeAddEventModal()">&times;</button>
        </div>
        <div>
            <!-- سيتم إضافة نموذج إضافة الفعالية هنا -->
            <p style="text-align:center; color:#ffd700;">(سيتم تنفيذ النموذج لاحقًا)</p>
        </div>
    </div>
</div>

<!-- Modal تفاصيل الخدمة/الفعالية -->
<div id="detailsModal" class="news-modal">
    <div class="news-modal-content" style="max-width:600px;">
        <div class="news-modal-header">
            <h2 id="detailsModalTitle"></h2>
            <button class="close-modal" onclick="closeDetailsModal()">&times;</button>
        </div>
        <div id="detailsModalBody" style="text-align:center;"></div>
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

function scrollToSection(id) {
    const el = document.getElementById(id);
    if (el) {
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

function openAddServiceModal() {
    document.getElementById('addServiceModal').style.display = 'block';
}
function closeAddServiceModal() {
    document.getElementById('addServiceModal').style.display = 'none';
}
function openAddEventModal() {
    document.getElementById('addEventModal').style.display = 'block';
}
function closeAddEventModal() {
    document.getElementById('addEventModal').style.display = 'none';
}

// بيانات الخدمات (مؤقتاً)
window.services = [
    {
        id: 1,
        icon: 'fa-bible',
        title: 'مدارس الأحد',
        desc: 'دروس روحية وتعليمية لمختلف الأعمار تقام كل أسبوع لتنمية الإيمان لدى أبنائنا وتعليمهم مبادئ المسيحية والكتاب المقدس.',
        image: 'images/church-front.jpg',
    },
    {
        id: 2,
        icon: 'fa-church',
        title: 'مدرسة الشمامسة',
        desc: 'تعليم الألحان والطقوس الكنسية وتدريب الشمامسة الصغار على خدمة المذبح والصلوات الكنسية بشكل منتظم.',
        image: 'images/church-service.jpg',
    },
    {
        id: 3,
        icon: 'fa-music',
        title: 'كورال الكنيسة',
        desc: 'فريق من المرتلين الموهوبين يقدمون الترانيم والألحان الكنسية التقليدية والمعاصرة في المناسبات المختلفة.',
        image: 'images/church-event.jpg',
    }
];
window.servicesStart = 0;
window.servicesPerPage = 3;

window.renderServices = function() {
    const grid = document.getElementById('servicesGrid');
    grid.innerHTML = '';
    let start = window.servicesStart;
    let end = Math.min(start + window.servicesPerPage, window.services.length);
    for (let i = start; i < end; i++) {
        const s = window.services[i];
        const card = document.createElement('div');
        card.className = 'service-card';
        card.innerHTML = `
            <div class="service-icon"><i class="fas ${s.icon}"></i></div>
            <div class="service-title">${s.title}</div>
            <div class="service-desc">${s.desc}</div>
        `;
        grid.appendChild(card);
    }
    document.getElementById('servicesArrows').style.display = 'none';
}
window.scrollServices = function(dir) {
    if (dir === 'left' && window.servicesStart > 0) window.servicesStart--;
    if (dir === 'right' && window.servicesStart + window.servicesPerPage < window.services.length) window.servicesStart++;
    window.renderServices();
}
window.editService = function(idx) { alert('تعديل الخدمة (سيتم لاحقًا)'); };
window.deleteService = function(idx) { if(confirm('حذف الخدمة؟')) { window.services.splice(idx,1); window.renderServices(); } };
window.moveService = function(idx,dir) {
    const newIdx = idx+dir;
    if(newIdx<0||newIdx>=window.services.length) return;
    [window.services[idx],window.services[newIdx]]=[window.services[newIdx],window.services[idx]];
    window.renderServices();
};
window.showServiceDetails = function(idx) {
    const s = window.services[idx];
    document.getElementById('detailsModalTitle').textContent = s.title;
    document.getElementById('detailsModalBody').innerHTML = `
        <img src='${s.image}' alt='${s.title}' style='max-width:100%; border-radius:18px; box-shadow:0 4px 24px #ffd70044; margin-bottom:18px;'>
        <div style='font-size:1.2rem; color:#fff; margin-bottom:10px;'>${s.desc}</div>
    `;
    document.getElementById('detailsModal').style.display = 'block';
}
// عند تحميل الصفحة
window.addEventListener('DOMContentLoaded',()=>{ window.renderServices(); });

// بيانات الفعاليات (مؤقتاً)
window.events = [
    {
        id: 1,
        image: '/images/prayer-meeting.jpg',
        date: '25 مايو',
        title: 'نهضة صلاة للسيدة العذراء',
        details: 'اجتماع صلاة خاص يقام لمدة ثلاثة أيام متتالية بمناسبة صوم السيدة العذراء، يتخلله عظات روحية وترانيم.'
    },
    {
        id: 2,
        image: '/images/youth-meeting.jpg',
        date: '30 مايو',
        title: 'اجتماع شباب مع أبونا باخوم',
        details: 'اجتماع خاص للشباب يتناول موضوعات إيمانية معاصرة ومشاكل الشباب مع أنشطة ترفيهية وروحية.'
    },
    {
        id: 3,
        image: '/images/charity-event.jpg',
        date: '5 يونيو',
        title: 'مبادرة "يد المحبة" الخيرية',
        details: 'حملة لجمع التبرعات والملابس والأدوية لتوزيعها على المحتاجين في المنطقة المحيطة بالكنيسة.'
    },
    {
        id: 4,
        image: '/images/stthomas (3).jpg',
        date: '12 يونيو',
        title: 'رحلة ترفيهية لأطفال مدارس الأحد',
        details: 'تنظم الكنيسة رحلة ترفيهية وثقافية لأطفال مدارس الأحد لزيارة معالم دينية وحدائق عامة.'
    },
    {
        id: 5,
        image: '/images/saint-stephen.jpg',
        date: '20 يونيو',
        title: 'مسابقة الكتاب المقدس السنوية',
        details: 'مسابقة شيقة لجميع الأعمار حول أسفار الكتاب المقدس مع جوائز قيمة للفائزين.'
    },
    {
        id: 6,
        image: '/images/download1.png',
        date: '28 يونيو',
        title: 'دورة رياضية للشباب',
        details: 'بطولة كرة قدم وتنس طاولة للشباب والفتيات في قاعة الكنيسة بمشاركة فرق من كنائس أخرى.'
    }
];
window.eventsStart = 0;
window.eventsPerPage = 3;

window.renderEvents = function() {
    const grid = document.getElementById('eventsGrid');
    grid.innerHTML = '';
    let start = window.eventsStart;
    let end = Math.min(start + window.eventsPerPage, window.events.length);
    for (let i = start; i < end; i++) {
        const e = window.events[i];
        const card = document.createElement('div');
        card.className = 'event-card';
        card.innerHTML = `
            <div class='event-image'>
                <img src='${e.image}' alt='${e.title}'>
                <div class='event-date'>${e.date}</div>
            </div>
            <div class='event-content' style="display:flex;flex-direction:column;justify-content:space-between;height:260px;">
                <div>
                    <h3 class='event-title'>${e.title}</h3>
                    <p class='event-details'>${e.details}</p>
                </div>
                <a href='javascript:void(0)' class='event-cta' onclick='showEventDetails(${i}); this.blur();'>التفاصيل <i class="fas fa-arrow-left"></i></a>
            </div>
        `;
        grid.appendChild(card);
    }
    document.getElementById('eventsArrows').style.display = window.events.length > window.eventsPerPage ? 'block' : 'none';
}
window.scrollEvents = function(dir) {
    if (dir === 'left') {
        if (window.eventsStart > 0) {
            window.eventsStart--;
        } else {
            window.eventsStart = Math.max(0, window.events.length - window.eventsPerPage);
        }
    }
    if (dir === 'right') {
        if (window.eventsStart + window.eventsPerPage < window.events.length) {
            window.eventsStart++;
        } else {
            window.eventsStart = 0;
        }
    }
    window.renderEvents();
}
window.addNewEvent = function() {
    const title = document.getElementById('newEventTitle').value.trim();
    const details = document.getElementById('newEventDetails').value.trim();
    const date = document.getElementById('newEventDate').value.trim();
    const imageInput = document.getElementById('newEventImage');
    let image = '';
    if(imageInput.files && imageInput.files[0]) {
        image = URL.createObjectURL(imageInput.files[0]);
    }
    if(title && details && date && image) {
        window.events.push({id:Date.now(),image,title,date,details});
        window.renderEvents();
        if(typeof renderManageEvents === 'function') renderManageEvents();
        document.getElementById('newEventTitle').value = '';
        document.getElementById('newEventDetails').value = '';
        document.getElementById('newEventDate').value = '';
        document.getElementById('newEventImage').value = '';
    } else {
        alert('يرجى ملء جميع الحقول واختيار صورة');
    }
};
window.deleteEvent = function(idx) {
    if(confirm('حذف الفعالية؟')) {
        window.events.splice(idx,1);
        window.renderEvents();
        if(typeof renderManageEvents === 'function') renderManageEvents();
    }
};
window.moveEvent = function(idx,dir) {
    const newIdx = idx+dir;
    if(newIdx<0||newIdx>=window.events.length) return;
    [window.events[idx],window.events[newIdx]]=[window.events[newIdx],window.events[idx]];
    window.renderEvents();
    if(typeof renderManageEvents === 'function') renderManageEvents();
};
window.showEventDetails = function(idx) {
    const e = window.events[idx];
    document.getElementById('detailsModalTitle').textContent = e.title;
    document.getElementById('detailsModalBody').innerHTML = `
        <div style="display: flex; flex-direction: row; gap: 32px; align-items: flex-start; justify-content: center;">
            <div style="min-width: 260px; max-width: 320px; width: 280px; text-align: center; flex-shrink:0;">
                <div class="image-container" style="height:340px;display:flex;flex-direction:column;align-items:center;justify-content:flex-start;">
                    <img src='${e.image}' alt='${e.title}' class='details-modal-img' style='height:320px;max-width:100%;object-fit:cover;'>
                    <div class='date-badge'>${e.date}</div>
                </div>
            </div>
            <div style="flex: 1 1 0; direction: rtl; display: flex; align-items: flex-start;">
                <div class='event-details' style="font-size:1.15rem; width:100%; background:rgba(10,42,79,0.15); min-height:120px; overflow:visible; display:block; -webkit-line-clamp:unset;">${e.details}</div>
            </div>
        </div>
    `;
    document.getElementById('detailsModal').style.display = 'block';
    setTimeout(() => {
        document.activeElement && document.activeElement.blur && document.activeElement.blur();
    }, 100);
}
window.closeDetailsModal = function() {
    document.getElementById('detailsModal').style.display = 'none';
}
window.addEventListener('DOMContentLoaded',()=>{ window.renderEvents(); });

function openManageServicesModal() {
    document.getElementById('manageServicesModal').style.display = 'block';
    renderManageServices();
}
function closeManageServicesModal() {
    document.getElementById('manageServicesModal').style.display = 'none';
}
function renderManageServices() {
    const body = document.getElementById('manageServicesBody');
    body.innerHTML = '';
    window.services.forEach((s, i) => {
        const row = document.createElement('div');
        row.style = 'display:flex;align-items:center;gap:10px;background:rgba(255,255,255,0.07);border-radius:10px;padding:12px 10px;margin-bottom:10px;flex-direction:row-reverse;';
        row.innerHTML = `
            <span style='font-size:2rem;color:#ffd700;width:48px;text-align:center;'><i class='fas ${s.icon}'></i></span>
            <input type='text' value='${s.title}' onchange='updateServiceTitle(${i},this.value)' style='flex:1 1 120px;padding:6px 10px;border-radius:6px;border:1.5px solid #ffd700;font-weight:bold;font-size:1.1rem;margin-right:8px;text-align:right;'>
            <input type='text' value='${s.desc}' onchange='updateServiceDesc(${i},this.value)' style='flex:2 1 220px;padding:6px 10px;border-radius:6px;border:1.5px solid #ffd700;font-size:1rem;text-align:right;'>
            <input type='text' value='${s.icon}' onchange='updateServiceIcon(${i},this.value)' style='width:90px;padding:6px 8px;border-radius:6px;border:1.5px solid #ffd700;font-size:0.95rem;margin-right:8px;text-align:right;' placeholder='fa-icon'>
            <button onclick='deleteService(${i},true)' class='add-news-btn' style='background:linear-gradient(135deg,#ff4444 0%,#d32f2f 100%);margin-right:2px;' title='حذف'><i class='fas fa-trash'></i></button>
            <button onclick='moveService(${i},1,true)' class='add-news-btn' ${i===window.services.length-1?'disabled':''} style='background:linear-gradient(135deg,#4CAF50 0%,#45a049 100%);margin-right:2px;' title='أسفل'><i class='fas fa-arrow-down'></i></button>
            <button onclick='moveService(${i},-1,true)' class='add-news-btn' ${i===0?'disabled':''} style='background:linear-gradient(135deg,#4CAF50 0%,#45a049 100%);margin-right:2px;' title='أعلى'><i class='fas fa-arrow-up'></i></button>
        `;
        body.appendChild(row);
    });
    // نموذج إضافة خدمة جديدة
    const addDiv = document.createElement('div');
    addDiv.style = 'margin-top:18px;padding:14px 10px;background:rgba(255,255,255,0.09);border-radius:12px;';
    addDiv.innerHTML = `
        <h4 style='color:#ffd700;margin-bottom:10px;text-align:right;'>إضافة خدمة جديدة</h4>
        <div style='display:flex;gap:10px;align-items:center;flex-wrap:wrap;flex-direction:row-reverse;'>
            <input id='newServiceTitle' type='text' placeholder='اسم الخدمة' style='flex:1 1 120px;padding:6px 10px;border-radius:6px;border:1.5px solid #ffd700;font-weight:bold;font-size:1.1rem;text-align:right;'>
            <input id='newServiceDesc' type='text' placeholder='وصف مختصر' style='flex:2 1 220px;padding:6px 10px;border-radius:6px;border:1.5px solid #ffd700;font-size:1rem;text-align:right;'>
            <input id='newServiceIcon' type='text' placeholder='fa-icon (مثال: fa-bible)' style='width:110px;padding:6px 8px;border-radius:6px;border:1.5px solid #ffd700;font-size:0.95rem;text-align:right;'>
            <button onclick='addNewService()' class='add-news-btn' style='background:linear-gradient(135deg,#4CAF50 0%,#45a049 100%);'><i class='fas fa-plus'></i> إضافة</button>
        </div>
    `;
    body.appendChild(addDiv);
}
window.updateServiceTitle = function(i, val) { window.services[i].title = val; window.renderServices(); };
window.updateServiceDesc = function(i, val) { window.services[i].desc = val; window.renderServices(); };
window.updateServiceIcon = function(i, val) { window.services[i].icon = val; window.renderServices(); };
window.deleteService = function(idx,fromManage) { if(confirm('حذف الخدمة؟')) { window.services.splice(idx,1); window.renderServices(); if(fromManage) renderManageServices(); } };
window.moveService = function(idx,dir,fromManage) {
    const newIdx = idx+dir;
    if(newIdx<0||newIdx>=window.services.length) return;
    [window.services[idx],window.services[newIdx]]=[window.services[newIdx],window.services[idx]];
    window.renderServices();
    if(fromManage) renderManageServices();
};
window.addNewService = function() {
    const title = document.getElementById('newServiceTitle').value.trim();
    const desc = document.getElementById('newServiceDesc').value.trim();
    const icon = document.getElementById('newServiceIcon').value.trim() || 'fa-bible';
    if(title && desc) {
        window.services.push({id:Date.now(),icon,title,desc,image:''});
        window.renderServices();
        renderManageServices();
        document.getElementById('newServiceTitle').value = '';
        document.getElementById('newServiceDesc').value = '';
        document.getElementById('newServiceIcon').value = '';
    }
};

function openManageEventsModal() {
    document.getElementById('manageEventsModal').style.display = 'block';
    renderManageEvents();
}
function closeManageEventsModal() {
    document.getElementById('manageEventsModal').style.display = 'none';
}
function renderManageEvents() {
    const body = document.getElementById('manageEventsBody');
    body.innerHTML = '';
    window.events.forEach((e, i) => {
        const row = document.createElement('div');
        row.style = 'display:flex;align-items:center;gap:10px;background:rgba(255,255,255,0.07);border-radius:10px;padding:12px 10px;margin-bottom:10px;flex-direction:row;overflow-x:auto;min-width:350px;';
        row.innerHTML = `
            <div style='display:flex;flex-direction:column;align-items:center;min-width:70px;'>
                <img src='${e.image}' alt='صورة' style='width:60px;height:60px;object-fit:cover;border-radius:8px;margin-left:8px;'>
                <span style='color:#ffd700;font-size:0.95rem;'>صورة</span>
            </div>
            <input type='text' value='${e.date}' onchange='updateEventDate(${i},this.value)' style='width:90px;padding:6px 8px;border-radius:6px;border:1.5px solid #ffd700;font-size:0.95rem;text-align:right;margin-left:8px;' placeholder='تاريخ'>
            <input type='text' value='${e.title}' onchange='updateEventTitle(${i},this.value)' style='flex:1 1 120px;padding:6px 10px;border-radius:6px;border:1.5px solid #ffd700;font-weight:bold;font-size:1.1rem;text-align:right;max-width:180px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;text-overflow:ellipsis;margin-left:8px;'>
            <input type='text' value='${e.details}' onchange='updateEventDetails(${i},this.value)' style='flex:2 1 220px;padding:6px 10px;border-radius:6px;border:1.5px solid #ffd700;font-size:1rem;text-align:right;max-width:260px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;text-overflow:ellipsis;margin-left:8px;'>
            <button onclick='moveEvent(${i},1,true)' class='add-news-btn' ${i===window.events.length-1?'disabled':''} style='background:linear-gradient(135deg,#4CAF50 0%,#45a049 100%);margin-left:4px;' title='أسفل'><i class='fas fa-arrow-down'></i></button>
            <button onclick='moveEvent(${i},-1,true)' class='add-news-btn' ${i===0?'disabled':''} style='background:linear-gradient(135deg,#4CAF50 0%,#45a049 100%);margin-left:4px;' title='أعلى'><i class='fas fa-arrow-up'></i></button>
            <button onclick='deleteEvent(${i},true)' class='add-news-btn' style='background:linear-gradient(135deg,#ff4444 0%,#d32f2f 100%);margin-left:4px;' title='حذف'><i class='fas fa-trash'></i></button>
        `;
        body.appendChild(row);
    });
}
window.updateEventTitle = function(i, val) { window.events[i].title = val; window.renderEvents(); };
window.updateEventDetails = function(i, val) { window.events[i].details = val; window.renderEvents(); };
window.updateEventDate = function(i, val) { window.events[i].date = val; window.renderEvents(); };
window.deleteEvent = function(idx,fromManage) { if(confirm('حذف الفعالية؟')) { window.events.splice(idx,1); window.renderEvents(); if(fromManage) renderManageEvents(); } };
window.moveEvent = function(idx,dir,fromManage) {
    const newIdx = idx+dir;
    if(newIdx<0||newIdx>=window.events.length) return;
    [window.events[idx],window.events[newIdx]]=[window.events[newIdx],window.events[idx]];
    window.renderEvents();
    if(fromManage) renderManageEvents();
};
window.addNewEvent = function() {
    const title = document.getElementById('newEventTitle').value.trim();
    const details = document.getElementById('newEventDetails').value.trim();
    const date = document.getElementById('newEventDate').value.trim();
    const imageInput = document.getElementById('newEventImage');
    let image = '';
    if(imageInput.files && imageInput.files[0]) {
        // سنستخدم URL.createObjectURL مؤقتاً للعرض الفوري
        image = URL.createObjectURL(imageInput.files[0]);
    }
    if(title && details && date && image) {
        window.events.push({id:Date.now(),image,title,date,details});
        window.renderEvents();
        renderManageEvents();
        document.getElementById('newEventTitle').value = '';
        document.getElementById('newEventDetails').value = '';
        document.getElementById('newEventDate').value = '';
        document.getElementById('newEventImage').value = '';
    } else {
        alert('يرجى ملء جميع الحقول واختيار صورة');
    }
};

// ... existing code ...
// --- EVENTS API INTEGRATION WITH FALLBACK ---
window.defaultEvents = [
    {
        id: 1,
        image: '/images/prayer-meeting.jpg',
        date: '25 مايو',
        title: 'نهضة صلاة للسيدة العذراء',
        details: 'اجتماع صلاة خاص يقام لمدة ثلاثة أيام متتالية بمناسبة صوم السيدة العذراء، يتخلله عظات روحية وترانيم.'
    },
    {
        id: 2,
        image: '/images/youth-meeting.jpg',
        date: '30 مايو',
        title: 'اجتماع شباب مع أبونا باخوم',
        details: 'اجتماع خاص للشباب يتناول موضوعات إيمانية معاصرة ومشاكل الشباب مع أنشطة ترفيهية وروحية.'
    },
    {
        id: 3,
        image: '/images/charity-event.jpg',
        date: '5 يونيو',
        title: 'مبادرة "يد المحبة" الخيرية',
        details: 'حملة لجمع التبرعات والملابس والأدوية لتوزيعها على المحتاجين في المنطقة المحيطة بالكنيسة.'
    },
    {
        id: 4,
        image: '/images/stthomas (3).jpg',
        date: '12 يونيو',
        title: 'رحلة ترفيهية لأطفال مدارس الأحد',
        details: 'تنظم الكنيسة رحلة ترفيهية وثقافية لأطفال مدارس الأحد لزيارة معالم دينية وحدائق عامة.'
    },
    {
        id: 5,
        image: '/images/saint-stephen.jpg',
        date: '20 يونيو',
        title: 'مسابقة الكتاب المقدس السنوية',
        details: 'مسابقة شيقة لجميع الأعمار حول أسفار الكتاب المقدس مع جوائز قيمة للفائزين.'
    },
    {
        id: 6,
        image: '/images/download1.png',
        date: '28 يونيو',
        title: 'دورة رياضية للشباب',
        details: 'بطولة كرة قدم وتنس طاولة للشباب والفتيات في قاعة الكنيسة بمشاركة فرق من كنائس أخرى.'
    }
];
window.events = [];
window.eventsStart = 0;
window.eventsPerPage = 3;

async function fetchEvents() {
    try {
        const res = await fetch('/api/events');
        if (!res.ok) throw new Error('فشل في جلب الفعاليات من السيرفر');
        window.events = await res.json();
        if (!Array.isArray(window.events) || window.events.length === 0) {
            window.events = window.defaultEvents.slice();
        }
    } catch (e) {
        window.events = window.defaultEvents.slice();
        // alert('تعذر الاتصال بالسيرفر، سيتم عرض فعاليات افتراضية فقط.');
    }
    window.renderEvents();
    if (typeof renderManageEvents === 'function') renderManageEvents();
}

window.renderEvents = function() {
    const grid = document.getElementById('eventsGrid');
    grid.innerHTML = '';
    let start = window.eventsStart;
    let end = Math.min(start + window.eventsPerPage, window.events.length);
    for (let i = start; i < end; i++) {
        const e = window.events[i];
        const card = document.createElement('div');
        card.className = 'event-card';
        card.innerHTML = `
            <div class='event-image'>
                <img src='${e.image}' alt='${e.title}'>
                <div class='event-date'>${e.date}</div>
            </div>
            <div class='event-content' style="display:flex;flex-direction:column;justify-content:space-between;height:260px;">
                <div>
                    <h3 class='event-title'>${e.title}</h3>
                    <p class='event-details'>${e.details}</p>
                </div>
                <a href='javascript:void(0)' class='event-cta' onclick='showEventDetails(${i}); this.blur();'>التفاصيل <i class="fas fa-arrow-left"></i></a>
            </div>
        `;
        grid.appendChild(card);
    }
    document.getElementById('eventsArrows').style.display = window.events.length > window.eventsPerPage ? 'block' : 'none';
}
window.scrollEvents = function(dir) {
    if (dir === 'left') {
        if (window.eventsStart > 0) {
            window.eventsStart--;
        } else {
            window.eventsStart = Math.max(0, window.events.length - window.eventsPerPage);
        }
    }
    if (dir === 'right') {
        if (window.eventsStart + window.eventsPerPage < window.events.length) {
            window.eventsStart++;
        } else {
            window.eventsStart = 0;
        }
    }
    window.renderEvents();
}
window.addNewEvent = async function() {
    const title = document.getElementById('newEventTitle').value.trim();
    const details = document.getElementById('newEventDetails').value.trim();
    const date = document.getElementById('newEventDate').value.trim();
    const imageInput = document.getElementById('newEventImage');
    let image = '';
    if(imageInput.files && imageInput.files[0]) {
        image = imageInput.files[0].name;
    }
    if(title && details && date && image) {
        try {
            const res = await fetch('/api/events', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ title, details, date, image })
            });
            if (!res.ok) throw new Error('فشل في إضافة الفعالية');
            await fetchEvents();
            document.getElementById('newEventTitle').value = '';
            document.getElementById('newEventDetails').value = '';
            document.getElementById('newEventDate').value = '';
            document.getElementById('newEventImage').value = '';
        } catch (e) {
            alert(e.message);
        }
    } else {
        alert('يرجى ملء جميع الحقول واختيار صورة');
    }
};
window.deleteEvent = async function(idx) {
    if(!confirm('حذف الفعالية؟')) return;
    try {
        const event = window.events[idx];
        const res = await fetch(`/api/events/${event.id}`, { method: 'DELETE' });
        if (!res.ok) throw new Error('فشل في حذف الفعالية');
        await fetchEvents();
    } catch (e) { alert(e.message); }
};
window.moveEvent = function(idx,dir) {
    // الترتيب محلي فقط (يمكن تطويره لاحقاً)
    const newIdx = idx+dir;
    if(newIdx<0||newIdx>=window.events.length) return;
    [window.events[idx],window.events[newIdx]]=[window.events[newIdx],window.events[idx]];
    window.renderEvents();
    if(typeof renderManageEvents === 'function') renderManageEvents();
};
window.showEventDetails = function(idx) {
    const e = window.events[idx];
    document.getElementById('detailsModalTitle').textContent = e.title;
    document.getElementById('detailsModalBody').innerHTML = `
        <div style="display: flex; flex-direction: row; gap: 32px; align-items: flex-start; justify-content: center;">
            <div style="min-width: 260px; max-width: 320px; width: 280px; text-align: center; flex-shrink:0;">
                <div class="image-container" style="height:340px;display:flex;flex-direction:column;align-items:center;justify-content:flex-start;">
                    <img src='${e.image}' alt='${e.title}' class='details-modal-img' style='height:320px;max-width:100%;object-fit:cover;'>
                    <div class='date-badge'>${e.date}</div>
                </div>
            </div>
            <div style="flex: 1 1 0; direction: rtl; display: flex; align-items: flex-start;">
                <div class='event-details' style="font-size:1.15rem; width:100%; background:rgba(10,42,79,0.15); min-height:120px; overflow:visible; display:block; -webkit-line-clamp:unset;">${e.details}</div>
            </div>
        </div>
    `;
    document.getElementById('detailsModal').style.display = 'block';
    setTimeout(() => {
        document.activeElement && document.activeElement.blur && document.activeElement.blur();
    }, 100);
}
window.closeDetailsModal = function() {
    document.getElementById('detailsModal').style.display = 'none';
}
window.addEventListener('DOMContentLoaded', fetchEvents);
// ... existing code ...
</script>

<script>document.getElementById('footerYear').textContent = new Date().getFullYear();</script>
@endsection

<style>
#detailsModalTitle {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  word-break: break-word;
  max-width: 90%;
  text-align: right;
  direction: rtl;
  font-size: 2rem;
  transition: font-size 0.2s;
}
#detailsModalTitle.long-title {
  font-size: 1.1rem !important;
}
</style>
<script>
function adjustModalTitleFont() {
  const title = document.getElementById('detailsModalTitle');
  if (!title) return;
  if (title.textContent.length > 50) {
    title.classList.add('long-title');
  } else {
    title.classList.remove('long-title');
  }
}
const origShowEventDetails = window.showEventDetails;
window.showEventDetails = function(idx) {
  origShowEventDetails(idx);
  adjustModalTitleFont();
}
</script>


