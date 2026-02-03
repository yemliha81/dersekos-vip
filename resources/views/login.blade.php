@extends('layouts.main')


@section('content')

 <!-- Ana İçerik -->
  <main class="auth-wrap">
    <div class="auth-card">
      
      <input type="radio" name="tab" id="login" checked>
      <input type="radio" name="tab" id="register">

      <div class="tabs">
        <label for="login">Giriş Yap</label>
        <label for="register">Üye Ol</label>
      </div>
      @if(session()->has('error'))

      <div class="alert alert-danger">
        {{session()->get('error')}}
      </div>

      @endif
      <!-- Giriş Formu -->
      <form  action="{{route('student.login.submit')}}" method="POST" class="form form-login">
        @csrf
        <h2>Hesabına Giriş Yap</h2>
        <div class="field">
          <label>E‑posta</label>
          <input type="email" name="email" placeholder="ornek@mail.com" required>
        </div>
        <div class="field">
          <label>Şifre</label>
          <input type="password" name="password" placeholder="••••••••" required>
        </div>
        <button class="btn btn-primary" style="width:100%">Giriş Yap</button>
        <div class="auth-footer">Şifreni mi unuttun? <a href="#">Sıfırla</a></div>
      </form>

      <!-- Üyelik Formu -->
      <form  action="{{route('student.signup.submit')}}" method="POST" class="form form-register">
        @csrf
        <h2>Derse Koş'a Üye Ol</h2>
        <div class="field">
          <label>Ad Soyad</label>
          <input type="text" name="name" placeholder="Adınız Soyadınız" required>
        </div>
        <div class="field">
          <label>E‑posta</label>
          <input type="email" name="email" placeholder="ornek@mail.com" required>
        </div>
        <!-- grade selectbox --> 
        <div class="field">
          <label>Sınıf Seviyesi</label>
          <select name="grade" required>
            <option value="" disabled selected>Seçiniz</option>
            <option value="1">1. Sınıf</option>
            <option value="2">2. Sınıf</option>
            <option value="3">3. Sınıf</option>
            <option value="4">4. Sınıf</option>
            <option value="5">5. Sınıf</option>
            <option value="6">6. Sınıf</option>
            <option value="7">7. Sınıf</option>
            <option value="8">8. Sınıf</option>
            <option value="9">9. Sınıf</option>
            <option value="10">10. Sınıf</option>
            <option value="11">11. Sınıf</option>
            <option value="12">12. Sınıf</option>
            <option value="13">KPSS</option>
          </select>
        </div>
        <div class="field">
          <label>Şifre</label>
          <input type="password" name="password" placeholder="En az 6 karakter" required>
        </div>
        <div class="field">
          <label><input type="checkbox" name="terms" required> <a href="#" data-bs-toggle="modal" data-bs-target="#studentKVKKModal">KVKK Bilgilendirmesini</a> okudum, kabul ediyorum.</label>
        </div>
        <button class="btn btn-primary" style="width:100%">Üye Ol</button>
      </form>

    </div>


    <!-- bootstrap modal --> 
    <div class="modal fade" id="studentKVKKModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Kişisel Verilerin Korunması Hakkında</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            1. Öğrenciler İçin KVKK Aydınlatma ve Açık Rıza Metni
            Kişisel Verilerin Korunması Hakkında Aydınlatma Metni (Öğrenci)
            6698 sayılı Kişisel Verilerin Korunması Kanunu (“KVKK”) uyarınca, DERSEKOŞ (“Platform”) olarak kişisel verilerinizin güvenliğine önem veriyoruz.
            Platformumuza öğrenci olarak kayıt olmanız ve sunulan ücretsiz canlı ders hizmetlerinden faydalanabilmeniz kapsamında; <br>
            ad, soyad, e-posta adresi, telefon numarası ve platform kullanımına ilişkin bilgileriniz, KVKK’ya uygun olarak işlenmektedir. <br>
            Kişisel Verilerin İşlenme Amaçları <br>
            Kişisel verileriniz; <br>
            Platforma üyelik işlemlerinin gerçekleştirilmesi, <br>
            Canlı derslerin planlanması ve yürütülmesi, <br>
            Öğretmen–öğrenci eşleşmelerinin sağlanması, <br>
            İletişim faaliyetlerinin yürütülmesi, <br>
            Teknik destek ve kullanıcı deneyiminin iyileştirilmesi, <br>
            Mevzuattan doğan yükümlülüklerin yerine getirilmesi <br>
            amaçlarıyla işlenmektedir. <br> <br>


            Kişisel Verilerin Aktarılması <br>
            Kişisel verileriniz; <br>
            Ders hizmetinin sunulabilmesi amacıyla gönüllü öğretmenlerle, <br>
 <br>
 <br>
            Teknik altyapı ve hizmet sağlayıcılarla,

 <br>
            Yetkili kamu kurum ve kuruluşlarıyla
            KVKK’nın 8. ve 9. maddelerine uygun olarak paylaşılabilir.

 <br>
            Kişisel Verilerin Toplanma Yöntemi ve Hukuki Sebebi <br>
            Kişisel verileriniz, platform üzerindeki kayıt formları ve elektronik ortamlar aracılığıyla; KVKK’nın 5. maddesinde belirtilen “açık rıza” ve “bir sözleşmenin kurulması ve ifası” hukuki sebeplerine dayanılarak toplanmaktadır. <br>
            KVKK Kapsamındaki Haklarınız <br>
            KVKK’nın 11. maddesi uyarınca; <br>
            Kişisel verilerinizin işlenip işlenmediğini öğrenme, <br>


            İşlenmişse buna ilişkin bilgi talep etme, <br>


            Amacına uygun kullanılıp kullanılmadığını öğrenme, <br>


            Eksik veya yanlış işlenmişse düzeltilmesini isteme, <br>


            Silinmesini veya yok edilmesini talep etme haklarına sahipsiniz.

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
          </div>
        </div>
      </div>
    </div>



  </main>

@endsection