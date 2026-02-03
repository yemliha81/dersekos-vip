@extends('admin.layouts.main')
@section('title', 'Soru Güncelleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Soru Güncelleme</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Soru Yönetimi</li>
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
                        <form action="{{ route('admin.exam.questions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content" id="myTabContent">
                               <input type="hidden" name="id" value="{{ $question->id }}">
                                <div class="" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
                                    <div class="card-body">
                                       <div class="">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Başlık </label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ $question->title }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="subtitle" class="form-label">Alt Başlık </label>
                                                <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ $question->subtitle }}" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="json_data" class="form-label">Json Data </label>
                                            <textarea class="form-control " id="json_data" rows="20" name="json_data" rows="3"  required>{{ $question->json_data }}</textarea>
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