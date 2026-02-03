@extends('admin.layouts.main')
@section('title', 'Hakkımızda Güncelleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Hakkımızda Güncelleme</h3></div>
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
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $language->lang_code }}-tab" data-bs-toggle="tab" data-bs-target="#tab-{{ $language->lang_code }}"
                                            type="button" role="tab" aria-controls="tab-{{ $language->lang_code }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
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
                            @foreach($about_contents as $key => $about)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{$about->lang}}" role="tabpanel" aria-labelledby="tab{{$about->lang}}-tab">
                                    <div class="card-body" style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px;">    
                                        <input type="hidden" name="lang_{{$about->lang}}" value="{{$about->lang}}">
                                        <input type="hidden" name="id" value="{{ $about->id }}">
                                        <div class="mb-3">
                                            <div>
                                                <label for="upper_title_{{ $about->lang }}" class="form-label">Üst Başlık ({{ $about->lang }})</label>
                                                <input type="text" class="form-control" id="upper_title_{{ $about->lang }}" name="upper_title_{{ $about->lang }}" value="{{ $about->upper_title }}" required>
                                            </div>
                                            <div>
                                                <label for="title_{{ $about->lang }}" class="form-label">Başlık ({{ $about->lang }})</label>
                                                <input type="text" class="form-control" id="title_{{ $about->lang }}" name="title_{{ $about->lang }}" value="{{ $about->title }}" required>
                                            </div>
                                            <div>
                                                <label for="title_1_{{ $about->lang }}" class="form-label">Alt Başlık ({{ $about->lang }})</label>
                                                <input type="text" class="form-control" id="title_1_{{ $about->lang }}" name="title_1_{{ $about->lang }}" value="{{ $about->title_1 }}" required>
                                            </div>
                                        </div>
                                        <!-- title_1 -->
                                        

                                        <div class="mb-3">
                                            <div>
                                                <label for="banner_image_{{ $about->lang }}" class="form-label">Header Görsel ({{ $about->lang }})</label>
                                                <input type="file" class="form-control" id="banner_image_{{ $about->lang }}" name="banner_image_{{ $about->lang }}" accept="image/*">
                                                @if($about->banner_image)
                                                <img src="{{ $languages[$key]->domain .'/'. getFolder(['uploads_folder', 'images_folder'], $about->lang ) .'/'.$about->banner_image }}" 
                                                    alt="{{ $about->title }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                                                    <input type="hidden" class="form-control mt-2" name="old_banner_image_{{ $about->lang }}" value="{{ $about->banner_image }}" readonly>
                                                @endif
                                            </div>
                                            <div>
                                                <label for="image_{{ $about->lang }}" class="form-label">Görsel ({{ $about->lang }})</label>
                                                <input type="file" class="form-control" id="image_{{ $about->lang }}" name="image_{{ $about->lang }}" accept="image/*">
                                                @if($about->image)
                                                <img src="{{ $languages[$key]->domain .'/'. getFolder(['uploads_folder', 'images_folder'], $about->lang ) .'/'.$about->image }}" 
                                                    alt="{{ $about->title }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                                                    <input type="hidden" class="form-control mt-2" name="old_image_{{ $about->lang }}" value="{{ $about->image }}" readonly>
                                                @endif
                                            </div>
                                            <div>
                                                <label for="description_{{ $about->lang }}" class="form-label">Açıklama ({{ $about->lang }})</label>
                                                <textarea class="form-control" id="description_{{ $about->lang }}" name="description_{{ $about->lang }}" rows="3" required>{{ $about->description }}</textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="alt_{{ $about->lang }}" class="form-label">Alt Metin ({{ $about->lang }})</label>
                                            <input type="text" class="form-control" id="alt_{{ $about->lang }}" name="alt_{{ $about->lang }}" value="{{ $about->alt }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="bg_video_{{ $about->lang }}" class="form-label">Arka Plan Videosu ({{ $about->lang }})</label>
                                            <input type="file" class="form-control" id="bg_video_{{ $about->lang }}" name="bg_video_{{ $about->lang }}" accept="video/*">
                                            @if($about->bg_video)
                                                <video controls class="mt-2" style="max-width: 400px;">
                                                    <source src="{{  $languages[$key]->domain .'/'. getFolder(['uploads_folder', 'images_folder'], $about->lang ) .'/'.$about->bg_video }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                <input type="hidden" class="form-control mt-2" name="old_bg_video_{{ $about->lang }}" value="{{ $about->bg_video }}" readonly>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="mission_title_{{ $about->lang }}" class="form-label">Misyon Başlığı ({{ $about->lang }})</label>
                                            <input type="text" class="form-control" id="mission_title_{{ $about->lang }}" name="mission_title_{{ $about->lang }}" value="{{ $about->mission_title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mission_text_{{ $about->lang }}" class="form-label">Misyon Açıklaması ({{ $about->lang }})</label>
                                            <textarea class="form-control" id="mission_text_{{ $about->lang }}" name="mission_text_{{ $about->lang }}" rows="3" required>{{ $about->mission_text }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mission_image_{{ $about->lang }}" class="form-label">Misyon Görseli ({{ $about->lang }})</label>
                                            <input type="file" class="form-control" id="mission_image_{{ $about->lang }}" name="mission_image_{{ $about->lang }}" accept="image/*">     
                                            @if($about->mission_image)
                                                <img src="{{ $languages[$key]->domain .'/'. getFolder(['uploads_folder', 'images_folder'], $about->lang) .'/'.$about->mission_image }}" alt="{{ $about->title }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                                                <input type="hidden" class="form-control mt-2" name="old_mission_image_{{ $about->lang }}" value="{{ $about->mission_image }}" readonly>
                                            @endif  
                                        </div>
                                        <div class="mb-3">
                                            <label for="vision_title_{{ $about->lang }}" class="form-label">Vizyon Başlığı ({{ $about->lang }})</label>
                                            <input type="text" class="form-control" id="vision_title_{{ $about->lang }}" name="vision_title_{{ $about->lang }}" value="{{ $about->vision_title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vision_text_{{ $about->lang }}" class="form-label">Vizyon Açıklaması ({{ $about->lang }})</label>
                                            <textarea class="form-control" id="vision_text_{{ $about->lang }}" name="vision_text_{{ $about->lang }}" rows="3" required>{{ $about->vision_text }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vision_image_{{ $about->lang }}" class="form-label">Vizyon Görseli ({{ $about->lang }})</label>
                                            <input type="file" class="form-control" id="vision_image_{{ $about->lang }}" name="vision_image_{{ $about->lang }}" accept="image/*">
                                            @if($about->vision_image)
                                                <img src="{{ $languages[$key]->domain .'/'. getFolder(['uploads_folder', 'images_folder'], $about->lang) .'/'.$about->vision_image }}" alt="{{ $about->title }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                                                <input type="hidden" class="form-control mt-2" name="old_vision_image_{{ $about->lang }}" value="{{ $about->vision_image }}" readonly>
                                            @endif
                                        </div>
                                        <div class="mb-3" style="display:none;">
                                            <label for="seo_title_{{ $about->lang }}" class="form-label">SEO Başlığı ({{ $about->lang }})</label>
                                            <input type="text" class="form-control seo_title" id="seo_title_{{ $about->lang }}" name="seo_title_{{ $about->lang }}" value="{{ $about->seo_title }}" required>
                                        </div>
                                        <div class="mb-3" style="display:none;">
                                            <label for="seo_description_{{ $about->lang }}" class="form-label">SEO Açıklaması ({{ $about->lang }})</label>
                                            <textarea class="form-control seo_description" id="seo_description_{{ $about->lang }}" name="seo_description_{{ $about->lang }}" rows="3" required>{{ $about->seo_description }}</textarea>
                                        </div>
                                        <div class="mb-3" style="display:none;">
                                            <label for="seo_keywords_{{ $about->lang }}" class="form-label">SEO Anahtar Kelimeleri ({{ $about->lang }})</label>
                                            <input type="text" class="form-control" id="seo_keywords_{{ $about->lang }}" name="seo_keywords_{{ $about->lang }}" value="{{ $about->seo_keywords }}" required>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Güncelle</button>
                        </form>
                    </div>
                </div>
        </div>
        <!--end::App Content-->
@endsection