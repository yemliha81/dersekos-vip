@extends('admin.layouts.main')
@section('title', 'Dil Ekleme')

@section('content')

<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dil Ekleme</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dil Ekleme</li>
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
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                <form action="{{ route('admin.language.store') }}" method="POST" enctype="multipart/form-data">
                                    <div class="card-body" style="display:grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
                                        @csrf

                                        <!-- Title -->
                                        <div class="mb-2">
                                            <label for="title" class="form-label">Dil Adı <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="form-control" maxlength="100" required>
                                        </div>

                                        <!-- Language Code -->
                                        <div class="mb-2">
                                            <label for="title" class="form-label">Dil Kodu <span class="text-danger">*</span></label>
                                            <input type="text" name="lang_code" id="lang_code" class="form-control" maxlength="100" required>
                                        </div>
                                        <!-- domain -->
                                        <div class="mb-2">
                                            <label for="domain" class="form-label">Domain <span class="text-danger">*</span></label>
                                            <input type="text" name="domain" id="domain" class="form-control" maxlength="100" required>
                                        </div>

                                        <!-- Path -->
                                        <div class="mb-2">
                                            <label for="path" class="form-label">Resim Dizin <span class="text-danger">*</span></label>
                                            <input type="text" name="path" id="path" class="form-control" maxlength="100" required>
                                        </div>

                                        <!-- Flag Image -->
                                        <div class="mb-2">
                                            <label for="flag_image" class="form-label">Bayrak Görseli <span class="text-danger">*</span></label>
                                            <input type="file" name="flag_image" id="flag_image" class="form-control" accept="image/*" required>
                                        </div>

                                        <!-- About URL -->
                                        <div class="mb-2">
                                            <label for="about_url" class="form-label">About URL <span class="text-danger">*</span></label>
                                            <input type="text" name="about_url" id="about_url" class="form-control" maxlength="255" required>
                                        </div>

                                       

                                        <!-- Blog URL -->
                                        <div class="mb-2">
                                            <label for="blog_url" class="form-label">Blog URL <span class="text-danger">*</span></label>
                                            <input type="text" name="blog_url" id="blog_url" class="form-control" maxlength="255" required>
                                        </div>

                                        <!-- Contact URL -->
                                        <div class="mb-2">
                                            <label for="contact_url" class="form-label">Contact URL <span class="text-danger">*</span></label>
                                            <input type="text" name="contact_url" id="contact_url" class="form-control" maxlength="255" required>
                                        </div>

                                        <!-- Uploads Folder -->
                                        <div class="mb-2">
                                            <label for="uploads_folder" class="form-label">Uploads Folder <span class="text-danger">*</span></label>
                                            <input type="text" name="uploads_folder" id="uploads_folder" class="form-control" maxlength="255" required>
                                        </div>

                                        <!-- Images Folder -->
                                        <div class="mb-2">
                                            <label for="images_folder" class="form-label">Images Folder <span class="text-danger">*</span></label>
                                            <input type="text" name="images_folder" id="images_folder" class="form-control" maxlength="255" required>
                                        </div>

                                       

                                        <!-- Blog Images Folder -->
                                        <div class="mb-2">
                                            <label for="blog_images_folder" class="form-label">Blog Images Folder <span class="text-danger">*</span></label>
                                            <input type="text" name="blog_images_folder" id="blog_images_folder" class="form-control" maxlength="255" required>
                                        </div>

                                        

                                        <!-- GA Code -->
                                        <div class="mb-2">
                                            <label for="ga_code" class="form-label">Google Analytics Code</label>
                                            <textarea name="ga_code" id="ga_code" class="form-control"></textarea>
                                        </div>

                                        <!-- Bitrix Form Code -->
                                        <div class="mb-2">
                                            <label for="bitrix_form_code" class="form-label">Bitrix Form Code</label>
                                            <textarea name="bitrix_form_code" id="bitrix_form_code" class="form-control"></textarea>
                                        </div>

                                        <!-- Bitrix Widget Code -->
                                        <div class="mb-2">
                                            <label for="bitrix_widget_code" class="form-label">Bitrix Widget Code</label>
                                            <textarea name="bitrix_widget_code" id="bitrix_widget_code" class="form-control"></textarea>
                                        </div>

                                        <!-- Sort -->
                                        <div class="mb-2">
                                            <label for="sort" class="form-label">Sort Order</label>
                                            <input type="number" name="sort" id="sort" class="form-control" value="0">
                                        </div>

                                       
                                        
                                    </div>
                                     <!-- Submit Button -->
                                         <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Kaydet</button>
                                        </div>
                                </form>

                            </div>
                           
                            
                        </div>
                    </div>
                </div>

   
          
        </div>
        <!--end::App Content-->
@endsection