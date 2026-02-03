@extends('layouts.main')


@section('content')
<main>
  <div class="container">
        <section>

          <div style="text-align:center">
            <div class="home-header-div mb-50">
              <img src="{{asset('assets/img/dersekos.jpg')}}" width="150" alt="DerseKos Logo" >
              <div>
                <h3>Haydi sen de derse koş!</h3>
                <p>Türkiye'nin yeni nesil online eğitim platformu.</p>
              </div>
            </div>
            
          </div>

          
            <div class="row mb-50">
              
                <div class="top-info-boxes">
                  <div class="top-info-box">
                    <div class="top-info-box-icon">
                      <i class="bi bi-people-fill fs-1"></i>
                    </div>
                    <div class="top-info-box-content">
                      <div class="top-info-box-title"><b>Uzman Eğitmenler</b></div> 
                      <div class="top-info-box-subtitle">200'ün üzerinde eğitmen kadromuzla yanınızdayız.</div>
                    </div>
                  </div>
                  <div class="top-info-box">
                    <div class="top-info-box-icon">
                      <i class="bi bi-play-circle fs-1"></i>
                    </div>
                    <div class="top-info-box-content">
                      <div class="top-info-box-title"><b>Ücretsiz Dersler</b></div> 
                      <div class="top-info-box-subtitle">Her hafta, her sınıf seviyesinden ücretsiz ders fırsatı.</div>
                    </div>
                  </div>
                  <div class="top-info-box">
                    <div class="top-info-box-icon">
                      <i class="bi bi-pencil-square fs-1"></i>
                    </div>
                    <div class="top-info-box-content">
                      <div class="top-info-box-title"><b>Uygun Fiyatlı Kamplar</b></div> 
                      <div class="top-info-box-subtitle">Bütçenize uygun ve hedefe yönelik kamplarımıza kayıt olabilirsiniz.</div>
                    </div>
                  </div>

                  <div class="top-info-box">
                    <div class="top-info-box-icon">
                      <i class="bi bi-controller fs-1"></i>
                    </div>
                    <div class="top-info-box-content">
                      <div class="top-info-box-title"><b>Eğitici Oyunlar</b></div> 
                      <div class="top-info-box-subtitle">Her dersten eğitici oyunlarla eğlenirken öğrenin.</div>
                    </div>
                  </div>
                
          </div>
          
        </section>

        <!--<section>
          <div class="text-center mb-4"><h4><b>Öne Çıkan Kamp ve Etkinlikler</b></h4></div>
        </section>
        <section class="hero-card mb-50 camp-photos">
          
              <a target="_blank" class="" href="{{route('camp.registration')}}">
                <img  src="{{asset('assets/img/fatih-korkmaz-kamp-8-1.jpg?v=123')}}"  alt="Fatih Korkmaz Matematik Kampı" loading="lazy">
              </a>

              <a target="_blank" class="" href="{{route('camp.registration')}}">
                <img  src="{{asset('assets/img/kemal-oltulu-kamp.jpg')}}"  alt="Kemal Oltulu Matematik Kampı" loading="lazy">
              </a>

              <a target="_blank" class="" href="{{route('camp.registration')}}">
                <img  src="{{asset('assets/img/ayse-gul-turkce-kamp.jpg')}}"  alt="Ayşe Gül Türkçe Kampı" loading="lazy">
              </a>

              <a target="_blank" class="" href="{{route('camp.registration')}}">
                <img  src="{{asset('assets/img/guzide-arslanhan-turkce-8-sinif-kamp.jpg')}}"  alt="Güzide Arslanhan Türkçe Kampı 8. Sınıf" loading="lazy">
              </a>

              <a target="_blank" class="" href="{{route('camp.registration')}}">
                <img  src="{{asset('assets/img/8-sinif-lgs-kamp-fen-bilimleri.jpg')}}"  alt="8. Sınıf Fen bilimleri Kampı sınıf" loading="lazy">
              </a>

              
            
        </section>
        <section class="text-center mb-50">
          <a href="{{route('camp.registration')}}" class="btn btn-primary btn-lg">Tüm Kamp ve Etkinliklere Gözat</a>
        </section>-->

        
        <section class="hero-card mb-50 bg-purple text-white">
          <p class="text-center">
            Her gün daha da büyüyen eğitmen ve öğrenci topluluğumuza katılın.<br/> İster sınavlara hazırlanın, ister yeni beceriler öğrenin, 
            size en uygun eğitmeni bulun. 
          </p>

        </section>

        <section>
          <div class="teachers-section mb-50">
              <div class="text-center mb-4"><h4><b>Eğitmenlerimiz</b></h4></div>
              <div class="teachers-grid">
                @foreach($teachers as $teacher)
                    <div class="">
                      <div class="teacher-box" tabindex="0">
                          <div class="mb-3 teacher-avatar">
                              @if($teacher->image == null)
                                  <img src="{{ asset('assets/img/default-image.png') }}" class="profile-img" width="80" alt="">
                              @else
                              <img src="{{ asset($teacher->image) }}" class="profile-img" width="80" alt="">
                              @endif
                          </div>
                          <div style=""><strong>{{ $teacher->name }} {{ $teacher->surname }}</strong></div>
                          <small class="teacher-branch">{{ ucwords(str_replace('_', ' ',   $teacher->branch)) }} </small>
                          <div style="margin-top:8px; display:flex; gap:8px; align-items:center">
                            <a href="{{route('teacher.public.profile', ['id' => $teacher->id])}}" class="btn btn-primary" style="padding:8px 12px; font-weight:700">Profili İncele</a>
                          </div>
                      </div>
                    </div>
                  @endforeach
              </div>
          </div>
        </section>

          <!--<section class="hero-card mb-50 " aria-labelledby="hero-title">
            <div class="hero-left grid-20">
              <h3 id="hero-title" class="text-center">Size en uygun eğitmeni bulun. Hızlı, güvenilir, uygun fiyatlı</h3>
              <p class="muted text-center">Matematik, yabancı dil, sınav hazırlık veya hobi dersleri. Dersleri filtrele, eğitmen profillerini incele ve ilk dersini ayarla.</p>
            </div>
          </section>

         
          <section id="features" class="hero-card text-center mb-50" style="margin-top:22px">
            <h2 style="margin:0 0 12px 0">Platform özellikleri</h2>
            <div class="features">
              <div class="feature">
                <strong>Güvenli ödeme</strong>
                <p class="muted" style="margin:8px 0 0 0">Kredi kartı, havale ve cüzdan ile hızlı ödeme. Ders sonrası puanlama ve iade politikası.</p>
              </div>
              <div class="feature">
                <strong>Canlı ders arayüzü</strong>
                <p class="muted" style="margin:8px 0 0 0">Ekran paylaşımı, beyaz tahta, kayıt ve ders materyali paylaşımı.</p>
              </div>
              <div class="feature">
                <strong>Özelleştirilebilir program</strong>
                <p class="muted" style="margin:8px 0 0 0">Saatlik, paket veya abonelik tabanlı ders planları.</p>
              </div>
            </div>
          </section>-->
    </div>
</main>

    <script src="https://unpkg.com/swiper@10/swiper-bundle.min.js"></script>

    <script>
    // Swiper başlatma
     const swiperA = new Swiper('.swiperA', {
      loop: true,
      spaceBetween: 12,
      spaceAround: true,
      slidesPerView: 1,          // default (geniş ekran için)
      centeredSlides: false,
      observer: true,
      observeParents: true,
      preloadImages: false,
      lazy: { loadPrevNext: true },

     

      navigation: {
        nextEl: '.nextA',
        prevEl: '.prevA',
      },

      pagination: {
        el: '.pagerA',
        clickable: true,
      },

      a11y: { enabled: true },
    });

    const swiperB = new Swiper('.swiperB', {
      loop: true,
      spaceBetween: 16,
      spaceAround: 16,
      slidesPerView: 4,
      observer: true,
      observeParents: true,
      preloadImages: false,
      lazy: { loadPrevNext: true },

      // responsive breakpoints (mobilde 1 göster)
      breakpoints: {
        0:   { slidesPerView: 1, spaceBetween: 8 },
        576: { slidesPerView: 1, spaceBetween: 10 },
        768: { slidesPerView: 2, spaceBetween: 12 },
        1200:{ slidesPerView: 4, spaceBetween: 16 }
      },

      navigation: {
        nextEl: '.nextB',
        prevEl: '.prevB',
      },

      pagination: {
        el: '.pagerB',
        clickable: true,
      },

      a11y: { enabled: true },
    });
  </script>

@endsection


