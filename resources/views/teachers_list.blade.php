@extends('layouts.main')


@section('content')
<main>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap');

        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }

        /* Hero Section */
        .hero-section {
            background: var(--primary-gradient);
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .hero-content {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Filtreleme Bölümü */
        .filter-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-top: -3rem;
            position: relative;
            z-index: 10;
            margin-bottom: 3rem;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            border: 2px solid #e9ecef;
            border-radius: 50px;
            padding: 1rem 1.5rem 1rem 3rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .search-box i {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .filter-btn {
            border: 2px solid #e9ecef;
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            background: white;
            color: #495057;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-btn:hover, .filter-btn.active {
            border-color: #667eea;
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .filter-dropdown {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 0.8rem 1.2rem;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-dropdown:focus {
            border-color: #667eea;
            outline: none;
        }

        /* İstatistikler */
        .stats-bar {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            padding: 1rem 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Öğretmen Kartları */
        .teacher-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            position: relative;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .teacher-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        .teacher-header {
            position: relative;
            height: 200px;
            overflow: hidden;
            text-align: center;
            padding: 20px;
        }

        .teacher-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .teacher-avatar-wrapper {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 5px solid white;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            background: white;
        }

        .teacher-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .teacher-status {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 15px;
            height: 15px;
            background: #2ecc71;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .teacher-status.offline {
            background: #95a5a6;
        }

        .teacher-status.busy {
            background: #e74c3c;
        }

        .teacher-body {
            padding: 3.5rem 1.5rem 1.5rem;
            text-align: center;
        }

        .teacher-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 0.25rem;
        }

        .teacher-subject {
            color: #667eea;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        .teacher-grade {
            display: inline-block;
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .teacher-bio {
            color: #636e72;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .teacher-stats {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            padding: 1rem 0;
            border-top: 1px solid #f0f0f0;
            border-bottom: 1px solid #f0f0f0;
        }

        .teacher-stat {
            text-align: center;
        }

        .teacher-stat-value {
            font-weight: 700;
            color: #2d3436;
            font-size: 1.1rem;
        }

        .teacher-stat-label {
            font-size: 0.75rem;
            color: #b2bec3;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .teacher-rating {
            margin-bottom: 1.5rem;
        }

        .stars {
            color: #f1c40f;
            font-size: 1.1rem;
            letter-spacing: 2px;
        }

        .rating-count {
            color: #b2bec3;
            font-size: 0.85rem;
            margin-left: 0.5rem;
        }

        .teacher-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn-teacher {
            flex: 1;
            border-radius: 50px;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-profile {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .btn-profile:hover {
            background: #667eea;
            color: white;
        }

        .btn-book {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-book:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Rozetler */
        .teacher-badges {
            position: absolute;
            top: 15px;
            left: 15px;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .badge-teacher {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .badge-verified {
            background: var(--success-gradient);
        }

        .badge-popular {
            background: var(--warning-gradient);
        }

        .badge-new {
            background: var(--secondary-gradient);
        }

        /* Branş Filtreleme Chip'leri */
        .subject-chips {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .chip {
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            background: white;
            border: 2px solid #e9ecef;
            color: #495057;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .chip:hover, .chip.active {
            background: var(--primary-gradient);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .chip i {
            font-size: 1.1rem;
        }

        /* Boş Durum */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 5rem;
            color: #dee2e6;
            margin-bottom: 1.5rem;
        }

        /* Loading Skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 10px;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Modal Stili */
        .teacher-modal .modal-content {
            border-radius: 25px;
            border: none;
            overflow: hidden;
        }

        .teacher-modal .modal-header {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 2rem;
        }

        .teacher-modal .modal-body {
            padding: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .stats-bar {
                gap: 1rem;
            }
            
            .stat-item {
                padding: 0.75rem 1rem;
            }
            
            .filter-section {
                padding: 1.5rem;
            }
        }

        /* Animasyonlar */
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Sıralama Seçenekleri */
        .sort-select {
            border: 2px solid #e9ecef;
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            background: white;
            cursor: pointer;
            font-weight: 500;
            color: #495057;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title"><i class="bi bi-people-fill me-3"></i>Öğretmen Kadromuz</h1>
                <p class="hero-subtitle">Her biri alanında uzman, sertifikalı ve deneyimli öğretmenlerden oluşan kadromuzla kaliteli eğitim garantisi.</p>
            </div>
        </div>
    </section>

    <div class="container">
        <!-- Filtreleme Bölümü -->
        <!--<div class="filter-section">
            <div class="row g-3 align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" class="form-control" placeholder="Öğretmen adı veya branş ara...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <select class="filter-dropdown w-100">
                        <option>Tüm Sınıflar</option>
                        <option>5. Sınıf</option>
                        <option>6. Sınıf</option>
                        <option>7. Sınıf</option>
                        <option>8. Sınıf (LGS)</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <button class="btn btn-primary w-100 rounded-pill py-2 fw-bold">
                        <i class="bi bi-funnel-fill me-2"></i>Filtrele
                    </button>
                </div>
            </div>
        </div>-->

        <!-- İstatistikler -->
        <!--<div class="stats-bar">
            <div class="stat-item">
                <div class="stat-number">40+</div>
                <div class="stat-label">Aktif Öğretmen</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">12</div>
                <div class="stat-label">Branş</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">3000+</div>
                <div class="stat-label">Öğrenci</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">4.8</div>
                <div class="stat-label">Ortalama Puan</div>
            </div>
        </div>-->

        <!-- Branş Filtreleme -->
        <div class="subject-chips">
            <div class="chip active">
                <i class="bi bi-grid-fill"></i> Tümü
            </div>
            <div class="chip">
                <i class="bi bi-calculator"></i> Matematik
            </div>
            <div class="chip">
                <i class="bi bi-flask"></i> Fen Bilimleri
            </div>
            <div class="chip">
                <i class="bi bi-book"></i> Türkçe
            </div>
            <div class="chip">
                <i class="bi bi-globe"></i> Sosyal Bilgiler
            </div>
            <div class="chip">
                <i class="bi bi-translate"></i> İngilizce
            </div>
            <div class="chip">
                <i class="bi bi-atom"></i> Din Kültürü
            </div>
        </div>

        <!-- Öğretmen Grid -->
        <div class="row g-4">
            
            <!-- Öğretmen 1 -->
             @foreach($teachers as $teacher)
                                
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="teacher-card fade-in-up">
                    <!--<div class="teacher-badges">
                        <span class="badge-teacher badge-verified"><i class="bi bi-check-circle-fill me-1"></i>Onaylı</span>
                    </div>-->
                    <div class="teacher-status"></div>
                    <div class="teacher-header">
                        <img src="{{ env('APP_URL') . '/' . $teacher->image }}" class="profile-img" width="180" alt="">
                    </div>
                    <div class="teacher-body">
                        <h3 class="teacher-name">{{ $teacher->name }}</h3>
                        <div class="teacher-subject">{{ $teacher->branch }} Öğretmeni</div>
                        <span class="teacher-grade">5-6-7-8. Sınıf</span>
                        
                        <div class="teacher-stats">
                            <div class="teacher-stat">
                                <div class="teacher-stat-value">100+</div>
                                <div class="teacher-stat-label">Ders</div>
                            </div>
                            <div class="teacher-stat">
                                <div class="teacher-stat-value">500+</div>
                                <div class="teacher-stat-label">Öğrenci</div>
                            </div>
                            <div class="teacher-stat">
                                <div class="teacher-stat-value">{{ $teacher->experience }}</div>
                                <div class="teacher-stat-label">Yıl</div>
                            </div>
                        </div>

                        <div class="teacher-rating">
                            <span class="stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </span>
                            <span class="rating-count">(128 değerlendirme)</span>
                        </div>

                        <div class="teacher-actions">
                            <a href="{{route('teacher.public.profile', $teacher->id)}}" class="btn btn-teacher btn-profile">
                                <i class="bi bi-person me-1"></i> Profil
                            </a>
                            <button class="btn btn-teacher btn-book add-to-cart-btn" data-package-id="{{ $teacher->id }}" data-package-type="lesson">
                                <i class="bi bi-calendar-plus me-1"></i> Ders Al
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link rounded-start-pill" href="#" tabindex="-1">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link rounded-end-pill" href="#">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="p-5 rounded-4 text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h2 class="text-white mb-3">Size Uygun Öğretmeni Bulamadınız mı?</h2>
                    <p class="text-white-50 mb-4">Uzman ekibimiz size en uygun öğretmeni önerelim</p>
                    <button class="btn btn-light btn-lg rounded-pill px-5 fw-bold">
                        <i class="bi bi-chat-dots me-2"></i>Bize Ulaşın
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Arama fonksiyonu
        document.querySelector('.search-box input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.teacher-card');
            
            cards.forEach(card => {
                const name = card.querySelector('.teacher-name').textContent.toLowerCase();
                const subject = card.querySelector('.teacher-subject').textContent.toLowerCase();
                
                if (name.includes(searchTerm) || subject.includes(searchTerm)) {
                    card.closest('.col-12').style.display = 'block';
                } else {
                    card.closest('.col-12').style.display = 'none';
                }
            });
        });

        // Chip seçimi
        document.querySelectorAll('.chip').forEach(chip => {
            chip.addEventListener('click', function() {
                document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Kart animasyonu için intersection observer
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

        document.querySelectorAll('.teacher-card').forEach((card, index) => {
            card.style.opacity = "0";
            card.style.transform = "translateY(20px)";
            card.style.transition = `all 0.6s ease ${index * 0.1}s`;
            observer.observe(card);
        });
    </script>
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
</main>

@endsection


