<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  @if(isset($meta_title))
  <?php $meta_title = Str::limit($meta_title, 60); ?>
    <title>Derse Koş! — {{ $meta_title }}</title>
  @else 
    <title>Derse Koş! — Özel Ders Platformu</title>
  @endif
  @if(isset($meta_description))
    <?php $meta_description = Str::limit($meta_description, 160); ?>
  @else 
  <?php $meta_description = "Öğrencileri ve eğitmenleri buluşturan DerseKoş platformuna kayıt olun ve ücretsiz ders fırsatını kaçırmayın! Derse koş! Öğrenci kayıt. Derse koş! Eğitmen kayıt."; ?>
  @endif
  <meta name="description" content="{{ $meta_description }}" />
  <!-- Google Font (optional) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- favicon --> 
  <link rel="icon" type="image/png" href="{{asset('assets/img/dersekos-favicon.png')}}" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">



  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales-all.global.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jquery latest --> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    :root{--primary:#4f46e5;}
    body{font-family:'Work Sans", sans-serif'; background:#f8fafc}
    .profile-cover{background:linear-gradient(90deg, rgba(79,70,229,0.08), rgba(99,102,241,0.02));}
    .avatar{width:140px;object-fit:cover;border-radius:18px;border:6px solid #fff;box-shadow:0 6px 20px rgba(15,23,42,0.08)}
    .badge-subject{background:rgba(79,70,229,0.08);color:var(--primary);font-weight:600;border-radius:10px;padding:.35rem .6rem}
    .stat-num{font-weight:700;font-size:1.25rem}
    .card-rounded{border-radius:14px}
    .review-star{color:#f59e0b}
    .book-btn{background:var(--primary);border:none}
    .book-btn:hover{background:#3b37b4}
    @media (max-width:575px){.avatar{width:110px;border-radius:14px}}
  </style>
  <style>
    .top-info-boxes{
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(284px, 1fr));
      gap: 20px;
    }
    .top-info-box{
      padding: 24px;
      border-radius: 12px;
      background: #901aad;
      color: #fff;
      box-shadow: 0 6px 20px rgba(15,23,42,0.08);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      text-align: center;
    }
    .top-info-box-icon{
      height: 50px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .top-info-box-content{
      display: flex;
      flex-direction: column;
      gap: 8px;
      text-align: center;
    }
    .top-info-box-title{
      color: #ffdd81ff;
    }
  </style>
  <style>
    /* -----------------------------
       Base / Mobile-first
       ----------------------------- */
    :root{
      --bg:#0f1724; /* navy-ish */
      --card:#0b1220;
      --muted:#9aa4b2;
      --accent: #6c7cff; /* primary */
      --accent-2: #4ad6b6;
      --glass: rgba(255,255,255,0.04);
      --radius: 14px;
    }
    *{box-sizing:border-box}
    html,body{height:100%}

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

    .star-rating{
      display: flex;
      align-items: center;
      justify-content: space-around;
    }

    .star-rating label{
      display: inline-flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .grid-20{
      display: grid;
      gap:20px;
    }
    .teacher-profile{
      display: grid;
    grid-template-columns: 300px auto;
    }
    .teachers-grid{
      display: grid; gap:20px;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    }
    .teachers{
      display: grid; gap:12px;
      grid-template-columns:1fr 1fr;
    }
    .teacher-card{
      background:linear-gradient(180deg, rgba(255,255,255,0.02), #666666); padding:14px; border-radius:12px; margin-bottom:12px; border:1px  solid #673AB7;
    }
    .teacher-avatar img{
      border-radius:50%; overflow:hidden; width:80px; height:80px; border:2px solid #fff; box-shadow:0 4px 20px rgba(2,6,23,0.3);
    }
    .teacher-branch{
      color:#FFFFFF;
    }
    .teacher-img{
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .profile-info{
      border: 1px solid #ddd;
      padding: 10px;
      border-radius: 5px;
    }
    .flex-space-between{
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .lessons{
      display: grid; gap:12px;
      grid-template-columns:1fr 1fr;
    }
    .free-lessons{
      display: grid; gap:12px;
      grid-template-columns:1fr 1fr;
    }
    .free-lesson-card{
      background: #ffffff;
      padding: 14px;
      border: 1px solid #ddd;
      border-radius: 12px;
      border-top: 10px solid #3b7515;
      margin-bottom: 12px;
      color: #000000;
      gap: 10px;
    }
    .btnx{
      display: inline-block;
      background: #0ca9e1;
      padding: 8px;
      white-space: nowrap;
      font-size: 14px;
      font-weight: bold;
      color: #FFFFFF;
      border-radius: 5px;
    }
    .join-paid-lesson-btn{
      background: #6c0076;
      display: inline-block;
      color: #FFFFFF;
      padding: 8px;
      font-size: 14px;
      font-weight: bold;
      border-radius: 5px;
      white-space: nowrap;
    }
    .lesson-card{
      background: #ffffff;
      padding: 14px;
      border-radius: 12px;
      border: 1px solid #ddd;
      border-top: 10px solid #09a9e1;
      margin-bottom: 12px;
      justify-content: space-between;
      color: #000000;
      gap: 10px;
    }
    .paid-lesson-card{
      background: #ffffff;
      padding: 14px;
      border-radius: 12px;
      border: 1px solid #ddd;
      border-top: 10px solid #6c0076;
      margin-bottom: 12px;
      justify-content: space-between;
      color: #000000;

    }
    .logo-div{
      display:flex; justify-content:center; align-items:center;
    }
    .logo-div img{
      max-width:100%; display:block;
    }
    body{
      margin:0; 
      font-family: "Work Sans", sans-serif;
      background: #FFFFFF; color:#000000;
      -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale; line-height:1.45;
      padding-top:24px;
    }
    .mb-50{margin-bottom:50px}
    .mt-50{margin-top:50px}
    a{color:inherit; text-decoration:none}
    img{max-width:100%; display:block}

    /* Container */
    .container{max-width:1180px; margin:0 auto}

    /* Sabit Header */
    header{
      position:fixed; top:0; left:0; right:0; z-index:1000;
      background:rgba(7,16,40,.9); backdrop-filter: blur(8px);
      border-bottom:1px solid rgba(255,255,255,0.04)
    }
    header .inner{display:flex; align-items:center; justify-content:space-between; gap:16px; padding:16px 24px}
    .home-header-div{
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px;
      /* border: 1px solid #a6a6a6; */
      border-radius: 10px;
      background: linear-gradient(90deg, #ffffff, #ffffff, #0544ef, #0000b9);
      color: #ffffff;
    }
    .brand{display:flex; align-items:center; gap:12px; color:#FFFFFF;}
    .logo{width:48px; height:48px; border-radius:10px;  display:flex; align-items:center; justify-content:center; font-weight:800; color:#061025}
    .site-title{font-weight:700; font-size:18px}
    .nav{
      display: flex;
      gap: 0;
      align-items: center;
      /* justify-content: end; */
      white-space: nowrap;
      flex-wrap: nowrap;
    }
    .login-div-x{
      border: 1px solid #ddd;
      padding: 15px;
      display: flex;
      flex-direction: column;
      gap: 25px;
      border-radius: 10px;
    }
    .nav a{padding:10px 6px; border-radius:10px; color:var(--muted); font-weight:600}
    .nav a.cta{background:linear-gradient(90deg,var(--accent),var(--accent-2)); color:#061025}

    /* Hero */
    .hero{display:grid; gap:20px; grid-template-columns:1fr; align-items:center; margin-bottom:32px}
    .hero-card{background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); padding:22px; border-radius:18px; box-shadow:0 8px 30px rgba(2,6,23,0.6); display:grid; gap:18px}
    .hero-left h1{font-size:28px; margin:0; line-height:1.05}
    .grid-3{
      display: grid;
      gap: 12px;
      grid-template-columns: repeat(3, 1fr);
    }
    .hero-left p{margin:0; color:var(--muted)}
    .search-row{display:flex; gap:10px; align-items:center}
    .search-row input{flex:1; padding:12px 14px; border-radius:12px; border:1px solid rgba(255,255,255,0.04); background:transparent; color:inherit}
    .btn{display:inline-flex; align-items:center; gap:10px; padding:12px 16px; border-radius:12px; font-weight:700}
   
    .btn-ghost{border:1px solid rgba(255,255,255,0.04); background:transparent; color:var(--muted)}

    /* Stats */
    .stats{display:flex; gap:12px; flex-wrap:wrap}
    .stat{background:var(--glass); padding:10px 12px; border-radius:12px; min-width:120px; text-align:center}
    .stat b{display:block; font-size:18px}

    /* Cards list */
    .cards{display:grid; gap:12px}
    .teacher{display:flex; gap:12px; padding:14px; align-items:center; background:linear-gradient(180deg, rgba(255,255,255,0.02), transparent); border-radius:12px}
    .teacher .meta small{color:var(--muted)}

    /* Features */
    .features{display:grid; gap:12px}
    .feature{padding:14px;; border-radius:12px}

    /* Footer */
    footer{margin-top:28px; padding-top:18px; border-top:1px dashed rgba(255,255,255,0.03); display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap}

    /* Responsive larger screens */
    @media(min-width:820px){
      header{margin-bottom:40px}
      .hero{grid-template-columns:1fr 420px}
      .hero-left h1{font-size:36px}
      .cards{grid-template-columns:repeat(2, minmax(0,1fr))}
      .features{grid-template-columns:repeat(3,1fr)}
      
    }
    @media(min-width:1100px){
      .container{max-width:1260px}
      .cards{grid-template-columns:repeat(3, minmax(0,1fr))}
    }

    /* small utilities */
    .muted{color:var(--muted)}
    .pill{display:inline-block; padding:6px 10px; border-radius:999px; background:rgba(255,255,255,0.03); font-weight:600}
    .tag{font-size:12px; padding:6px 8px; border-radius:8px; background:rgba(255,255,255,0.02)}

    /* subtle hover */
    a:hover, button:hover{transform:translateY(-1px)}
    .teacher:hover{box-shadow:0 10px 30px rgba(2,6,23,0.6)}

  
    /* Carousel */
    .carousel{
      margin: 10px 0 10px 0;
    position: relative;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 8px 30px rgba(2, 6, 23, 0.6);
    }
    .carousel-wrap{position:relative; overflow:hidden; border-radius:18px; background:var(--card)}
    .carousel-track{display:flex;  transition:transform .5s ease}
    .slide{width:100%; flex:0 0 100%; position:relative}
    .slide img{width:100%; height:260px; object-fit:contain; background:#fff}
    .slide-caption{width:33%; color:#000000; background:#FFFFFF; position:absolute; left:16px; right:16px; bottom:16px;  backdrop-filter: blur(6px); padding:12px 14px; border-radius:12px}
    .slide-caption h3{margin:0 0 4px 0; font-size:18px}
    .slide-caption p{margin:0; font-size:14px; color:var(--muted)}

    .carousel input{display:none}
    #c1:checked ~ .carousel-wrap .carousel-track{transform:translateX(0)}
    #c2:checked ~ .carousel-wrap .carousel-track{transform:translateX(-100%)}
    #c3:checked ~ .carousel-wrap .carousel-track{transform:translateX(-200%)}

    .carousel-nav{display:flex; gap:8px; justify-content:center; margin-top:10px}
    .carousel-nav label{width:10px; height:10px; border-radius:50%; background:#000000; cursor:pointer}
    #c1:checked ~ .carousel-nav label[for="c1"],
    #c2:checked ~ .carousel-nav label[for="c2"],
    #c3:checked ~ .carousel-nav label[for="c3"]{background:linear-gradient(90deg,var(--accent),var(--accent-2))}

    .teacher-card{
      background: #92d4ecff; padding:14px; border-radius:12px; margin-bottom:12px; border:1px solid rgba(255,255,255,0.05);
    }

    @media(min-width:820px){
      .slide img{height:320px}
    }

    /* Auth Box */
    .auth-wrap{min-height:calc(100vh - 160px); display:flex; align-items:center; justify-content:center}
    .auth-card{width:100%; max-width:420px; background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); padding:26px; border-radius:20px; box-shadow:0 10px 40px rgba(2,6,23,.7)}

    .tabs{display:grid; grid-template-columns:1fr 1fr; margin-bottom:18px; background:rgba(255,255,255,0.04); border-radius:12px; overflow:hidden}
    .tabs label{text-align:center; padding:12px; font-weight:700; cursor:pointer; color:var(--muted)}

    .auth-card input[type="radio"]{display:none}
    input[type="radio"] {
      appearance: auto;
      -webkit-appearance: radio;
      opacity: 1;
      visibility: visible;
      display: inline-block !important;
      position: static !important;
    }

    input[type="radio"].form-control {
      width: auto;
      height: auto;
    }

    .form-check-input[type="radio"] {
      appearance: auto;
      width: 1em;
      height: 1em;
      border-radius: 50%;
      accent-color: #0d6efd;
      background-color: #fff !important;
      border: 1px solid #0d6efd;
    }

    .form-check-input[type="radio"]:checked {
      background-color: #0d6efd;
      border-color: #0d6efd;
    }

    .camp-photos{
      display:grid; grid-template-columns:1fr 1fr 1fr 1fr 1fr; justify-content:space-around;gap:20px
    }
    .countdown{
      display: inline-block;
      background: orange;
      color: #FFFFFF;
      line-height: 1;
      padding: 4px;
      border-radius: 5px;
      font-size: 14px;
      font-weight: bold;
    }

    #login:checked ~ .tabs label[for="login"],
    #register:checked ~ .tabs label[for="register"]{background:linear-gradient(90deg,var(--accent),var(--accent-2)); color:#061025}

    .star-rating input{
      position: absolute;
      width: 20px;
      height: 20px;
      padding: 0;
      border:1px solid #dddddd;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border-width: 0;
      display:inline-block;
      cursor:pointer;
    }

    .form{display:none}
    #login:checked ~ .form-login{display:block}
    #register:checked ~ .form-register{display:block}

    .form h2{margin:0 0 14px 0}
    .field{display:flex; flex-direction:column; gap:6px; margin-bottom:14px}
    .field label{font-size:13px; color:var(--muted)}
    .field input,select{padding:12px 14px; border-radius:12px; border:1px solid #9E9E9E; background:transparent; color:inherit}

    .btn{display:inline-flex; align-items:center; justify-content:center; padding:12px 16px; border-radius:12px; font-weight:700; border:none}
    .btn-ghost{background:transparent; border:1px solid rgba(255,255,255,0.08); color:var(--muted)}

    .auth-footer{margin-top:12px; font-size:13px; color:var(--muted); text-align:center}

    @media(min-width:820px){
      .auth-card{padding:32px}
    }

    .carousel-wrapper {
      width: min(1000px, 95%);
      max-width: 1000px;
      background: white;
      padding: 18px;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(20,30,60,0.08);
    }

    /* Ortak swiper stilleri */
    .swiper {
      width: 100%;
      height: 320px;
      border-radius: 10px;
      overflow: hidden;
    }

    /* Swiper slide içindeki görselin responsive olması */
    .slide-img {
      width: 100%;
      height: 100%;
      object-fit: cover;   /* kırpma şeklinde güzel görünüm */
      display: block;
    }

    .lesson-title-div{
      display: block;
      margin-bottom: 15px;
      padding: 15px;
      background: #3b7514;
      border-bottom: 1px solid;
      color: #FFF;
      border-radius: 10px;
    }

    .free-lesson-title-div{
      display: block;
      margin-bottom: 15px;
      padding: 15px;
      background: #0ca9e1;
      border-bottom: 1px solid;
      color: #FFF;
      border-radius: 10px;
    }

    .paid-lesson-title-div{
      display: block;
      margin-bottom: 15px;
      padding: 15px;
      background: #6c0076;
      border-bottom: 1px solid;
      color: #FFF;
      border-radius: 10px;
    }

    

    /* Küçük ekranlarda yüksekliği azalt */
    @media (max-width: 576px) {
      .swiper { height: 240px; }
      .swiper-slide{
        width:100% !important;
      }
      .free-lessons{
        grid-template-columns:1fr;
      }
      .lesson-card{
        display:grid;
        grid-template-columns:1fr;
      }
      .lessons{
        grid-template-columns:1fr;
      }
      .camp-photos{
        grid-template-columns:1fr;
      }
      .home-header-div{
        flex-direction: column;
        gap:20px;
        background: #FFFFFF;
        color: #000000ff;
      }
      .top-info-boxes{
        grid-template-columns: 1fr 1fr;
      }
    }

    /* Küçük stil düzeltmeleri: navigation butonlarının görünürlüğü */
    .swiper-button-next, .swiper-button-prev {
      color: #fff;
    }

    .swiper-slide{
      padding:10px
    }

    /* .overflow-hidden parent içinde slider taşmasını kesin engeller */
    .no-overflow { overflow: hidden; }

    .bg-purple{
      background: #901aad;
    
    }

    .text-white{
      color: #fff;
    }

    .teacher-box{
      background: #901aad;
      padding: 30px 14px;
      border-radius: 12px;
      color: #FFFFFF;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-around;
      align-items: center;
      box-shadow: 0 4px 20px rgba(2, 6, 23, 0.3);
      transition: box-shadow 0.3s ease;
      gap: 10px;
    }

  </style>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<!-- Swiper CSS (CDN) -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@10/swiper-bundle.min.css" />

</head>
<body>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-EKY9M74W3D"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-EKY9M74W3D');
  </script>
  <div class="container">
    <header>
    <div class="inner container">
      <div class="brand">
        <div class="logo">
        <img src="{{asset('assets/img/dersekos-favicon.png')}}" width="150" alt="DerseKos Logo" >    
      </div>
        <a href="{{ route('home') }}">
          <strong>Derse Koş</strong>
        </a>
        
      </div>
      <nav class="nav">
        @if(!auth('student')->check() && !auth('teacher')->check())
        <a href="{{ route('login.choose') }}" class="cta">Üye Ol / Giriş Yap</a>
        @else
          @if(auth('teacher')->check())
          <a href="{{ route('teacher.dashboard') }}">Hesabım</a>
          <a href="{{ route('teacher.logout') }}">Çıkış Yap</a>
          @endif
          @if(auth('student')->check())
          <a href="{{ route('student.dashboard') }}">Hesabım</a>
          <a href="{{ route('student.logout') }}">Çıkış Yap</a>
          @endif
        @endif
        
      </nav>
    </div>
  </header>
    <div style="height:80px"></div>