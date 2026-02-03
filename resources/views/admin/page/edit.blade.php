@extends('admin.layouts.main')
@section('title', 'Sayfa Güncelleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Sayfa Güncelleme</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb item active" aria-current="page">Sayfa Yönetimi</li>
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
                        foreach($pages as $page){
                            $page_id[$page->lang] = $page->page_id;
                            $title[$page->lang] = $page->title;
                            $description[$page->lang] = $page->description;
                            $image[$page->lang] = $page->image;
                            $alt[$page->lang] = $page->alt;
                            $seo_url[$page->lang] = $page->seo_url;
                            $seo_title[$page->lang] = $page->seo_title;
                            $seo_description[$page->lang] = $page->seo_description;
                            $seo_keywords[$page->lang] = $page->seo_keywords;
                        }
                    ?>
                    <div class="card-body">
                        <form action="{{ route('admin.page.store', $page_id[$language->lang_code]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="tab-content" id="myTabContent">
                                @foreach($languages as $language)
                                <input type="hidden" name="page_id" value="{{ $page_id[$language->lang_code] }}">
                                <input type="hidden" name="lang" value="{{ $language->lang_code }}">
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $language->id }}" role="tabpanel" aria-labelledby="tab-{{ $language->id }}-tab">
                                    <div class="card-body">
                                        <div class="grids-4">
                                            <div class="form-group">
                                                <label for="title_{{ $language->lang_code }}">Başlık ({{ strtoupper($language->lang_code) }})</label>
                                                <input type="text" class="form-control" id="title_{{ $language->lang_code }}" name="title_{{ $language->lang_code }}" value="{{ $title[$language->lang_code] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_url_{{ $language->lang_code }}">SEO URL ({{ strtoupper($language->lang_code) }})</label>
                                                <input type="text" class="form-control" id="seo_url_{{ $language->lang_code }}" name="seo_url_{{ $language->lang_code }}" value="{{ $seo_url[$language->lang_code] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="image_{{ $language->lang_code }}">Resim ({{ strtoupper($language->lang_code) }})</label>
                                                <input type="file" class="form-control" id="image_{{ $language->lang_code }}" name="image_{{ $language->lang_code }}">
                                                @if(isset($image[$language->lang_code]))
                                                    <img src="{{ $language->domain .'/'. getFolder(['uploads_folder','images_folder'], $language->lang_code) . '/' . $image[$language->lang_code] }}" alt="{{ $alt[$language->lang_code] }}" style="width: 200px; height: auto; margin-top: 10px;">
                                                    <input type="hidden" class="form-control" id="old_image_{{ $language->lang_code }}" name="old_image_{{ $language->lang_code }}" value="{{ $image[$language->lang_code] }}" readonly>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="alt_{{ $language->lang_code }}">Alt Metin ({{ strtoupper($language->lang_code) }})</label>
                                                <input type="text" class="form-control" id="alt_{{ $language->lang_code }}" name="alt_{{ $language->lang_code }}" value="{{ $alt[$language->lang_code] }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description_{{ $language->lang_code }}">Açıklama ({{ strtoupper($language->lang_code) }})</label>
                                            <textarea class="form-control editor " id="description_{{ $language->lang_code }}" name="description_{{ $language->lang_code }}" rows="3" required>{{ $description[$language->lang_code] }}</textarea>
                                        </div>
                                        <div class="grids-3">
                                            <div class="form-group">
                                                <label for="seo_title_{{ $language->lang_code }}">SEO Başlık ({{ strtoupper($language->lang_code) }})</label>
                                                <input type="text" class="form-control seo_title" id="seo_title_{{ $language->lang_code }}" name="seo_title_{{ $language->lang_code }}" value="{{ $seo_title[$language->lang_code] }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_description_{{ $language->lang_code }}">SEO Açıklama ({{ strtoupper($language->lang_code) }})</label>
                                                <textarea class="form-control seo_description" id="seo_description_{{ $language->lang_code }}" name="seo_description_{{ $language->lang_code }}" rows="3">{{ $seo_description[$language->lang_code] }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_keywords_{{ $language->lang_code }}">SEO Anahtar Kelimeler ({{ strtoupper($language->lang_code) }})</label>
                                                <input type="text" class="form-control" id="seo_keywords_{{ $language->lang_code }}" name="seo_keywords_{{ $language->lang_code }}" value="{{ $seo_keywords[$language->lang_code] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Güncelle</button>
                                <a href="{{ route('admin.page.index') }}" class="btn btn-secondary">Geri Dön</a>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        <!--end::App Content-->
@endsection