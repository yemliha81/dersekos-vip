@extends('admin.layouts.main')
@section('title', 'Dil Güncelleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dil Güncelleme</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dil Güncelleme</li>
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
                    <!-- Create Language Form -->
                    <form action="{{ route('admin.language.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $language->id }}">
                        <div class="card-body" style="display:grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
                            <div class="mb-2">
                                <label for="lang_code" class="form-label">Dil Kodu</label>
                                <input type="text" class="form-control" id="lang_code" name="lang_code" value="{{ $language->lang_code }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="domain" class="form-label">Domain</label>
                                <input type="text" class="form-control" id="domain" name="domain" value="{{ $language->domain }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="path" class="form-label">Resim Dizin</label>
                                <input type="text" class="form-control" id="path" name="path" value="{{ $language->path }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="title" class="form-label">Başlık</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $language->title }}" required>
                            </div>
                            <div class="mb-2" style="display: flex; flex-direction: row; align-items: center; gap: 10px;">
                                <div>
                                    <label for="flag_image" class="form-label">Bayrak Görseli</label>
                                    <input type="file" class="form-control" id="flag_image" name="flag_image" accept="image/*">
                                </div>
                                <div>
                                    @if($language->flag_image)
                                        <img src="{{ $language->domain .'/'. getFolder(['uploads_folder','images_folder'], $language->lang_code) . '/' . $language->flag_image }}" alt="{{ $language->lang_code }}" style="width: 200px; height: auto; margin-top: 10px;">
                                        <input type="hidden" class="form-control" id="old_flag_image" name="old_flag_image" value="{{ $language->flag_image }}" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="about_url" class="form-label">Hakkımızda URL</label>
                                <input type="text" class="form-control" id="about_url" name="about_url" value="{{ $language->about_url }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="sector_url" class="form-label">Sektör URL</label>
                                <input type="text" class="form-control" id="sector_url" name="sector_url" value="{{ $language->sector_url }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="brand_url" class="form-label">Marka URL</label>
                                <input type="text" class="form-control" id="brand_url" name="brand_url" value="{{ $language->brand_url }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="career_url" class="form-label">Kariyer URL</label>
                                <input type="text" class="form-control" id="career_url" name="career_url" value="{{ $language->career_url }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="catalog_url" class="form-label">Katalog URL</label>
                                <input type="text" class="form-control" id="catalog_url" name="catalog_url" value="{{ $language->catalog_url }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="blog_url" class="form-label">Blog URL</label>
                                <input type="text" class="form-control" id="blog_url" name="blog_url" value="{{ $language->blog_url }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="contact_url" class="form-label">İletişim URL</label>
                                <input type="text" class="form-control" id="contact_url" name="contact_url" value="{{ $language->contact_url }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="uploads_folder" class="form-label">Yükleme Klasörü</label>
                                <input type="text" class="form-control" id="uploads_folder" name="uploads_folder" value="{{ $language->uploads_folder }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="images_folder" class="form-label">Görseller Klasörü</label>
                                <input type="text" class="form-control" id="images_folder" name="images_folder" value="{{ $language->images_folder }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="sector_images_folder" class="form-label">Sektör Görseller Klasörü</label>
                                <input type="text" class="form-control" id="sector_images_folder" name="sector_images_folder" value="{{ $language->sector_images_folder }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="brand_images_folder" class="form-label">Marka Görseller Klasörü</label>
                                <input type="text" class="form-control" id="brand_images_folder" name="brand_images_folder" value="{{ $language->brand_images_folder }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="blog_images_folder" class="form-label">Blog Görseller Klasörü</label>
                                <input type="text" class="form-control" id="blog_images_folder" name="blog_images_folder" value="{{ $language->blog_images_folder }}" required>
                            </div>
                            <div class="mb-2">
                                <label for="catalog_files_folder" class="form-label">Katalog Dosyaları Klasörü</label>
                                <input type="text" class="form-control" id="catalog_files_folder" name="catalog_files_folder" value="{{ $language->catalog_files_folder }}" required>
                            </div>
                            <div class="mb-2">  
                                <label for="ga_code" class="form-label">Google Analytics Kodu</label>
                                <textarea class="form-control" id="ga_code" name="ga_code">{{ $language->ga_code }}</textarea>
                            </div>
                            <div class="mb-2">
                                <label for="bitrix_form_code" class="form-label">Bitrix Form Kodu</label>
                                <textarea class="form-control" id="bitrix_form_code" name="bitrix_form_code">{{ $language->bitrix_form_code }}</textarea>
                            </div>
                            <div class="mb-2">  
                                <label for="bitrix_widget_code" class="form-label">Bitrix Widget Kodu</label>
                                <textarea class="form-control" id="bitrix_widget_code" name="bitrix_widget_code">{{ $language->bitrix_widget_code }}</textarea>
                            </div>
                            <div class="mb-2">
                                <label for="sort" class="form-label">Sıralama</label>
                                <input type="number" class="form-control" id="sort" name="sort" value="{{ $language->sort }}" required>
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
@endsection