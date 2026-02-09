<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Derse Koş VIP ile hedeflerinize ulaşmak artık çok daha kolay!</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- favicon --> 
    <link rel="icon" type="image/png" href="" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=SN+Pro:ital,wght@0,200..900;1,200..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
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
        html,body {
            margin: 0;
            padding: 0;
            font-family: "SN Pro", sans-serif;
            
        }
        .nav-toggle{
            display: none;
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 32px;
            cursor: pointer;
        }
        .logo-div{
            background-color: #222222;
            
        }
        .logo-bar {
            padding: 10px 0;
            text-align: center;
        }
        .logo-bar img{
            height: 160px;
        }
        .banner-image{
            text-align: right;
        }
        .banner-image img{
            width: 80%;
        }
        .top-nav-wrapper{
            background-color: #f8f9fa;
        }
        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            
        }
        .top-navbar a {
            text-decoration: none;
            margin: 0 15px;
            font-weight: 600;
            color: #000000;
        }
        .top-navbar a:hover {
            text-decoration: underline;
        }
        .banner-div {
            background: linear-gradient(45deg, #a8792b, #fef3b5, #a8792b);
            padding: 10px 0;
        }
        .banner{
            position: relative;
            color: white;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .banner-text {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
            gap: 30px;
            padding: 40px 10px;
        }
        .banner-text h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .banner-text p {
            font-size: 1.5rem;
            line-height: 1.5;
        }
        .banner-button{
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #222222;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            text-decoration:none;
        }
        .services{
            margin-top: 50px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .services > div{
            padding: 20px;
            border-radius: 15px;
            border: 1px solid #000000;
        }

        .service-card{
            background: #000000;
            color: #d1b46d;
        }

        .service-card h3{
            margin-bottom: 15px;
            color: #FFFFFF;
        }

        .testimonials{
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
        }

        .testimonials h2{
            text-align: center;
        }

        .testimonials p{
            text-align: center;
            margin-bottom: 20px;
        }

        .testimonials-grid{
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .testimonials-card{
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #000000;
            background: #f3f3f3;
        }

        .testimonials-card p{
            text-align: center;
            font-style: italic;
        }

        .services-title h2{
            text-align: center;
        }

        .rating-stars{
            text-align: center;
        }

        .footer {
            background-color: #222222;
            color: white;
            padding: 20px 0;
            margin-top: 50px;
            text-align: center;
        }
        .footer a {
            color: #d1b46d;
            margin: 0 10px;
            text-decoration: none;
        }

        .footer p.text-muted{
            margin-top: 10px;
            color: #dddddd !important;
            font-size: 12px;
        }

        .has-children{
            position: relative;
            display: inline-block;
            font-weight:600;
        }

        .sub-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #f8f9fa;
            padding: 10px;
            display: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
            z-index: 1000;
            min-width: 300px;
        }
        .has-children:hover .sub-menu {
            display: block;
        }

        @media (max-width: 768px) {
            .logo-bar img{
                height: 120px;
            }
            .nav-toggle {
                display: block;
                color:#FFFFFF
            }
            .top-navbar {
                display:none;
                flex-direction: column;
                align-items: flex-start;
            }
            .nav-links-1{
                display: flex;
                flex-direction: column;
                width: 100%;
            }
            .nav-links-2{
                display: flex;
                flex-direction: column;
                width: 100%;
            }
            .nav-links-2 a:last-child{
                border:0 !important;
            }
            .top-navbar a {
                padding: 10px;
                margin: 0;
                border-bottom: 1px solid #000000;
                transition: all ease 0.3s;
            }
            .top-navbar a:hover {
                background-color: #000000;
                color: #FFFFFF;
                text-decoration:none;
            }
            .banner {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .banner-text {
                align-items: center;
            }
            .services {
                grid-template-columns: 1fr;
            }
            .testimonials-grid {
                grid-template-columns: 1fr;
            }
            .banner-image{
                text-align: center;
            }
            .banner-image img{
                width: 100%;
            }
            .top-nav-wrapper{
                position: absolute;
                top: 140px;
                width: 100%;
                z-index: 999;
            }
            .banner-text{
                padding:10px;
                gap:0;
            }
            .banner-text h1{
                font-size:32px;
            }
            .banner-text p{
                font-size:18px;
            }
        }
        
    </style>
</head>
<?php $vip_packages = App\Models\VipPackage::all(); ?>
<body>
    <div class="logo-div">
        <div class="container">
            <div class="logo-bar">
                <a href="{{env('HTTP_DOMAIN')}}" >
                  <img src="{{ asset('img/dersekos-vip-logo-1.jpg') }}" alt="Derse Koş VIP Logo" />
                </a>
            </div>
        </div>
    </div>
    <a class="nav-toggle" href="javascript:;">
        <i class="bi bi-list"></i>
    </a>
    <div class="top-nav-wrapper">
        <div class="container">
            <div class="top-navbar">
                <div class="nav-links-1">
                    <a href="{{env('HTTP_DOMAIN')}}">Anasayfa</a>
                    <a href="{{ route('teachers.list') }}">Eğitmenlerimiz</a>
                    <a href="{{ route('vip.packages') }}">Paketlerimiz</a>
                    
                </div>
                <div class="nav-links-2">
                    @if(Auth::check())
                        <a href="{{ route('student.dashboard') }}">Hesabım</a>
                        <a href="{{ route('student.cart.index') }}">Sepetim</a>
                        <a href="{{ route('student.logout') }}">Çıkış Yap</a>
                    @else
                        <a href="{{ route('student.login') }}">Giriş yap / Üye ol</a>
                        <a href="{{ route('student.cart.index') }}">Sepetim</a>
                    @endif
                </div>
            </div>
        </div>
    </div>