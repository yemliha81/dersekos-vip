@extends('layouts.main')


@section('content')
<main>
 <?php $avg = $reviews->avg('rating'); // round value to 2 decimals
  $avg = number_format($avg, 2);?>



    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        /* Profil Header */
        .profile-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 4rem 0 8rem;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(5deg); }
        }

        .profile-card {
            background: white;
            border-radius: 30px;
            padding: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
            margin-top: -6rem;
            position: relative;
            z-index: 10;
        }

        .avatar-wrapper {
            position: relative;
            display: inline-block;
        }

        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            object-fit: cover;
        }

        .verified-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 40px;
            height: 40px;
            background: var(--success-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: 3px solid white;
            font-size: 1.2rem;
        }

        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .status-indicator::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--success-color);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Content Sections */
        .content-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #1e293b;
        }

        .section-title i {
            color: var(--primary-color);
        }

        /* About Section */
        .about-text {
            color: #475569;
            line-height: 1.8;
            font-size: 1rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: rgba(102, 126, 234, 0.1);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .info-content h6 {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #1e293b;
        }

        .info-content p {
            color: #64748b;
            margin: 0;
            font-size: 0.9rem;
        }

        /* Skills */
        .skill-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(102, 126, 234, 0.1);
            color: var(--primary-color);
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.9rem;
            margin: 0.25rem;
            transition: all 0.3s ease;
        }

        .skill-tag:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Calendar */
        .calendar-widget {
            background: #f8fafc;
            border-radius: 15px;
            padding: 1.5rem;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
            text-align: center;
        }

        .calendar-day-header {
            font-weight: 600;
            color: #64748b;
            font-size: 0.85rem;
            padding: 0.5rem;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
        }

        .calendar-day:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .calendar-day.active {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .calendar-day.has-slot::after {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--success-color);
            border-radius: 50%;
            position: absolute;
            bottom: 4px;
        }

        .calendar-day.disabled {
            color: #cbd5e1;
            cursor: not-allowed;
        }

        /* Time Slots */
        .time-slot {
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .time-slot:hover {
            border-color: var(--primary-color);
            background: rgba(102, 126, 234, 0.05);
        }

        .time-slot.selected {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .time-slot.booked {
            background: #f1f5f9;
            border-color: #f1f5f9;
            color: #94a3b8;
            cursor: not-allowed;
            text-decoration: line-through;
        }

        /* Reviews */
        .review-card {
            background: #f8fafc;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .review-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transform: translateX(5px);
        }

        .reviewer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .review-stars {
            color: #fbbf24;
            font-size: 0.9rem;
        }

        .review-text {
            color: #475569;
            line-height: 1.6;
            margin-top: 0.75rem;
        }

        /* Pricing Card */
        .pricing-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 20px;
            padding: 2rem;
            color: white;
            position: sticky;
            top: 2rem;
        }

        .price-tag {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .price-period {
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }

        .feature-list li {
            padding: 0.75rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .btn-book {
            background: white;
            color: var(--primary-color);
            border: none;
            padding: 1rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .btn-book:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }

        /* Progress Bars */
        .progress-item {
            margin-bottom: 1.5rem;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .progress {
            height: 10px;
            border-radius: 10px;
            background: #e2e8f0;
        }

        .progress-bar {
            border-radius: 10px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        /* Gallery */
        .gallery-item {
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-header {
                padding: 2rem 0 6rem;
            }
            
            .avatar {
                width: 120px;
                height: 120px;
            }
            
            .price-tag {
                font-size: 2rem;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Tab Navigation */
        .nav-tabs-custom {
            border: none;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .nav-tabs-custom .nav-link {
            border: none;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            color: #64748b;
            font-weight: 600;
            background: #f1f5f9;
            transition: all 0.3s ease;
        }

        .nav-tabs-custom .nav-link:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .nav-tabs-custom .nav-link.active {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        /* Achievement Badges */
        .achievement {
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .achievement:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .achievement-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
        }

        .achievement.gold .achievement-icon { background: linear-gradient(135deg, #ffd700, #ffed4e); color: #b8860b; }
        .achievement.silver .achievement-icon { background: linear-gradient(135deg, #c0c0c0, #e8e8e8); color: #808080; }
        .achievement.bronze .achievement-icon { background: linear-gradient(135deg, #cd7f32, #daa520); color: #8b4513; }
    </style>


    <!-- Profile Header -->
    <section class="profile-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center text-white">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="#" class="text-white-50">Ana Sayfa</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-white-50">Öğretmenler</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ $teacher->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <!-- Profile Card -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="profile-card fade-in">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center mb-4 mb-md-0">
                            <div class="avatar-wrapper">
                                @if($teacher->image == null)
                                        <img src="{{ asset('assets/img/default-image.png') }}" class="profile-img" width="80" alt="">
                                    @else
                                    <img src="{{ env('APP_URL') . '/' . $teacher->image }}" class="profile-img" width="80" alt="">
                                    @endif
                                <div class="verified-badge" title="Onaylı Öğretmen">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 mb-2">
                                <h1 class="h2 fw-bold mb-0">{{$teacher->name}}</h1>
                                <span class="badge bg-primary">PRO</span>
                            </div>
                            <p class="text-primary fw-semibold mb-2">
                                <i class="bi bi-calculator me-2"></i>{{$teacher->branch}} Öğretmeni
                            </p>
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                                <span class="review-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </span>
                                <span class="fw-bold">{{$avg}}</span>
                                <span class="text-muted">({{$reviews->count()}} değerlendirme)</span>
                            </div>
                        </div>
                        <div class="col-md-3 text-center text-md-end">
                            <button class="btn btn-teacher btn-book add-to-cart-btn" data-package-id="{{ $teacher->id }}" data-package-type="lesson">
                                <i class="bi bi-calendar-plus me-1"></i> Ders Al
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="row g-4 mt-2 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-camera-video"></i>
                    </div>
                    <div class="stat-value">200+</div>
                    <div class="stat-label">Tamamlanan Ders</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-value">50+</div>
                    <div class="stat-label">Aktif Öğrenci</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="stat-value">10</div>
                    <div class="stat-label">Yıllık Deneyim</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <div class="stat-value">%94</div>
                    <div class="stat-label">Başarı Oranı</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                
                <!-- About Section -->
                <div class="content-section fade-in">
                    <h3 class="section-title">
                        <i class="bi bi-person-circle"></i>Hakkında
                    </h3>
                    <p class="about-text">
                        {{$teacher->about}}
                    </p>
                    
                    <div class="mt-4">
                        <h6 class="fw-bold mb-3">Uzmanlık Alanları</h6>
                        <div class="d-flex flex-wrap gap-2">
                          <?php $tags = explode(',', $teacher->tags); ?>
                            @foreach($tags as $tag)
                            <span class="skill-tag"><i class="bi bi-check-circle"></i>{{$tag}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Education & Experience -->
                <!--<div class="content-section fade-in">
                    <h3 class="section-title">
                        <i class="bi bi-mortarboard"></i>Eğitim & Deneyim
                    </h3>
                    
                    <div class="timeline">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="info-content">
                                <h6>ODTÜ - Matematik Bölümü</h6>
                                <p>Lisans Derecesi • 2008 - 2012</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-patch-check"></i>
                            </div>
                            <div class="info-content">
                                <h6>Öğretmenlik Formasyonu</h6>
                                <p>MEB Onaylı • 2012</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="info-content">
                                <h6>Kurumsal Deneyim</h6>
                                <p>Özel Ders ve Online Eğitim • 2014 - Günümüz</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-award"></i>
                            </div>
                            <div class="info-content">
                                <h6>Eğitim Koçluğu Sertifikası</h6>
                                <p>Uluslararası Geçerli • 2018</p>
                            </div>
                        </div>
                    </div>
                </div>-->

                <!-- Performance Stats -->
                <div class="content-section fade-in">
                    <h3 class="section-title">
                        <i class="bi bi-bar-chart-line"></i>Performans İstatistikleri
                    </h3>
                    
                    <div class="progress-item">
                        <div class="progress-header">
                            <span>LGS Başarı Oranı</span>
                            <span>%94</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 94%"></div>
                        </div>
                    </div>
                    
                    <div class="progress-item">
                        <div class="progress-header">
                            <span>Öğrenci Memnuniyeti</span>
                            <span>%98</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 98%"></div>
                        </div>
                    </div>
                    
                    <div class="progress-item">
                        <div class="progress-header">
                            <span>Ders Tamamlama Oranı</span>
                            <span>%96</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 96%"></div>
                        </div>
                    </div>
                    
                    <div class="progress-item">
                        <div class="progress-header">
                            <span>Zamanında Başlama</span>
                            <span>%99</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 99%"></div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="content-section fade-in">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="section-title mb-0">
                            <i class="bi bi-chat-square-text"></i>Öğrenci Yorumları
                        </h3>
                        <!--<button class="btn btn-outline-primary rounded-pill btn-sm">
                            Tümünü Gör (128)
                        </button>-->
                    </div>
                    @foreach($reviews as $review)
                    <div class="review-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex gap-3">
                                <i class="bi bi-person"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">{{maskName($review->student->name) }}</h6>
                                    <small class="text-muted"></small>
                                    <div class="review-stars mt-1">
                                         @for($i = 1; $i <= $review->rating; $i++)
                                        <i class="bi bi-star-fill"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">2 hafta önce</small>
                        </div>
                        <p class="review-text">
                            {{$review->comment}}
                        </p>
                    </div>
                    @endforeach

                </div>

                <!-- Gallery -->
                <!--<div class="content-section fade-in">
                    <h3 class="section-title">
                        <i class="bi bi-images"></i>Derslerden Kareler
                    </h3>
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="gallery-item">
                                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=400&fit=crop" alt="Lesson">
                                <div class="gallery-overlay">
                                    <i class="bi bi-zoom-in text-white fs-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="gallery-item">
                                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=400&h=400&fit=crop" alt="Lesson">
                                <div class="gallery-overlay">
                                    <i class="bi bi-zoom-in text-white fs-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="gallery-item">
                                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=400&fit=crop" alt="Lesson">
                                <div class="gallery-overlay">
                                    <i class="bi bi-zoom-in text-white fs-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

            </div>

            <!-- Right Column - Booking -->
            <div class="col-lg-4">
                
                <!-- Pricing Card -->
                <div class="pricing-card mb-4">
                    <div class="text-center mb-4">
                        <div class="price-tag">{{$teacher->lesson_price}} ₺</div>
                        <div class="price-period">saatlik / Birebir Ders</div>
                    </div>
                    
                    <ul class="feature-list">
                        <li><i class="bi bi-check-circle-fill"></i> 55 dakika canlı ders</li>
                        <li><i class="bi bi-check-circle-fill"></i> Ders kaydı ve notları</li>
                        <li><i class="bi bi-check-circle-fill"></i> Ödev takibi ve kontrolü</li>
                        <li><i class="bi bi-check-circle-fill"></i> 7/24 WhatsApp desteği</li>
                        <li><i class="bi bi-check-circle-fill"></i> İptal garantisi (24s önce)</li>
                    </ul>
                    
                    <button class="btn-book">
                        <i class="bi bi-calendar-check me-2"></i>Hemen Ders Talep Et
                    </button>
                    
                    <p class="text-center mt-3 mb-0" style="font-size: 0.9rem; opacity: 0.9;">
                        <i class="bi bi-shield-check me-1"></i>Güvenli ödeme garantisi
                    </p>
                </div>

                <!-- Quick Info -->
                <div class="content-section bg-light border-0">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-info-circle me-2 text-primary"></i>Hızlı Bilgi
                    </h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="bi bi-check-circle-fill text-success mt-1"></i>
                            <span>İlk ders için %20 indirim</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <i class="bi bi-check-circle-fill text-success mt-1"></i>
                            <span>Grup dersi imkanı (max 3 kişi)</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="bi bi-check-circle-fill text-success mt-1"></i>
                            <span>24 saat öncesine kadar ücretsiz iptal</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Calendar day selection
        document.querySelectorAll('.calendar-day:not(.disabled)').forEach(day => {
            day.addEventListener('click', function() {
                document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Time slot selection
        document.querySelectorAll('.time-slot:not(.booked)').forEach(slot => {
            slot.addEventListener('click', function() {
                document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px"
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach((el, index) => {
            el.style.opacity = "0";
            el.style.transform = "translateY(20px)";
            el.style.transition = `all 0.6s ease ${index * 0.1}s`;
            observer.observe(el);
        });
    </script>

</main>


@endsection

@section('scripts')

        <script>
            $(document).ready(function() {
                // Add to cart Ajax function
                $('.add-to-cart-btn').click(function(e) {
                    e.preventDefault();
                    var packageId = $(this).data('package-id');
                    var packageType = $(this).data('package-type');
                    $.ajax({
                        url: '{{ route("student.cart.add") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            teacher_id: packageId,
                            item_type: 'lesson'
                        },
                        success: function(response) {
                            alert('Ders sepetinize eklenmiştir!');
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
