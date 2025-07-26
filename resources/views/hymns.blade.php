@extends('layouts.app')

@section('content')
<div style="min-height: 100vh; background: #f5f7fa; padding: 40px 0;">
    <div style="max-width: 1100px; margin: 0 auto; position: relative;">
        @if(!empty($hymn->image_url))
            <div style="position: absolute; inset: 0; z-index: 0;">
                <img src="{{ $hymn->image_url }}" alt="خلفية اللحن" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.13; filter: blur(2px); border-radius: 32px;">
            </div>
        @endif
        <div style="position: relative; z-index: 1; background: rgba(255,251,230,0.97); border-radius: 32px; box-shadow: 0 8px 32px #0a234f33; padding: 48px 38px 38px 38px;">
            <a href="{{ url('/hymns') }}" class="btn btn-secondary mb-3" style="font-weight:bold;">&larr; العودة إلى مكتبة الألحان</a>
            <div style="display: flex; align-items: flex-start; gap: 32px; flex-wrap: wrap;">
                <!-- صورة اللحن على اليمين -->
                @if(!empty($hymn->image_url))
                    <div style="flex: 0 0 180px; text-align: center;">
                        <img src="{{ $hymn->image_url }}" alt="صورة اللحن" style="width: 180px; height: 180px; border-radius: 24px; box-shadow: 0 2px 12px #ffd70055; background: #fff; object-fit: cover;">
                    </div>
                @endif
                <!-- العنوان بجوار الصورة -->
                <div style="flex: 1 1 400px;">
                    <h1 style="color: #0a234f; font-family: 'Lalezar', 'Cairo', sans-serif; font-size: 2.7rem; margin-bottom: 10px; line-height:1.3;">{!! nl2br(e($hymn->title)) !!}</h1>
                    <!-- نص اللحن كامل مع التنسيق -->
                    @if(!empty($hymn->coptic))
                        <div style="color: #a52a2a; font-size: 2.1rem; font-family: 'Amiri', serif; margin-bottom: 0; line-height: 1.7;">
                            {!! renderCopticVerses($hymn->coptic) !!}
                        </div>
                    @endif
                </div>
            </div>
            @if(!empty($hymn->breadcrumb) || !empty($hymn->category))
                <div style="margin: 18px 0 10px 0; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 1.5rem; color: #0a234f;">&#9776;</span>
                    <span style="color:#b12c2c; font-size:1.2rem; font-weight:bold;">{{ $hymn->breadcrumb ?? $hymn->category }}</span>
                </div>
            @endif
            <hr style="border-color: #ffd700; margin: 18px 0;">
            <div style="display: flex; gap: 18px; flex-wrap: wrap;">
                <div style="flex:1 1 250px; min-width:220px;">
                    <button style="background:#0a234f; color:#fff; border:none; border-radius:8px; padding:7px 18px; font-size:1rem; margin-bottom:7px;">آب عربي</button>
                    <div style="font-size: 1.15rem; color: #0a234f; background: #fff; border-radius: 10px; padding: 10px 16px; margin-bottom: 8px; white-space: pre-line; min-height: 60px;">{!! renderCopticVerses($hymn->arabic) !!}</div>
                </div>
                <div style="flex:1 1 180px; min-width:180px;">
                    <button style="background:#0a234f; color:#fff; border:none; border-radius:8px; padding:7px 18px; font-size:1rem; margin-bottom:7px;">قبطي معرب</button>
                    <div style="font-size: 1.1rem; color: #0a234f; background: #fff; border-radius: 10px; padding: 10px 16px; margin-bottom: 8px; white-space: pre-line; min-height: 60px;">{!! renderCopticVerses($hymn->coptic_ar) !!}</div>
                </div>
                <div style="flex:1 1 180px; min-width:180px;">
                    <button style="background:#0a234f; color:#fff; border:none; border-radius:8px; padding:7px 18px; font-size:1rem; margin-bottom:7px;">قبطي</button>
                    <div style="font-size: 1.1rem; color: #7a6c3a; font-family: 'Amiri', serif; background: #fff; border-radius: 10px; padding: 10px 16px; margin-bottom: 8px; white-space: pre-line; min-height: 60px;">{!! renderCopticVerses($hymn->coptic) !!}</div>
                </div>
            </div>
            @if($hymn->audio_url)
                <div style="margin: 24px 0 10px 0;">
                    <a href="{{ $hymn->audio_url }}" class="btn btn-primary" style="font-size:1.1rem; font-weight:bold; background:#0a234f; border:none; border-radius:8px; padding:10px 28px; margin-bottom:10px;">
                        &#127925; الاستماع للحن
                    </a>
                    <audio controls style="width: 100%; background: #fff; border-radius: 8px; margin-top: 10px;">
                        <source src="{{ $hymn->audio_url }}" type="audio/mpeg">
                        متصفحك لا يدعم تشغيل الصوت.
                    </audio>
                </div>
            @endif
            <p style="color: #0a234f; margin-top: 18px; text-align:left;">المصدر: <span style="color: #7a6c3a;">{{ $hymn->source }}</span></p>
        </div>
    </div>
</div>
@endsection
