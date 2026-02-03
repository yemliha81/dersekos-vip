<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
        .logo-div{
            background-color: #222222;
            
        }
        .logo-bar {
            padding: 10px 0;
            text-align: center;
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
        
    </style>
</head>
<body>
    <div class="logo-div">
        <div class="container">
            <div class="logo-bar">
                <img src="img/dersekos-vip-logo-1.jpg" width="300" alt="Logo" />
            </div>
        </div>

    </div>
    <div class="top-nav-wrapper">
        <div class="container">
            <div class="top-navbar">
                <div>
                    <a href="">Anasayfa</a>
                    <a href="">Hakkımızda</a>
                    <a href="">İletişim</a>
                </div>
                <div>
                    <a href="">Giriş Yap</a>
                    <a href="">Kayıt Ol</a>
                </div>
            </div>
        </div>
    </div>