@extends('admin.layouts.main')
@section('title', 'Seo Ayarları Güncelleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Seo Ayarları Güncelleme</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb item active" aria-current="page">Seo Yönetimi</li>
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
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            @foreach($languages as $language)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $language->id }}-tab" data-bs-toggle="tab" data-bs-target="#tab-{{ $language->id }}"
                                            type="button" role="tab" aria-controls="tab-{{ $language->id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        <img src="{{ $language->domain .'/'. getFolder(['uploads_folder', 'images_folder'], $language->lang_code) .'/'.$language->flag_image }}" alt="{{ $language->title }}" style="width: 20px; margin-right: 5px;"> {{ strtoupper($language->lang_code) }}
                                    </button>
                                </li>
                            @endforeach
                        </ul> 
                    </div>
                    <?php 
                        foreach($seo_settings as $item){
                            $page[$item->lang] = $item->page;
                            $seo_title[$item->lang] = $item->seo_title;
                            $seo_description[$item->lang] = $item->seo_description;
                            $seo_keywords[$item->lang] = $item->seo_keywords;
                        }
                    ?>
                    <div class="card-body">
                        <form action="{{ route('admin.seo.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="tab-content" id="myTabContent">
                                @foreach($languages as $language)
                                <input type="hidden" name="lang_{{ $language->lang_code }}" value="{{ $language->lang_code }}">
                                <input type="hidden" name="seo_id" value="{{ $id }}">
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $language->id }}" role="tabpanel" aria-labelledby="tab-{{ $language->id }}-tab">
                                    <div class="card-body" style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                                        <!-- page type -->
                                        <div class="mb-3">
                                            <label for="page_{{ $language->lang_code }}" class="form-label">Sayfa Türü ({{ strtoupper($language->lang_code) }})</label>
                                            <select name="page_{{ $language->lang_code }}" id="page_{{ $language->lang_code }}" class="form-select" required>
                                                <option value="home" {{ $page[$language->lang_code] == 'home' ? 'selected' : '' }}>Anasayfa</option>
                                                <option value="about" {{ $page[$language->lang_code] == 'about' ? 'selected' : '' }}>Hakkımızda</option>
                                                <option value="career" {{ $page[$language->lang_code] == 'career' ? 'selected' : '' }}>Kariyer</option>
                                                <option value="news" {{ $page[$language->lang_code] == 'news' ? 'selected' : '' }}>Haberler</option>
                                                <option value="contact" {{ $page[$language->lang_code] == 'contact' ? 'selected' : '' }}>İletişim</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="seo_title_{{ $language->lang_code }}" class="form-label">Seo Başlığı ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" class="form-control seo_title" id="seo_title_{{ $language->lang_code }}" name="seo_title_{{ $language->lang_code }}" required value="{{ $seo_title[$language->lang_code] ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="seo_description_{{ $language->lang_code }}">Seo Açıklaması ({{ strtoupper($language->lang_code) }})</label>
                                            <textarea name="seo_description_{{ $language->lang_code }}" class="form-control seo_description" id="seo_description_{{ $language->lang_code }}" required>{{ $seo_description[$language->lang_code] ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="seo_keywords_{{ $language->lang_code }}">Seo Anahtar Kelimeleri ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" name="seo_keywords_{{ $language->lang_code }}" class="form-control" id="seo_keywords_{{ $language->lang_code }}" value="{{ $seo_keywords[$language->lang_code] ?? '' }}" required>
                                        </div>
                                        
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Güncelle</button>
                                <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">Geri Dön</a>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        <!--end::App Content-->
@endsection