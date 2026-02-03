@extends('admin.layouts.main')
@section('title', 'Sınav Sorusu Ekleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Sınav Sorusu Ekleme</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Sınav Sorusu Yönetimi</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif  
                <div class="card">
                    
                    <div class="card-body">
                        <form action="{{ route('admin.exam.question.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content" id="myTabContent">
                               <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                <div class="" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
                                    <div class="card-body">
                                       <div class="">
                                        <!-- branch select box with name "branch" --> 
                                            <div class="mb-3">
                                                <label for="branch" class="form-label">Ders </label>
                                                <select class="form-select" id="branch" name="branch" required>
                                                    <option value="">Ders Seçiniz</option>
                                                    <option value="matematik">Matematik</option>
                                                    <option value="fen_bilimleri">Fen Bilimleri</option>
                                                    <option value="turkce">Türkçe</option>
                                                    <option value="sosyal_bilgiler">Sosyal Bilgiler</option>
                                                    <option value="ingilizce">İngilizce</option>
                                                    <option value="dkab">Din K. ve Ahlak Bilgisi</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="question_image" class="form-label">Soru Görseli </label>
                                                <input type="file" class="form-control" id="question_image" name="question_image" required>
                                            </div>
                                            

                                            
                                            <div class="mb-3">
                                                <label for="answer" class="form-label">Cevap Şıkkı </label>
                                                <input type="text" class="form-control" id="answer" name="answer" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                           
                            </div>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                </div>
        </div>
        <!--end::App Content-->
@endsection