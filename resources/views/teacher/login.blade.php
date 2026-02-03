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

      <!-- Giriş Formu -->
      <form  action="{{route('teacher.login.submit')}}" method="POST" class="form form-login">
        @csrf
        <h3>Öğretmen Giriş</h3>
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
      <form  action="{{route('teacher.signup.submit')}}" method="POST" class="form form-register">
        @csrf
        <h3>Öğretmen Hesabı Oluştur</h3>
        <div class="field">
          <label>Ad Soyad</label>
          <input type="text" name="name" placeholder="Adınız Soyadınız" required>
        </div>
        <div class="field">
          <label>E‑posta</label>
          <input type="email" name="email" placeholder="ornek@mail.com" required>
        </div>
        <div class="field">
          <label>Cep Telefonu</label>
          <input type="text" name="phone" placeholder="Cep Telefonu" required>
        </div>
        <!-- grade selectbox --> 
        <div class="field">
          <label>Branşınız</label>
          <select name="branch" required>
            <option value="" disabled selected>Seçiniz</option>
            <option value="Sınıf Öğretmeni">Sınıf Öğretmeni</option>
            <option value="ilkogretim_matematik">İlköğretim Matematik</option>
            <option value="ilkogretim_turkce">İlköğretim Türkçe</option>
            <option value="fen_bilimleri">Fen Bilimleri</option>
            <option value="sosyal_bilgiler">Sosyal Bilgiler</option>
            <option value="din_kültürü">Din Kültürü</option>
            <option value="ingilizce">İngilizce</option>
            <option value="lise_matematik">Lise Matematik</option>
            <option value="fizik">Fizik</option>
            <option value="kimya">Kimya</option>
            <option value="biyoloji">Biyoloji</option>
            <option value="lise_turkce">Lise Türkçe</option>
            <option value="tarih">Tarih</option>
            <option value="cografya">Coğrafya</option>
            <option value="rehberlik">Rehberlik ve Psikolojik Danışmanlık</option>
          </select>
        </div>
        <div class="field">
          <label>Şifre</label>
          <input type="password" name="password" placeholder="En az 6 karakter" required>
        </div>
        <div class="field">
          <label><input type="checkbox" name="terms" required><a href="#" data-bs-toggle="modal" data-bs-target="#teacherKVKKModal"> KVKK Bilgilendirmesini</a> okudum,  kabul ediyorum.</label>
        </div>
        <button class="btn btn-primary" style="width:100%">Üye Ol</button>
        <div class="auth-footer">Zaten hesabın var mı? Giriş Yap</div>
      </form>

    </div>

    <!-- bootstrap modal --> 
    <div class="modal fade" id="teacherKVKKModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Gönüllü Öğretmenler İçin KVKK Aydınlatma ve Açık Rıza Metni</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            
            Kişisel Verilerin Korunması Hakkında Aydınlatma Metni (Gönüllü Öğretmen) <br>
            6698 sayılı Kişisel Verilerin Korunması Kanunu (“KVKK”) kapsamında, DERSEKOŞ (“Platform”) olarak gönüllü öğretmenlerimize ait kişisel verilerin korunmasına azami özen göstermekteyiz. <br>
            Platformumuza gönüllü öğretmen olarak kayıt olmanız kapsamında; <br>
            ad, soyad, e-posta adresi, telefon numarası, branş/ders bilgileri ve platform kullanım verileriniz işlenmektedir. <br>
            <b>Kişisel Verilerin İşlenme Amaçları </b><br><br>
            Kişisel verileriniz; <br> <br>
            
            - Platforma gönüllü öğretmen kaydınızın oluşturulması, <br>
            - Öğrenciler ile eşleştirme yapılması, <br>
            - Canlı derslerin planlanması ve yürütülmesi, <br>
            - Platform içi iletişimin sağlanması, <br>
            - Hizmet kalitesinin ve güvenliğinin artırılması, <br>
            - Yasal yükümlülüklerin yerine getirilmesi <br>
            amaçlarıyla işlenmektedir. <br> <br>


            <b>Kişisel Verilerin Aktarılması </b><br>
            Kişisel verileriniz; <br>
            - Ders hizmetinin yürütülmesi amacıyla öğrencilerle, <br>
            - Teknik hizmet sağlayıcılarla, <br>
            - Yetkili kamu kurum ve kuruluşlarıyla <br>
            KVKK hükümlerine uygun şekilde paylaşılabilir. <br>


            <b>Kişisel Verilerin Toplanma Yöntemi ve Hukuki Sebebi</b> <br> <br>
            Kişisel verileriniz, elektronik kayıt formları aracılığıyla; KVKK’nın 5. maddesinde yer alan “açık rıza” ve “meşru menfaat” hukuki sebeplerine dayanılarak toplanmaktadır. <br>
            KVKK Kapsamındaki Haklarınız <br>
            KVKK’nın 11. maddesi kapsamında; <br>
            Kişisel verilerinizin işlenmesine ilişkin bilgi talep edebilir, <br>
            Düzeltilmesini, silinmesini veya yok edilmesini isteyebilir, <br>
            İşlemeye itiraz edebilirsiniz. <br>



            Açık Rıza Beyanı (Gönüllü Öğretmen) <br>
            Kişisel verilerimin yukarıda belirtilen amaçlarla işlenmesini kabul ediyor, bu kapsamda açık rıza verdiğimi beyan ediyorum.

          </div>
          
        </div>
      </div>
    </div>



  </main>

@endsection