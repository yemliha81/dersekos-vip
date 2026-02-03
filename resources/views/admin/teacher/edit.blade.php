@extends('admin.layouts.main')
@section('title', 'Eğitmen Detay')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Eğitmen Detay</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Eğitmen Yönetimi</li>
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
                        <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content" id="myTabContent">
                                
                                
                                <div class="tab-pane show active " id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
                                    <div class="card-body">
                                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                      <div class="grids-3">
                                            <!-- image -->
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Resim</label>
                                                <input type="file" class="form-control" id="image" name="image" >
                                                
                                                @if($teacher->image == null)
                                                    <img src="{{ asset('assets/img/default-image.png') }}" class="profile-img" width="80" alt="">
                                                @else
                                                <img src="{{ asset($teacher->image) }}" class="profile-img" width="80" alt="">
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="teacher" class="form-label">Ad - Soyad </label>
                                                <input type="text" class="form-control" id="teacher" name="name" value="{{ $teacher->name }}" >
                                            </div>
                                            <!-- branch -->
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Branş</label>
                                                <input type="text" class="form-control" id="title" name="branch" value="{{ $teacher->branch }}" >
                                            </div>
                                            <!-- email -->
                                            <div class="mb-3">
                                                <label for="email" class="form-label">E-posta</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $teacher->email }}" >
                                            </div>
                                            <!-- phone -->
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Telefon</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $teacher->phone }}" >
                                            </div>
                                            <!-- experience -->
                                            <div class="mb-3">
                                                <label for="experience" class="form-label">Deneyim</label>
                                                <input type="text" class="form-control" id="experience" name="experience" value="{{ $teacher->experience }}" >
                                            </div>
                                            
                                            <!-- certificates -->
                                            <div class="mb-3">
                                                <label for="certificates" class="form-label">Sertifikalar</label>
                                                <input type="text" class="form-control" id="certificates" name="certificates" value="{{ $teacher->certificates }}" >
                                            </div>
                                            <!-- about --> 
                                            <div class="mb-3">
                                                <label for="about" class="form-label">Hakkında</label>
                                                <textarea class="form-control" id="about" name="about" rows="4">{{ $teacher->about }}</textarea>
                                            </div>
                                            <!-- etiketler --> 
                                            <div class="mb-3">
                                                <label for="tags" class="form-label">Etiketler (Virgül ile ayırın)</label>
                                                <input type="text" class="form-control" id="tags" name="tags" value="{{ $teacher->tags }}" >                                               
                                            </div>

                                            <!-- status --> 
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Durum</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" {{ $teacher->status == 1 ? 'selected' : '' }}>Aktif</option>
                                                    <option value="0" {{ $teacher->status == 0 ? 'selected' : '' }}>Pasif</option>
                                                </select>
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
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize any JavaScript components if needed
            // price input will be shown if is_free is 0
            const isFreeSelect = document.getElementById('is_free');
            const priceInput = document.getElementById('price-container');

            isFreeSelect.addEventListener('change', function () {
                
                if (this.value == '0') {
                    priceInput.style.display = 'block';
                } else {
                    priceInput.style.display = 'none';
                }
            });
        });
    </script>
@endsection

@section('scripts')

    

@endsection