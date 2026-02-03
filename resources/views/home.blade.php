@extends('layouts.main')


@section('content')

    <div class="main-content">
        <div class="banner-div">
            <div class="container">
                <div class="banner">
                    <div>
                        <div class="banner-text">
                            <h1 style=" color: #222222;">Derse Koş VIP ile <br>hep bir adım önde olun!</h1>
                            <p style="color: #222222;">Derseko's VIP üyeliği ile birçok ayrıcalığa sahip olabilirsiniz. VIP üyelerimize özel içerikler, indirimler ve daha fazlası sizi bekliyor!</p>
                            <button class="banner-button">Paketleri İncele</button>
                        </div>
                    </div>
                    <div style="text-align:right">
                        <img class="image-switcher" src="{{env('HTTP_DOMAIN')}}/img/vip-banner-1.png" image2="img/vip-banner-2.png" width="80%" alt="Banner" />
                    </div>
                </div>
                
            </div>
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
                <div>
                    <img src="img/matematik.png" alt="matematik" width="100%">
                </div>
                <div>
                    <img src="img/fen-bilimleri.png" alt="fen-bilimleri" width="100%">
                </div>
                <div>
                    <img src="img/turkce.png" alt="turkce" width="100%">
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
        }, 5000);
    });
</script>

@endsection


