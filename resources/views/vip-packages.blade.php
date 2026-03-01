@extends('layouts.main')


@section('content')
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
        .card-header {
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
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
            width: 30px;
            height: 30px;
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

        .btn-package {
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
        /*.icon-float {
            animation: float 3s ease-in-out infinite;
        }*/

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
    </style>
    <main>
        <div class="container">
            <!-- Sayfa Başlığı -->
            <div class="page-header mt-4">
                <h1><i class="bi bi-stars me-3"></i>Eğitim Paketlerimiz<i class="bi bi-stars ms-3"></i></h1>
                <p>Her sınıf seviyesine özel, kapsamlı ve sistematik eğitim programları</p>
            </div>

            <div class="row g-4">
                @foreach($vip_packages as $package)
                <!-- 5. SINIF PAKETİ - Taze Başlangıç -->
                <div class="col-12 col-lg-6 col-xl-3">
                    
                    <div class="card package-card package-{{$package->grade}}" {{ $package->grade == 8 ? 'style="position: relative; overflow: hidden;"' : '' }}>
                        @if($package->grade == 8)
                            <div class="lgs-badge">LGS HAZIRLIK</div>
                        @endif
                        <div class="card-header">
                            <div class="class-badge badge-class">{{$package->grade}}. SINIF</div>
                            <div class="package-title">{{$package->title}}</div>
                            <div class="package-subtitle">{{$package->subtitle}}</div>
                        </div>
                        <div class="card-body">
                            {!!$package->description!!}

                            <div class="pricing-section">
                                <div class="price-tag">{{$package->price}} ₺</div>
                                <div class="price-period">Aylık</div>
                                <button class="btn btn-package add-to-cart-btn" data-grade="{{ $package->grade }}" data-package-id="{{ $package->id }}" data-package-type="package">
                                    <i class="bi bi-cart-plus me-2"></i>Satın al
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- 8. SINIF PAKETİ - LGS Maratonu -->
                <!--<div class="col-12 col-lg-6 col-xl-3">
                    <div class="card package-card package-8" style="position: relative; overflow: hidden;">
                        <div class="lgs-badge">LGS HAZIRLIK</div>
                        <div class="card-header">
                            <div class="class-badge badge-class">8. SINIF</div>
                            <div class="package-title">LGS Maratonu</div>
                            <div class="package-subtitle">Tam Donanımlı Sınav Hazırlığı</div>
                        </div>
                        <div class="card-body">
                            <ul class="features-list">
                                <li class="feature-item">
                                    <div class="feature-icon icon-float">
                                        <i class="bi bi-camera-video-fill"></i>
                                    </div>
                                    <div class="feature-content">
                                        <div class="feature-title">Canlı Dersler</div>
                                        <div class="feature-desc">Haftada 15 LGS odaklı ders</div>
                                    </div>
                                    
                                </li>
                                
                                <li class="feature-item">
                                    <div class="feature-icon icon-pulse">
                                        <i class="bi bi-file-earmark-text-fill"></i>
                                    </div>
                                    <div class="feature-content">
                                        <div class="feature-title">Deneme Sınavları</div>
                                        <div class="feature-desc">Ayda 1 deneme + LGS arşivi</div>
                                    </div>
                                    
                                </li>

                                <li class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-journal-check"></i>
                                    </div>
                                    <div class="feature-content">
                                        <div class="feature-title">Ödevlendirme</div>
                                        <div class="feature-desc">Soru bankası ve deneme takibi</div>
                                    </div>
                                    
                                </li>

                                <li class="feature-item">
                                    <div class="feature-icon icon-rotate">
                                        <i class="bi bi-lightbulb-fill"></i>
                                    </div>
                                    <div class="feature-content">
                                        <div class="feature-title">Koçluk Hizmeti</div>
                                        <div class="feature-desc">Haftada 1 özel seanslar</div>
                                    </div>
                                    
                                </li>

                                <li class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-bell-fill"></i>
                                    </div>
                                    <div class="feature-content">
                                        <div class="feature-title">Veli Bilgilendirme</div>
                                        <div class="feature-desc">Aylık rapor ve toplantı</div>
                                    </div>
                                    
                                </li>

                                <li class="feature-item">
                                    <div class="feature-icon icon-pulse">
                                        <i class="bi bi-bar-chart-line-fill"></i>
                                    </div>
                                    <div class="feature-content">
                                        <div class="feature-title">Başarı Takibi</div>
                                        <div class="feature-desc">İl/ilçe sıralaması ve analiz</div>
                                    </div>
                                    
                                </li>
                            </ul>

                            <div class="pricing-section">
                                <div class="price-tag">₺1.799</div>
                                <div class="price-period">Aylık / 12 Taksit</div>
                                <button class="btn btn-package">
                                    <i class="bi bi-rocket me-2"></i>LGS'ye Hazırlan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>-->

            </div>

           
            <!-- CTA Bölümü -->
            <div class="row mt-5 mb-5">
                <div class="col-12 text-center">
                    <div class="p-5 rounded-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <h2 class="text-white mb-3">Hangi Paket Size Uygun?</h2>
                        <p class="text-white-50 mb-4 fs-5">Ücretsiz deneme dersi ile başlayın, farkı görün!</p>
                        <button class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg">
                            <i class="bi bi-calendar-check me-2"></i>Ücretsiz Deneme Dersi Al
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection

@section('scripts')

        <script>
            $(document).ready(function() {
                // Add to cart Ajax function
                $('.add-to-cart-btn').click(function(e) {
                    e.preventDefault();
                    var packageId = $(this).data('package-id');
                    var type = $(this).data('package-type');
                    $.ajax({
                        url: '{{ route("student.cart.add") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            package_id: packageId,
                            item_type: type
                        },
                        success: function(response) {
                            alert('Paket sepete eklendi!');
                            //redirect to cart page
                            window.location.href = '{{ route("student.cart.index") }}';
                        },
                        error: function(xhr) {
                            alert('Sepete eklenirken bir hata oluştu.');
                        }
                    });
                });
            })
        </script>

@endsection


