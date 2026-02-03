@extends('layouts.main')


@section('content')

 <!-- Ana İçerik -->
  <main class="auth-wrap">
    <div class="auth-form">
      <div class="auth-form__container text-center">
        <h1 class="auth-form__title">Hoş geldiniz</h1>
        <p class="auth-form__subtitle">Lütfen giriş yapmak istediğiniz kullanıcı tipini seçiniz.</p>
        <div class="auth-form__options" style="display:flex; gap:20px">
          <div>
            <a  class="login-div-x" href="{{ route('student.login') }}">
              <img src="{{asset('assets/img/ogrenci-giris.jpg')}}" with="200" alt="">
              <div>
                <b>Öğrenci Girişi</b>
              </div>
            </a>
          </div>
          <div>
            <a  class="login-div-x" href="{{ route('teacher.login') }}">
              <img src="{{asset('assets/img/ogretmen-giris.jpg')}}" with="200" alt="">
              <div>
                <b>Öğretmen Girişi</b>
              </div>
            </a>
          </div>
            
            
        </div>
      </div>
    </div>
  </main>

@endsection