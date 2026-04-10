@extends('layouts.main')
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .page-header h1 {
            font-weight: 800;
            font-size: 3rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            color: #666;
            font-size: 1.2rem;
        }

        /* Paket Kartları Genel Stil */
        .package-card {
            border: none;
            border-radius: 30px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            position: relative;
            background: white;
        }

        .package-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
        }

        /* 5. Sınıf - Taze Başlangıç (Yeşil Tema) */
        .package-5 {
            border-top: 8px solid #00b894;
        }
        .package-5 .card-header {
            background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
        }
        .package-5 .feature-icon {
            background: rgba(0, 184, 148, 0.1);
            color: #00b894;
        }
        .package-5 .btn-package {
            background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
        }
        .package-5 .price-tag {
            color: #00b894;
        }
        .package-5 .badge-class {
            background: #00b894;
        }

        /* 6. Sınıf - Keşif Zamanı (Turuncu Tema) */
        .package-6 {
            border-top: 8px solid #e17055;
        }
        .package-6 .card-header {
            background: linear-gradient(135deg, #e17055 0%, #fdcb6e 100%);
        }
        .package-6 .feature-icon {
            background: rgba(225, 112, 85, 0.1);
            color: #e17055;
        }
        .package-6 .btn-package {
            background: linear-gradient(135deg, #e17055 0%, #fdcb6e 100%);
        }
        .package-6 .price-tag {
            color: #e17055;
        }
        .package-6 .badge-class {
            background: #e17055;
        }

        /* 7. Sınıf - Güçlenme Yılı (Mor Tema) */
        .package-7 {
            border-top: 8px solid #6c5ce7;
        }
        .package-7 .card-header {
            background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
        }
        .package-7 .feature-icon {
            background: rgba(108, 92, 231, 0.1);
            color: #6c5ce7;
        }
        .package-7 .btn-package {
            background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
        }
        .package-7 .price-tag {
            color: #6c5ce7;
        }
        .package-7 .badge-class {
            background: #6c5ce7;
        }

        /* 8. Sınıf - LGS Maratonu (Kırmızı/Mavi Tema) */
        .package-8 {
            border-top: 8px solid #0984e3;
            border-bottom: 8px solid #d63031;
        }
        .package-8 .card-header {
            background: linear-gradient(135deg, #0984e3 0%, #d63031 100%);
        }
        .package-8 .feature-icon {
            background: rgba(9, 132, 227, 0.1);
            color: #0984e3;
        }
        .package-8 .btn-package {
            background: linear-gradient(135deg, #0984e3 0%, #d63031 100%);
        }
        .package-8 .price-tag {
            color: #0984e3;
        }
        .package-8 .badge-class {
            background: linear-gradient(135deg, #0984e3 0%, #d63031 100%);
        }

        /* Kart Header */
        .g-4 .card-header {
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .g-4 .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .class-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .package-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .package-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        /* Kart Body */
        .card-body {
            padding: 2rem;
        }

        .features-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(0,0,0,0.02);
            margin: 0 -1rem;
            padding-left: 1rem;
            padding-right: 1rem;
            border-radius: 10px;
        }

        .feature-item:last-child {
            border-bottom: none;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .feature-item:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-content {
            flex: 1;
        }

        .feature-title {
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
        }

        .feature-desc {
            color: #636e72;
            font-size: 0.85rem;
        }

        .feature-badge {
            background: rgba(0,0,0,0.05);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #2d3436;
        }

        /* Fiyat Bölümü */
        .pricing-section {
            background: rgba(0,0,0,0.02);
            border-radius: 20px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            text-align: center;
        }

        .price-tag {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }

        .price-period {
            color: #636e72;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .pricing-section .btn-package {
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .btn-package:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
            color: white;
        }

        /* Özel İkon Animasyonları */
        .icon-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .icon-rotate {
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .icon-pulse {
            animation: iconPulse 2s ease-in-out infinite;
        }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }
            
            .package-card {
                margin-bottom: 2rem;
            }
        }

        /* Özellik Vurgu */
        .highlight-box {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            border-radius: 15px;
            padding: 1rem;
            margin: 1rem 0;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .lgs-badge {
            position: absolute;
            top: 20px;
            right: -35px;
            background: #d63031;
            color: white;
            padding: 0.5rem 3rem;
            transform: rotate(45deg);
            font-weight: 700;
            font-size: 0.8rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            z-index: 10;
        }

        .blink-sharp {
            animation: visibility-animation 1s steps(1, start) infinite;
        }

        @keyframes visibility-animation {
            50% {
                visibility: hidden;
            }
        }
    </style>

    

@section('content')
    <style>
        .lesson-card{
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }
        .overlay{
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0,0,0,0.8);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.3s ease;
            padding: 10px;
        }
        .lesson-card:hover .overlay{
            opacity: 1;
        }
    </style>
    <div class="main-content">
        <!--<div class="banner-div">
            <div class="container">
                <div class="banner">
                    <div>
                        <div class="banner-text">
                            <h1 style=" color: #222222;">Derse Koş VIP ile <br>hep bir adım önde olun!</h1>
                            <p style="color: #222222;">Derse Koş VIP üyeliği ile birçok ayrıcalığa sahip olabilirsiniz. VIP üyelerimize özel içerikler, indirimler ve daha fazlası sizi bekliyor!</p>
                            <a class="banner-button" href="{{ route('vip.packages') }}">Paketleri İncele</a>
                        </div>
                    </div>
                    <div class="banner-image">
                        <img class="image-switcher" src="{{env('HTTP_DOMAIN')}}/img/vip-banner-1.png" image2="img/vip-banner-2.png" alt="Banner" />
                    </div>
                </div>
                
            </div>
        </div>-->
        <div class="container">
            <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdtS3u0ANgtSj9Ql2svRswa0JxnK2FstIgxALfuSA3csKPs5g/viewform?embedded=true" width="100%" height="992" frameborder="0" marginheight="0" marginwidth="0">Yükleniyor…</iframe>
            <!-- Sayfa Başlığı -->
            <!--<div class="page-header mt-4">
                <h1>2. Dönem 1. Yazılı Kamplarımız</h1>
                <p>Her sınıf seviyesine özel, dönemsel kamplarımız</p>
            </div>

            <div class="row g-4">
                
                @foreach($vip_camps as $camp)
                    <div class="col-12 col-lg-6 col-xl-3">
                        <div class="card package-card package-{{$camp->grade}}">
                            <div class="card-header">
                                <div class="class-badge badge-class">{{$camp->grade}}. SINIF</div>
                                <div class="package-subtitle">{{$camp->title}}</div>
                                
                                <div style="position: relative; display:inline-block; border-radius: 50px; padding: 10px; background: rgba(255,255,255); margin-top: 1rem;">
                                   <img src="{{ asset('img/dersekos-derslig-logo.png') }}" width="60" alt="">
                                </div>
                                 <span class="blink-sharp">Üyeliği Hediye!</span>
                            </div>
                            <div class="card-body">
                                <div>
                                    {!!$camp->description!!}
                                </div>

                                <div class="pricing-section">
                                    <div class="price-tag">{{$camp->price}} ₺</div>
                                    <a class="btn btn-package" href="{{ route('vip.camp.detail', ['id' => $camp->id]) }}"  data-grade="{{ $camp->grade }}" data-package-id="{{ $camp->id }}" data-package-type="camp">
                                        <i class="bi bi-arrow-right me-2"></i>Hemen İncele
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

           
            
            <div class="row mt-5 mb-5">
                <div class="col-12 text-center">
                    <div class="p-5 rounded-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <h2 class="text-white mb-3">Hangi Paket Size Uygun?</h2>
                        <p class="text-white-50 mb-4 fs-5"></p>
                        <a class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg" href="https://wa.me/905067790414" target="_blank">
                            <i class="bi bi-whatsapp me-2"></i>Bizimle iletişime geçin!
                        </a>
                    </div>
                </div>
            </div>-->

        </div>
        <div class="container">
            <div class="services mt-5 mb-5">
                <div class="service-card">
                    <h3>Özel İçerikler</h3>
                    <p>VIP üyelerimize özel hazırlanmış ders notları, videolar ve sınavlara hazırlık materyalleri.</p>
                </div>
                <div class="service-card">
                    <h3>İndirimler</h3>
                    <p>VIP üyelerimize özel indirimler ve kampanyalarla eğitim materyallerine daha uygun fiyatlarla erişim.</p>
                </div>
                <div class="service-card">
                    <h3>Öncelikli Destek</h3>
                    <p>Her türlü soru ve sorunlarınızda VIP üyelerimize öncelikli destek hizmeti sunuyoruz.</p>
                </div>
            </div>
            <div class="services-title">
                <h2 class="mb-4">Popüler Dersler</h2>
            </div>
            <div class="services">
                <div class="lesson-card">
                    <img src="img/matematik.png" alt="matematik" width="100%">
                    <div class="overlay">Matematik</div>
                </div>
                <div class="lesson-card">
                    <img src="img/fen-bilimleri.png" alt="fen-bilimleri" width="100%">
                    <div class="overlay">Fen Bilimleri</div>
                </div>
                <div class="lesson-card">
                    <img src="img/turkce.png" alt="turkce" width="100%">
                    <div class="overlay">Türkçe</div>
                </div>
            </div>
            <div class="testimonials">
                <h2 class="mt-5 mb-4">Kullanıcı Yorumları</h2>
                <div class="testimonials-grid">
                    <div class="testimonials-card">
                    <p>"Dersekoş VIP üyeliği sayesinde eğitim materyallerine daha uygun fiyatlarla erişebildim." - Mehmet Y.</p>
                        <div class="rating-stars">
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                        </div>
                    </div>
                    <div class="testimonials-card">
                    <p>"Dersekoş VIP üyeliği sayesinde derslerimde büyük ilerleme kaydettim. Özel içerikler gerçekten çok faydalı!" - Ayşe K.</p>
                        <div class="rating-stars">
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                        </div>
                    </div>
                    <div class="testimonials-card">
                    <p>"VIP üyeliği ile aldığım indirimler sayesinde eğitim materyallerine daha uygun fiyatlarla erişebildim." - Mehmet T.</p>
                        <div class="rating-stars">
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                        </div>
                    </div>
                    <div class="testimonials-card">
                    <p>"Öncelikli destek hizmeti sayesinde her soruma hızlıca cevap bulabildim. Teşekkürler Dersekoş!" - Elif S.</p>
                        <div class="rating-stars">
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                            <i class="bi bi-star-fill" style="color: #f4c150;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function(){

        //setInterval function to switch image every 5 seconds
        setInterval(function(){
            $('.image-switcher').each(function(){
                var img1 = $(this).attr('src');
                var img2 = $(this).attr('image2');
                //add fadeOut and fadeIn effect
                $(this).fadeOut(500, function(){
                    $(this).attr('src', img2);
                    $(this).attr('image2', img1);
                    $(this).fadeIn(500);
                });
            });
        }, 2500);
    });
</script>

@endsection


