@extends('admin.layouts.main')
@section('title', 'Hakkımızda Ekleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Hakkımızda Ekleme</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Hakkımızda Yönetimi</li>
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
                    <div class="card-body">
                        <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="myTabContent">
                            @foreach($languages as $language)
                            <?php if($language->lang_code == 'tr'){ $required = 'required'; }else{ $required = ''; } ?>
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $language->id }}" role="tabpanel" aria-labelledby="tab-{{ $language->id }}-tab">
                                    <div class="card-body" style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                                        <input type="hidden" name="lang_{{ $language->lang_code }}" value="{{ $language->lang_code }}">
                                        <div class="mb-3">
                                            <div>
                                                <label for="upper_title_{{ $language->lang_code }}" class="form-label">Üst Başlık ({{ $language->lang_code }})</label>
                                                <input type="text" class="form-control" id="upper_title_{{ $language->lang_code }}" name="upper_title_{{ $language->lang_code }}" {{ $required }}>
                                            </div>
                                            <div>
                                                <label for="title_{{ $language->lang_code }}" class="form-label">Başlık ({{ $language->lang_code }})</label>
                                                <input type="text" class="form-control" id="title_{{ $language->lang_code }}" name="title_{{ $language->lang_code }}" {{ $required }}>
                                            </div>
                                            <div>
                                                <label for="title_1_{{ $language->lang_code }}" class="form-label">Alt Başlık ({{ $language->lang_code }})</label>
                                                <input type="text" class="form-control" id="title_1_{{ $language->lang_code }}" name="title_1_{{ $language->lang_code }}" {{ $required }}>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description_{{ $language->lang_code }}" class="form-label">Açıklama ({{ $language->lang_code }})</label>
                                            <textarea class="form-control" id="description_{{ $language->lang_code }}" name="description_{{ $language->lang_code }}" rows="3" {{ $required }}></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image_{{ $language->lang_code }}" class="form-label">Görsel ({{ $language->lang_code }})</label>
                                            <input type="file" class="form-control" id="image_{{ $language->lang_code }}" name="image_{{ $language->lang_code }}" accept="image/*" {{ $required }}>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alt_{{ $language->lang_code }}" class="form-label">Alt Metni ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="alt_{{ $language->lang_code }}" name="alt_{{ $language->lang_code }}" {{ $required }}>
                                        </div>
                                        <div class="mb-3">
                                            <label for="bg_video_{{ $language->lang_code }}" class="form-label">Arka Plan Videosu ({{ $language->lang_code }})</label>
                                            <input type="file" class="form-control" id="bg_video_{{ $language->lang_code }}" name="bg_video_{{ $language->lang_code }}" accept="video/*">
                                        </div>
                                        <div></div>
                                        <div class="mb-3">
                                            <label for="mission_title_{{ $language->lang_code }}" class="form-label">Misyon Başlığı ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="mission_title_{{ $language->lang_code }}" name="mission_title_{{ $language->lang_code }}" {{ $required }}>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mission_text_{{ $language->lang_code }}" class="form-label">Misyon Açıklaması ({{ $language->lang_code }})</label>
                                            <textarea   class="form-control" id="mission_text_{{ $language->lang_code }}" name="mission_text_{{ $language->lang_code }}" rows="3" {{ $required }}></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mission_image_{{ $language->lang_code }}" class="form-label">Misyon Görseli ({{ $language->lang_code }})</label>
                                            <input type="file" class="form-control" id="mission_image_{{ $language->lang_code }}" name="mission_image_{{ $language->lang_code }}" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label for="vision_title_{{ $language->lang_code }}" class="form-label">Vizyon Başlığı ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="vision_title_{{ $language->lang_code }}" name="vision_title_{{ $language->lang_code }}" {{ $required }}>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vision_text_{{ $language->lang_code }}" class="form-label">Vizyon Açıklaması ({{ $language->lang_code }})</label>
                                            <textarea class="form-control" id="vision_text_{{ $language->lang_code }}" name="vision_text_{{ $language->lang_code }}" rows="3" {{ $required }}></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vision_image_{{ $language->lang_code }}" class="form-label">Vizyon Görseli ({{ $language->lang_code }})</label>
                                            <input type="file" class="form-control" id="vision_image_{{ $language->lang_code }}" name="vision_image_{{ $language->lang_code }}" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label for="seo_title_{{ $language->lang_code }}" class="form-label">SEO Başlığı ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control seo_title" id="seo_title_{{ $language->lang_code }}" name="seo_title_{{ $language->lang_code }}" {{ $required }}>
                                        </div>
                                        <div class="mb-3">
                                            <label for="seo_description_{{ $language->lang_code }}" class="form-label">SEO Açıklaması ({{ $language->lang_code }})</label>
                                            <textarea class="form-control seo_description" id="seo_description_{{ $language->lang_code }}" name="seo_description_{{ $language->lang_code }}" rows="3" {{ $required }}></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="seo_keywords_{{ $language->lang_code }}" class="form-label">SEO Anahtar Kelimeleri ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="seo_keywords_{{ $language->lang_code }}" name="seo_keywords_{{ $language->lang_code }}" {{ $required }}>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                        </form>
                    </div>
                </div>
                </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
@endsection