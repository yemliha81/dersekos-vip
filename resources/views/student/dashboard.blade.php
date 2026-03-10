@extends('layouts.main')


@section('content')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* Sidebar Stili */
        .sidebar-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            position: sticky;
            top: 20px;
        }

        .sidebar-header {
            background: var(--primary-gradient);
            color: white;
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .student-avatar {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: white;
            border: 3px solid rgba(255,255,255,0.3);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            border-bottom: 1px solid #f0f0f0;
        }

        .sidebar-menu li:last-child {
            border-bottom: none;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: #555;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            cursor: pointer;
            border-left: 4px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: linear-gradient(90deg, #667eea15 0%, transparent 100%);
            color: #667eea;
            border-left-color: #667eea;
        }

        .sidebar-menu i {
            margin-right: 12px;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-menu .badge {
            margin-left: auto;
            background: var(--warning-gradient);
            color: white;
            border-radius: 20px;
            padding: 0.4em 0.8em;
            font-size: 0.75rem;
        }

        /* Ana İçerik Stili */
        .main-content-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            min-height: 600px;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.4s ease-in-out;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .content-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .content-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .content-header h2 {
            margin: 0;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .content-body {
            padding: 2rem;
        }

        /* Paket Kartları */
        .package-card {
            border: none;
            border-radius: 20px;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            cursor: pointer;
        }

        .package-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .package-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        }

        .package-card.okul-destek { background: var(--success-gradient); }
        .package-card.yazili-kampi { background: var(--warning-gradient); }
        .package-card.ozel-ders { background: var(--info-gradient); }

        .package-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .package-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .package-status {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
            backdrop-filter: blur(10px);
        }

        /* Ders Listesi */
        .lesson-item {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .lesson-item:hover {
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transform: translateX(5px);
        }

        .lesson-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            flex-shrink: 0;
        }

        .lesson-info {
            flex: 1;
        }

        .lesson-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #333;
        }

        .lesson-meta {
            color: #666;
            font-size: 0.9rem;
        }

        .lesson-action {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
        }

        /* Takvim */
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
            text-align: center;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #f8f9fa;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .calendar-day:hover {
            background: #e9ecef;
        }

        .calendar-day.active {
            background: var(--primary-gradient);
            color: white;
        }

        .calendar-day.has-event::after {
            content: '';
            width: 6px;
            height: 6px;
            background: #ff6b6b;
            border-radius: 50%;
            position: absolute;
            bottom: 4px;
        }

        /* Sınav Kartları */
        .exam-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            border-left: 5px solid;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .exam-card.upcoming { border-left-color: #667eea; }
        .exam-card.completed { border-left-color: #38ef7d; }
        .exam-card.missed { border-left-color: #ff6b6b; }

        /* İlerleme Çubuğu */
        .progress-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: conic-gradient(#667eea var(--progress), #e9ecef 0deg);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin: 0 auto;
        }

        .progress-circle::before {
            content: '';
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            position: absolute;
        }

        .progress-text {
            position: relative;
            z-index: 1;
            font-weight: 700;
            font-size: 1.5rem;
            color: #667eea;
        }

        /* Ayarlar Form */
        .settings-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 1.5rem;
        }

        .form-floating > label {
            color: #666;
        }

        .btn-save {
            background: var(--success-gradient);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
        }

        /* Mobil Uyumluluk */
        @media (max-width: 768px) {
            .sidebar-card {
                position: relative;
                top: 0;
                margin-bottom: 1.5rem;
            }
            
            .content-header {
                padding: 1.5rem;
                text-align: center;
            }
            
            .lesson-item {
                flex-direction: column;
                text-align: center;
            }
        }

        /* Boş Durum */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #666;
        }

        .empty-state i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 1rem;
        }

        /* Tablo */
        .custom-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .custom-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #555;
            border: none;
            padding: 1rem;
        }

        .custom-table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .status-badge {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-badge.success { background: #d4edda; color: #155724; }
        .status-badge.pending { background: #fff3cd; color: #856404; }
        .status-badge.cancelled { background: #f8d7da; color: #721c24; }

        .rocking-btn {
            font-size: 1.2rem;
            padding: 12px 24px;
            border: 2px dashed #FFFFFF;
            border-radius: 8px;
            background: #4f46e5;
            color: white;
            cursor: pointer;
            display:inline-block;
            transform-origin: center;
            animation: rock .5s ease-in-out infinite;
            }

            @keyframes rock {
            0%   { transform: rotate(0deg); }
            25%  { transform: rotate(5deg); }
            50%  { transform: rotate(0deg); }
            75%  { transform: rotate(-5deg); }
            100% { transform: rotate(0deg); }
            }

            .spin {
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
            }
    </style>

<main>

    <div class="container-fluid py-4">
        <div class="row g-4">
            <!-- Sol Sidebar -->
            <div class="col-12 col-md-3">
                <div class="card sidebar-card">
                    <div class="sidebar-header">
                        <div class="student-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                        <small class="opacity-75">{{ Auth::user()->grade }}. Sınıf Öğrencisi</small>
                    </div>
                    <div class="card-body p-0">
                        <ul class="sidebar-menu">
                            <li><a href="#" class="tab-link active" data-tab="dashboard">
                                <i class="bi bi-speedometer2"></i>Ana Sayfa</a>
                            </li>
                            <!--<li><a href="#" class="tab-link" data-tab="lessons">
                                <i class="bi bi-collection-play"></i>Derslerim
                                <span class="badge">3</span></a></li>
                            <li><a href="#" class="tab-link" data-tab="calendar">
                                <i class="bi bi-calendar-check"></i>Takvimim</a></li>
                            <li><a href="#" class="tab-link" data-tab="exams">
                                <i class="bi bi-file-earmark-text"></i>Sınavlarım</a></li>-->
                            
                            
                            <li>
                                <a href="#" class="tab-link" data-tab="progress">
                                <i class="bi bi-youtube"></i>Ders Kayıtları</a>
                            </li>
                            <li><a href="#" class="tab-link" data-tab="payments">
                                <i class="bi bi-credit-card"></i>Ödemelerim</a>
                            </li>
                            <li><a href="#" class="tab-link" data-tab="settings">
                                <i class="bi bi-gear"></i>Ayarlar</a>
                            </li>
                            <li><a href="{{ route('student.logout') }}" class="text-danger">
                                <i class="bi bi-box-arrow-right"></i>Çıkış Yap</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Sağ Ana İçerik -->
            <div class="col-12 col-md-9">
                <div class="card main-content-card">
                    
                    <!-- 1. ANA SAYFA (DASHBOARD) -->
                    <div id="dashboard" class="tab-content active">
                        <div class="content-header">
                            <h2>Hoş Geldin, <b>{{ explode(" ", Auth::user()->name )[0] }}!</b> 👋</h2>
                            <p class="mb-0 mt-2 opacity-75">Bugün hangi derse çalışmak istersin?</p>
                        </div>
                        <div class="content-body">
                            
                            <?php use Carbon\Carbon; ?>
                            
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        <i class="bi bi-award me-2"></i>
                                        <div>
                                            VIP Üyeliğiniz Aktif! 
                                            <!--Bitiş Tarihi: {{ date("d.m.Y H:i", strtotime(auth('student')->user()->vip_end)) }}  -->
                                        </div>
                                    </div>

                                    <!-- List VIP Lessons --> 
                                    @foreach($vip_lessons as $vip_lesson)
                                        <div class="alert alert-info d-flex align-items-center" role="alert">
                                            <i class="bi bi-book me-2"></i>
                                            <div>
                                                <strong>Ders:</strong> {{ $vip_lesson->teacher->branch }} <br>
                                                <strong>Konu:</strong> {{ $vip_lesson->grade }}. Sınıf - {{ $vip_lesson->title }} <br>
                                                <strong>Eğitmen:</strong> {{ $vip_lesson->teacher->name }} <br>
                                                <strong>Başlangıç:</strong> {{ date("d.m.Y H:i", strtotime($vip_lesson->start)) }}
                                                <!--@if($vip_lesson->end > Carbon::now() && $vip_lesson->start < Carbon::now())
                                                    <span class="badge bg-success ms-2">Ders Başladı!</span> <br>
                                                    <a href="{{$vip_lesson->meet_url}}" target="_blank" class="mt-3 form-control btn btn-primary btn-sm">DERSE KOŞ</a>
                                                @endif-->
                                                <div class="row mt-3">
                                                    @if($vip_lesson->end > now())
                                                        <a id="start_{{ $vip_lesson->id }}" lesson-id="{{ $vip_lesson->id }}" target="_blank" href="{{ $vip_lesson->meet_url }}" start-time="{{ $vip_lesson->start }}" end-time="{{ $vip_lesson->end }}" style="display:none;"  class="start_lesson rocking-btn">Derse Koş!</a>
                                                    @endif
                                                    
                                                    @if($vip_lesson->start > now())
                                                        <div class="alert alert-warning alert_{{ $vip_lesson->id }}"><i class="bi bi-alarm"></i> <span class="countdown" id="countdown_{{ $vip_lesson->id }}"></span></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach





                              
                        </div>
                    </div>

                    <!-- 2. DERSLERİM -->
                    <div id="lessons" class="tab-content">
                        <div class="content-header">
                            <h2><i class="bi bi-collection-play me-3"></i>Derslerim</h2>
                            <p class="mb-0 mt-2 opacity-75">Tüm ders içeriklerinize buradan ulaşabilirsiniz</p>
                        </div>
                        <div class="content-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold text-secondary mb-0">Devam Eden Dersler</h5>
                                <select class="form-select w-auto">
                                    <option>Tüm Dersler</option>
                                    <option>Matematik</option>
                                    <option>Fen Bilimleri</option>
                                    <option>Türkçe</option>
                                </select>
                            </div>

                            <div class="lesson-item">
                                <div class="lesson-icon" style="background: var(--primary-gradient);">
                                    <i class="bi bi-calculator"></i>
                                </div>
                                <div class="lesson-info">
                                    <div class="lesson-title">Matematik - Çarpanlara Ayırma</div>
                                    <div class="lesson-meta">
                                        <i class="bi bi-clock me-1"></i>45 dk | 
                                        <i class="bi bi-bar-chart me-1 ms-2"></i>Orta Seviye |
                                        <span class="text-success ms-2"><i class="bi bi-check-circle-fill me-1"></i>%75 Tamamlandı</span>
                                    </div>
                                </div>
                                <button class="lesson-action">Devam Et</button>
                            </div>

                            <div class="lesson-item">
                                <div class="lesson-icon" style="background: var(--success-gradient);">
                                    <i class="bi bi-flask"></i>
                                </div>
                                <div class="lesson-info">
                                    <div class="lesson-title">Fen Bilimleri - Maddenin Halleri</div>
                                    <div class="lesson-meta">
                                        <i class="bi bi-clock me-1"></i>30 dk | 
                                        <i class="bi bi-bar-chart me-1 ms-2"></i>Kolay |
                                        <span class="text-warning ms-2"><i class="bi bi-circle me-1"></i>Yeni Başladın</span>
                                    </div>
                                </div>
                                <button class="lesson-action">Başla</button>
                            </div>

                            <div class="lesson-item">
                                <div class="lesson-icon" style="background: var(--warning-gradient);">
                                    <i class="bi bi-book"></i>
                                </div>
                                <div class="lesson-info">
                                    <div class="lesson-title">Türkçe - Paragraf Anlama</div>
                                    <div class="lesson-meta">
                                        <i class="bi bi-clock me-1"></i>60 dk | 
                                        <i class="bi bi-bar-chart me-1 ms-2"></i>Zor |
                                        <span class="text-secondary ms-2"><i class="bi bi-lock me-1"></i>Kilitli</span>
                                    </div>
                                </div>
                                <button class="lesson-action" disabled>Kilitli</button>
                            </div>
                        </div>
                    </div>

                    <!-- 3. TAKVİMİM -->
                    <div id="calendar" class="tab-content">
                        <div class="content-header">
                            <h2><i class="bi bi-calendar-check me-3"></i>Takvimim</h2>
                            <p class="mb-0 mt-2 opacity-75">Ders programınız ve önemli tarihler</p>
                        </div>
                        <div class="content-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card border-0 shadow-sm mb-4">
                                        <div class="card-header bg-white border-0 pt-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 fw-bold">Şubat 2026</h5>
                                                <div>
                                                    <button class="btn btn-sm btn-outline-primary me-2"><i class="bi bi-chevron-left"></i></button>
                                                    <button class="btn btn-sm btn-outline-primary"><i class="bi bi-chevron-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="calendar-grid mb-2">
                                                <div class="text-muted small">Pt</div>
                                                <div class="text-muted small">Sa</div>
                                                <div class="text-muted small">Ça</div>
                                                <div class="text-muted small">Pe</div>
                                                <div class="text-muted small">Cu</div>
                                                <div class="text-muted small">Ct</div>
                                                <div class="text-muted small">Pa</div>
                                            </div>
                                            <div class="calendar-grid">
                                                <div class="calendar-day text-muted">26</div>
                                                <div class="calendar-day text-muted">27</div>
                                                <div class="calendar-day text-muted">28</div>
                                                <div class="calendar-day text-muted">29</div>
                                                <div class="calendar-day text-muted">30</div>
                                                <div class="calendar-day text-muted">31</div>
                                                <div class="calendar-day">1</div>
                                                <div class="calendar-day">2</div>
                                                <div class="calendar-day">3</div>
                                                <div class="calendar-day active position-relative">4</div>
                                                <div class="calendar-day has-event position-relative">5</div>
                                                <div class="calendar-day">6</div>
                                                <div class="calendar-day">7</div>
                                                <div class="calendar-day">8</div>
                                                <div class="calendar-day has-event position-relative">9</div>
                                                <div class="calendar-day">10</div>
                                                <div class="calendar-day">11</div>
                                                <div class="calendar-day has-event position-relative">12</div>
                                                <div class="calendar-day">13</div>
                                                <div class="calendar-day">14</div>
                                                <div class="calendar-day">15</div>
                                                <div class="calendar-day">16</div>
                                                <div class="calendar-day">17</div>
                                                <div class="calendar-day">18</div>
                                                <div class="calendar-day">19</div>
                                                <div class="calendar-day">20</div>
                                                <div class="calendar-day">21</div>
                                                <div class="calendar-day">22</div>
                                                <div class="calendar-day">23</div>
                                                <div class="calendar-day">24</div>
                                                <div class="calendar-day">25</div>
                                                <div class="calendar-day">26</div>
                                                <div class="calendar-day">27</div>
                                                <div class="calendar-day">28</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-3">Bugün (4 Şubat)</h6>
                                    <div class="card border-0 shadow-sm mb-3 border-start border-4 border-primary">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-primary me-2">14:00</span>
                                                <small class="text-muted">Canlı Ders</small>
                                            </div>
                                            <h6 class="mb-1">Matematik - Problemler</h6>
                                            <small class="text-muted">Mehmet Öğretmen</small>
                                        </div>
                                    </div>
                                    <div class="card border-0 shadow-sm mb-3 border-start border-4 border-success">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-success me-2">16:30</span>
                                                <small class="text-muted">Kayıtlı Ders</small>
                                            </div>
                                            <h6 class="mb-1">Fen Bilimleri</h6>
                                            <small class="text-muted">Konu Anlatımı</small>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-3 mt-4">Yaklaşan</h6>
                                    <div class="card border-0 shadow-sm bg-light">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-warning text-dark me-2">5 Şubat</span>
                                                <small class="text-muted">Sınav</small>
                                            </div>
                                            <h6 class="mb-1">Matematik Yazılısı</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. SINAVLARIM -->
                    <div id="exams" class="tab-content">
                        <div class="content-header">
                            <h2><i class="bi bi-file-earmark-text me-3"></i>Sınavlarım</h2>
                            <p class="mb-0 mt-2 opacity-75">Tüm sınavlarınız ve sonuçlarınız</p>
                        </div>
                        <div class="content-body">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm text-center p-3">
                                        <h3 class="text-primary mb-1">12</h3>
                                        <small class="text-muted">Toplam Sınav</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm text-center p-3">
                                        <h3 class="text-success mb-1">85%</h3>
                                        <small class="text-muted">Ortalama Başarı</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm text-center p-3">
                                        <h3 class="text-warning mb-1">3</h3>
                                        <small class="text-muted">Yaklaşan Sınav</small>
                                    </div>
                                </div>
                            </div>

                            <h5 class="fw-bold text-secondary mb-3">Yaklaşan Sınavlar</h5>
                            <div class="exam-card upcoming">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-2">Matematik Yazılısı</h5>
                                        <p class="mb-1 text-muted"><i class="bi bi-calendar me-2"></i>5 Şubat 2026, Çarşamba</p>
                                        <p class="mb-0 text-muted"><i class="bi bi-clock me-2"></i>10:00 - 11:30</p>
                                    </div>
                                    <span class="badge bg-primary">Yarın</span>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary btn-sm me-2">
                                        <i class="bi bi-book me-1"></i>Çalışma Notları
                                    </button>
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-play me-1"></i>Deneme Çöz
                                    </button>
                                </div>
                            </div>

                            <div class="exam-card upcoming">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-2">Fen Bilimleri Yazılısı</h5>
                                        <p class="mb-1 text-muted"><i class="bi bi-calendar me-2"></i>12 Şubat 2026, Çarşamba</p>
                                        <p class="mb-0 text-muted"><i class="bi bi-clock me-2"></i>13:00 - 14:30</p>
                                    </div>
                                    <span class="badge bg-secondary">8 Gün Kaldı</span>
                                </div>
                            </div>

                            <h5 class="fw-bold text-secondary mb-3 mt-4">Tamamlanan Sınavlar</h5>
                            <div class="exam-card completed">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-2">Türkçe Yazılısı</h5>
                                        <p class="mb-1 text-muted"><i class="bi bi-calendar me-2"></i>15 Ocak 2026</p>
                                    </div>
                                    <span class="badge bg-success">95 Puan</span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-success"><i class="bi bi-check-circle me-1"></i>Harika! Çok iyi hazırlanmışsın.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. İLERLEMEM -->
                    <div id="progress" class="tab-content">
                        <div class="content-header">
                            <h2><i class="bi bi-youtube me-3"></i>Ders Kayıtlarım</h2>
                            <p class="mb-0 mt-2 opacity-75">Ders kayıtlarını buradan izle</p>
                        </div>
                        <div class="content-body">
                            <div class="alert alert-info">
                                Henüz ders kaydınız bulunmuyor.
                            </div>
                        </div>
                    </div>

                    <!-- 7. ÖDEMELERİM -->
                    <div id="payments" class="tab-content">
                        <div class="content-header">
                            <h2><i class="bi bi-credit-card me-3"></i>Ödemelerim</h2>
                            <p class="mb-0 mt-2 opacity-75">Fatura ve ödeme geçmişiniz</p>
                        </div>
                        <div class="content-body">
                            <div class="table-responsive custom-table">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Hizmet Adı</th>
                                            <th>Satın Alma</th>
                                            <th>Bitiş</th>
                                            <th>Fiyat</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $key => $order)
                                            <tr>
                                                <td><strong>{{ $order->description }}</strong></td>
                                                <td>{{ $order->start_date }}</td>
                                                <td>{{ $order->end_date }}</td>
                                                <td>{{ $order->price }}₺</td>
                                                <td><button class="btn btn-sm btn-outline-primary">Fatura</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- 8. AYARLAR -->
                    <div id="settings" class="tab-content">
                        <div class="content-header">
                            <h2><i class="bi bi-gear me-3"></i>Ayarlar</h2>
                            <p class="mb-0 mt-2 opacity-75">Hesap ve güvenlik ayarlarınız</p>
                        </div>
                        <div class="content-body">
                            <div class="settings-section">
                                <h5 class="fw-bold mb-4"><i class="bi bi-person me-2"></i>Profil Bilgileri</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" placeholder="Ad Soyad" value="{{ auth('student')->user()->name }}">
                                            <label for="name">Ad Soyad</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email" placeholder="E-posta" value="{{ auth('student')->user()->email }}">
                                            <label for="email">E-posta Adresi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="tel" class="form-control" id="phone" placeholder="Telefon" value="{{ auth('student')->user()->phone }}">
                                            <label for="phone">Telefon Numarası</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="grade">
                                                <option value="5" {{auth('student')->user()->grade == 5 ? 'selected' : ''}}>5. Sınıf</option>
                                                <option value="6"  {{auth('student')->user()->grade == 6 ? 'selected' : ''}}>6. Sınıf</option>
                                                <option value="7"  {{auth('student')->user()->grade == 7 ? 'selected' : ''}}>7. Sınıf</option>
                                                <option value="8"  {{auth('student')->user()->grade == 8 ? 'selected' : ''}}>8. Sınıf</option>
                                            </select>
                                            <label for="grade">Sınıf</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-save mt-3">
                                    <i class="bi bi-check-lg me-2"></i>Değişiklikleri Kaydet
                                </button>
                            </div>

                            <div class="settings-section">
                                <h5 class="fw-bold mb-4"><i class="bi bi-shield-lock me-2"></i>Güvenlik</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="currentPassword" placeholder="Mevcut Şifre">
                                            <label for="currentPassword">Mevcut Şifre</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="newPassword" placeholder="Yeni Şifre">
                                            <label for="newPassword">Yeni Şifre</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="confirmPassword" placeholder="Şifre Tekrar">
                                            <label for="confirmPassword">Yeni Şifre (Tekrar)</label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-save mt-3">
                                    <i class="bi bi-key me-2"></i>Şifreyi Güncelle
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // TAB Yönetimi
    document.addEventListener('DOMContentLoaded', function() {
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');

        // URL hash kontrolü (sayfa yenilendiğinde aktif tab'ı korur)
        function checkHash() {
            const hash = window.location.hash.replace('#', '');
            if (hash) {
                activateTab(hash);
            }
        }

        // Tab aktifleştirme fonksiyonu
        function activateTab(tabId) {
            // Tüm linklerden active class'ını kaldır
            tabLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-tab') === tabId) {
                    link.classList.add('active');
                }
            });

            // Tüm içerikleri gizle
            tabContents.forEach(content => {
                content.classList.remove('active');
            });

            // İlgili içeriği göster
            const targetContent = document.getElementById(tabId);
            if (targetContent) {
                targetContent.classList.add('active');
                // URL hash güncelle
                window.location.hash = tabId;
            }
        }

        // Tıklama olayları
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const tabId = this.getAttribute('data-tab');
                activateTab(tabId);
            });
        });

        // Sayfa yüklendiğinde hash kontrolü
        checkHash();

        // Hash değiştiğinde kontrol (tarayıcı geri/ileri butonları için)
        window.addEventListener('hashchange', checkHash);
    });

    // Hover efekti için ek stil
    document.querySelectorAll('.hover-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.transition = 'all 0.3s ease';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.start_lesson').each(function() {
            var lessonId = $(this).attr('lesson-id');
            const start_time = $(this).attr('start-time');
            const end_time   = $(this).attr('end-time');

            
            // set interval every second
            setInterval(function() {
                
                //calculate time left
                var timeLeft = Math.floor((Date.parse(start_time) - Date.parse(new Date())) / 1000); 

                var days = Math.floor(timeLeft / 86400); 
                var hours = Math.floor((timeLeft - days * 86400) / 3600); 
                var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60); 
                var seconds = timeLeft - (days * 86400 + hours * 3600 + minutes * 60);

                // Format time left
                var timeLeft = (days > 0 ? days + 'g ' : '') + (hours > 0 ? hours + 's ' : '') + (minutes > 0 ? minutes + 'dk ' : '') + (seconds > 0 ? seconds + 'sn' : '');

                // Set time left
                $('#countdown_' + lessonId).text(timeLeft);

                // Convert to Date objects
                const start = new Date(start_time.replace(' ', 'T'));
                const end   = new Date(end_time.replace(' ', 'T'));
                const now   = new Date();

                // Check if current time is between start and end
                const isBetween = now >= start && now <= end;

                const isFinished = now > end;

                if (isFinished == true) {
                    $(".card_" + lessonId).remove();
                }

                if (isBetween == true) {
                    $("#start_" + lessonId).show();
                    $(".time_info_" + lessonId).hide();
                    $('#countdown_' + lessonId).remove();
                    $('.alert_' + lessonId).remove();
                }else{
                    
                }
            }, 1000)


        });
    })
</script>


@endsection


@section('scripts')

@endsection

