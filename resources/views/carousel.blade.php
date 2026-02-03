<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Swipe Carousel — Örnek</title>

  <!-- Swiper CSS (CDN) -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@10/swiper-bundle.min.css" />

  <style>
    /* Basit stil: sayfa ortalaması ve slider boyutu */
    

    .carousel-wrapper {
      width: min(1000px, 95%);
      max-width: 1000px;
      background: white;
      padding: 18px;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(20,30,60,0.08);
    }

    /* Swiper yüksekliği */
    .swiper {
      width: 100%;
      height: 420px;
      border-radius: 10px;
      overflow: hidden;
    }

    .swiper-slide {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      color: #fff;
      position: relative;
    }

    /* Resim kapsayıcı (responsive, cover) */
    .slide-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    /* Başlık katmanı örneği */
    .slide-caption {
      position: absolute;
      left: 18px;
      bottom: 18px;
      background: rgba(0,0,0,0.45);
      color: #fff;
      padding: 10px 14px;
      border-radius: 8px;
      backdrop-filter: blur(4px);
      font-weight: 600;
      font-size: 16px;
    }

    /* Küçük ekran düzeni */
    @media (max-width: 600px) {
      .swiper { height: 320px; }
      .slide-caption { font-size: 14px; padding: 8px 10px; }
    }
  </style>
</head>
<body>

  <div class="carousel-wrapper">
    <h2 style="margin:0 0 12px 8px; font-size:20px;">Swipe Carousel (CDN ile)</h2>

    <!-- Swiper -->
    <div class="swiper">
      <div class="swiper-wrapper">
        <!-- slide 1 -->
        <div class="swiper-slide">
          <img class="slide-img" src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1600&auto=format&fit=crop" alt="Doğa 1" loading="lazy">
          <div class="slide-caption">Gün doğumu — Dağ manzarası</div>
        </div>

        <!-- slide 2 -->
        <div class="swiper-slide">
          <img class="slide-img" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1600&auto=format&fit=crop" alt="Deniz" loading="lazy">
          <div class="slide-caption">Sahilde dalga</div>
        </div>

        <!-- slide 3 -->
        <div class="swiper-slide">
          <img class="slide-img" src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?q=80&w=1600&auto=format&fit=crop" alt="Orman" loading="lazy">
          <div class="slide-caption">Yeşil orman</div>
        </div>

        <!-- slide 4 -->
        <div class="swiper-slide">
          <img class="slide-img" src="https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=1600&auto=format&fit=crop" alt="Şehir gececisi" loading="lazy">
          <div class="slide-caption">Şehir gecesi</div>
        </div>
      </div>

      <!-- Pagination (nokta) -->
      <div class="swiper-pagination"></div>

      <!-- Navigation -->
      <div class="swiper-button-prev" aria-label="Önceki"></div>
      <div class="swiper-button-next" aria-label="Sonraki"></div>

      <!-- Scrollbar (isteğe bağlı) -->
      <div class="swiper-scrollbar"></div>
    </div>

    <!-- Kısa bilgi -->
    <p style="margin:12px 8px 0 8px; color:#555; font-size:14px;">
      Dokunmatik (swipe), klavye, otomatik oynatma ve lazy-loading destekli örnek.
    </p>
  </div>

  <!-- Swiper JS (CDN) -->
  <script src="https://unpkg.com/swiper@10/swiper-bundle.min.js"></script>

  <script>
    // Swiper başlatma
    const swiper = new Swiper('.swiper', {
      // Genel ayarlar
      loop: true,                // sonsuz döngü
      slidesPerView: 1,          // aynı anda görünen slayt sayısı
      spaceBetween: 12,          // slaytlar arası boşluk (px)
      grabCursor: true,          // fareyle çekme imleci
      centeredSlides: true,      // kaydırma ortalansın
      preloadImages: false,      // lazy kullanmak için false
      lazy: {
        loadOnTransitionStart: true,
        loadPrevNext: true,
      },

      // Dokunmatik duyarlılığı (opsiyonel)
      touchRatio: 1,
      touchAngle: 45,
      simulateTouch: true,

      // Erişilebilirlik & klavye
      keyboard: { enabled: true, onlyInViewport: true },
      a11y: { enabled: true },

      // Otomatik oynatma
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },

      // Pagination (nokta)
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },

      // Navigation (oklar)
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      // Scrollbar (isteğe bağlı)
      scrollbar: {
        el: '.swiper-scrollbar',
        hide: false,
      },

      // Responsive davranış (örnek)
      breakpoints: {
        800: {
          slidesPerView: 1,
          spaceBetween: 16
        },
        1200: {
          slidesPerView: 1,
          spaceBetween: 18
        }
      },
    });
  </script>
</body>
</html>
