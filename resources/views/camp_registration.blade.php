@extends('layouts.main')


@section('content')
<style>
  .text-right{
    text-align: right;
  }
  .camps{
    display: flex;
    flex-direction: column;
    gap: 40px;
  }
  .camp-detail {
    display: grid;
    grid-template-columns: 200px auto;
    gap: 20px;
    margin-bottom: 30px;
    border: 1px solid #dddddd;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 10px 10px 10px #ddd;
    background-color: #ffd1f3ff;
  }
  .camp-detail img {
    width: 200px;
    height: auto;
    max-width:unset
  }
  .grids-2{
    display: grid;
    grid-template-columns: auto 500px;
    gap: 20px;
    margin-bottom: 15px;
  }
  .camp-info{
    font-size: 16px;
    line-height: 1.6;
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 10px;
  }
  @media screen and (max-width: 768px) {
    .camp-detail {
      grid-template-columns: 1fr;
    }
    .grids-2{
      grid-template-columns: auto;
    }

    .camp-image{
      text-align: center;
    }

    .camp-image img{
      display: inline-block;
      width: 300px;
    }
    
  }
</style>
 <!-- Ana İçerik -->
  <main class="auth-wrap">
   
    
    <div class="camps">
      <div class="page-header text-center mb-3">
        <div class="page-title"><h3>Ara Tatil Kamplarımız</h3></div>
      </div>

      @foreach($campaigns as $campaign)
        <div class="camp-detail">
          <div class="camp-image">
            <img src="{{asset('assets/img/campaign_images/'.$campaign->campaign_image)}}"  width="200" alt="">
          </div>
          <div>
              
              <div class="camp-info">
                <b>{{$campaign->teacher->name}}</b> - {{$campaign->teacher->branch}} <br><br>
                <b>{{$campaign->campaign_title}}</b> <br><br>
                <div>
                  <b>Kamp Tarihleri: </b> {{date('d.m.Y', strtotime($campaign->campaign_start))}} - {{date('d.m.Y', strtotime($campaign->campaign_end))}}
                </div>
                <div>
                  {!!$campaign->campaign_description!!}
                </div>
                <div class="mt-3">
                  <b>Kamp Ücreti: </b> {{$campaign->campaign_price}} TL
                </div>
                <div class="mt-3 text-right">
                  <a target="_blank" style="display: inline-block;" class="btn btn-primary" href="{{$campaign->form_url}}">Hemen Kayıt Ol!</a>
                </div>
              </div>
            
          </div>
        </div>
      @endforeach

      <!--<div class="camp-detail">
        <div class="camp-image">
          <img src="{{asset('assets/img/fatih-korkmaz-kamp-8-1.jpg?v=123')}}"  width="300" alt="">
        </div>
        <div>
          
          <div class="grids-2">
            
            <div class="camp-info">
              <b>Fatih Korkmaz, 8. Sınıf Ara Tatil Matematik Kampı</b> <br><br>
              <ul>
                
                <li>1. Gün 23 Ocak: Çarpanlar ve Katlar, EBOB-EKOK</li>
                <li>2. Gün 25 Ocak: Üslü İfadeler 1, Üslü ifadeler 2</li>
                <li>3. Gün 26 Ocak: Ondalık Gösterimleri Çözümleme- Bilimsel Gösterim, Kareköklü İfadeler 1</li>
                <li>4. Gün 27 Ocak: Kareköklü İfadeler 2, Çizgi- Sütun- Daire Grafiği</li>
                <li>5. Gün 29 Ocak, Olasılık, 2025 LGS Çıkmış Soru Çözümü</li>
                <li>Kamp süresi 5 gün, her gün 2 ders olmak üzere toplam 10 ders yapılacaktır.</li>
                <li>10 ders için Kamp ücreti 2000 TL’dir. </li>
              </ul>

            </div>
            <div>
              <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdQZewZHcRseUM9vOaCsOvuxADXmhMm07cv4UPICZGOQIWiRg/viewform?embedded=true" width="100%" height="600" frameborder="0" marginheight="0" marginwidth="0">Yükleniyor…</iframe>
            </div>
          </div>
        </div>
      </div>

      <div class="camp-detail">
        <div class="camp-image">
          <img src="{{asset('assets/img/kemal-oltulu-kamp.jpg')}}" alt="">
        </div>
        <div>
          <div class="grids-2">
            
            <div class="camp-info">
              <b>Kemal Oltulu, 8. Sınıf Ara Tatil LGS Matematik Kampı</b> <br><br>
              <ul>
                <li>LGS'nin yarısını bitir</li>
                <li>28 Saat yoğun ders programı</li>
                <li>Konu Tekrarı + Soru Çözümü</li>
                <li>Her öğrenciye mentörlük desteği</li>
                <li>Tüm Kamp Sadece 3000 TL</li>
                <li>
                  <a class="btn btn-primary btn-sm" href="{{asset('assets/img/kemal-oltulu-8-sinif-takvim.png')}}" target="_blank">KAMP TAKVİMİ</a>
                </li>
              </ul>

            </div>
            <div>
              <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdgyxC-icz91qqvHQV8hzS4zdsl8A6otHqjhfd_Y-YMRg0h_A/viewform?embedded=true" width="100%" height="600" frameborder="0" marginheight="0" marginwidth="0">Yükleniyor…</iframe>
            </div>
          </div>
        </div>
      </div>

      <div class="camp-detail">
        <div class="camp-image">
          <img src="{{asset('assets/img/kemal-oltulu-kamp.jpg')}}" alt="">
        </div>
        <div>
          <div class="grids-2">
            
            <div class="camp-info">
              <b>Kemal Oltulu, 5 - 6. Sınıf Ara Tatil LGS Matematik Kampı</b> <br><br>
              <ul>
                <li>42 Saat yoğun ders programı</li>
                <li>Konu Tekrarı + Soru Çözümü</li>
                <li>Her öğrenciye mentörlük desteği</li>
                <li>Tüm Kamp Sadece 2000 TL</li>
                <li>
                  <a class="btn btn-primary btn-sm" href="{{asset('assets/img/kemal-oltulu-5-6-sinif-takvim.jpg')}}" target="_blank">KAMP TAKVİMİ</a>
                </li>
              </ul>
            </div>
            <div>
              <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfRTlWqQFt9cS6oqCGEM7kGdL9zHNyTicvor24UGDGCmZoaNw/viewform?embedded=true" width="100%" height="721" frameborder="0" marginheight="0" marginwidth="0">Yükleniyor…</iframe>
            </div>
          </div>
        </div>
      </div>

      <div class="camp-detail">
        <div class="camp-image">
          <img src="{{asset('assets/img/ayse-gul-turkce-kamp.jpg')}}" alt="">
        </div>
        <div class="grids-2">
            
            <div class="camp-info">
              <b>Ayşe Gül, 8. Sınıf Ara Tatil Türkçe Paragraf ve Dilbilgisi Kampı</b>
                <div><br><br>
                <ul>
                  <li>21 Ocak - Cümlede, Paragrafta, Sözcükte anlam</li>
                  <li>22 Ocak - Metin Türleri ve sanatlar, Fiilimsiler</li>
                  <li>23 Ocak - Fiilde Çatı, Cümle Ögeleri, Pekiştirme</li>
                  <li>24 Ocak - Cümle Türleri, Yazım kuralları, Uygulama</li>
                  <li>25 Ocak - Noktalama, Noktalama (Uygulama)i Anlatım Bozukluğu</li>
                </ul>
                  15 Dersten oluşan kamp programı <br>
                  Kamp Ücreti: 1500 TL
                </div>
            </div>
            <div>
              <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSerJJN6EJmyYQrA-Cp0grqWCbhXmO_TX6PONYChPc-PpFzSQA/viewform?embedded=true" width="100%" height="600" frameborder="0" marginheight="0" marginwidth="0">Yükleniyor…</iframe>
            </div>
          </div>
      </div>

      <div class="camp-detail">
        <div class="camp-image">
          <img src="{{asset('assets/img/guzide-arslanhan-turkce-8-sinif-kamp.jpg')}}" alt="">
        </div>
        <div class="grids-2">

            <div class="camp-info">
              <b>Güzide Arslanhan, 8. Sınıf Ara Tatil Türkçe Kampı</b> <br><br>
                 <div>
                  <ul>
                    <li>21 OCAK - 29 OCAK tarihleri arasında</li>
                    <li>8. SINIFLAR İÇİN LGS HAZIRLIK KAMPI</li>
                    <li> LGS KONULARININ YARISINI BİTİRİYORUZ</li>
                    <li></li>
                    <li>YENİ NESİL SORULAR VE SORU ÇÖZÜM TAKTİKLERİYLE BİRLİKTE</li>
                    <li> TOPLAM 10 DERS SAATİ</li>
                    <li>KAMP ÜCRETİ 1500 TL</li>
                  </ul>

                </div>
            </div>
            <div>
              <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdKvvBcMKGp7vlHuyT0wKET1FMJRYStUyIjyOrtXNhsJQfMfQ/viewform?embedded=true" width="100%" height="600" frameborder="0" marginheight="0" marginwidth="0">Yükleniyor…</iframe>
            </div>
          
        </div>
      </div>

      <div class="camp-detail"  id="burcu-bedir-cansu-aksu">
        <div class="camp-image">
          <img src="{{asset('assets/img/8-sinif-lgs-kamp-fen-bilimleri.jpg')}}" alt="">
        </div>
        <div class="grids-2">

            <div class="camp-info">
              <b>Burcu Bedir & Cansu Aksu, 8. Sınıf LGS Fen Bilimleri Kampı</b> <br><br>
                 <div>
                  <ul>
                    <li>1.gün: 23 Ocak <br>

                      - Mevsimlerin oluşumu <br>

                      - İklim ve hava hareketleri
                    </li>



                    <li>2.gün: 25 Ocak <br>

                      - DNA ve genetik kod <br>

                      - Kalıtım, mutasyon ve modifikasyon Adaptasyon, Biyoteknoloji
                    </li>

                      3. Gün 27 ocak <br>

                      - Katı, sıvı ve gaz basıncı

                    </li>

                    <li>4. Gün: 29 ocak  <br>

                      - Periyodik sistem ve Fiziksel Kimyasal Degisim

                      - Kimyasal Tepkimeler
                    </li>

                    <li>5. Gün 31 ocak <br>

                      - Asitler ve Bazlar <br>

                      - Maddenin Isı ile Etkileşimi
                    </li>



                    <li>Toplam 10 derste İlk Yarıyı tekrar et!</li>

                    <li>Kamp Ücreti 1500 TL</li>
                  </ul>

                </div>
            </div>
            <div>
              <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdHdAdZ4N4yQVopzButba38lI7U05e1XpIwNWYrka6LA3WZ9Q/viewform?embedded=true" width="100%" height="600" frameborder="0" marginheight="0" marginwidth="0">Yükleniyor…</iframe>
            </div>
          
        </div>
      </div>-->
      
    </div>



  </main>

@endsection