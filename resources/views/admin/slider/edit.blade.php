@extends('admin.layouts.main')
@section('title', 'Slider Güncelleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Slider Güncelleme</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb item active" aria-current="page">Slider Yönetimi</li>
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
                        foreach($sliders as $item){
                            $slider_id = $item->slider_id;
                            $title[$item->lang] = $item->title;
                            $slide_title[$item->lang] = $item->slide_title;
                            $title_1[$item->lang] = $item->title_1;
                            $title_2[$item->lang] = $item->title_2;
                            $button_title[$item->lang] = $item->button_title;
                            $image[$item->lang] = $item->image;
                            $alt[$item->lang] = $item->alt;
                            $sort[$item->lang] = $item->sort;
                            $url[$item->lang] = $item->url;

                        }
                    ?>
                    <div class="card-body">
                        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="tab-content" id="myTabContent">
                                @foreach($languages as $language)
                                <input type="hidden" name="slider_id" value="{{ $slider_id }}">
                                <input type="hidden" name="lang_{{ $language->lang_code }}" value="{{ $language->lang_code }}">
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $language->id }}" role="tabpanel" aria-labelledby="tab-{{ $language->id }}-tab">
                                    <div class="card-body" style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                                        <!-- slide_title -->
                                        <div class="mb-3">
                                            <label for="slide_title_{{ $language->lang_code }}" class="form-label">Slide Adı ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" class="form-control" id="slide_title_{{ $language->lang_code }}" name="slide_title_{{ $language->lang_code }}" required value="{{ $slide_title[$language->lang_code] ?? '' }}">
                                        </div>
                                        <div class="form-group" style="display:none">
                                            <label for="title_{{ $language->lang_code }}">Başlık ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" name="title_{{ $language->lang_code }}" class="form-control" id="title_{{ $language->lang_code }}" value="-" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="title_1_{{ $language->lang_code }}">Başlık ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" name="title_1_{{ $language->lang_code }}" class="form-control" id="title_1_{{ $language->lang_code }}" value="{{ $title_1[$language->lang_code] ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="title_2_{{ $language->lang_code }}">Text Açıklama Yazısı({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" name="title_2_{{ $language->lang_code }}" class="form-control" id="title_2_{{ $language->lang_code }}" value="{{ $title_2[$language->lang_code] ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="button_title_{{ $language->lang_code }}">Buton Başlığı ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" name="button_title_{{ $language->lang_code }}" class="form-control" id="button_title_{{ $language->lang_code }}" value="{{ $button_title[$language->lang_code] ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="url_{{ $language->lang_code }}">URL ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" name="url_{{ $language->lang_code }}" class="form-control" id="url_{{ $language->lang_code }}" value="{{ $url[$language->lang_code] ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="image_{{ $language->lang_code }}">Resim ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="file" name="image_{{ $language->lang_code }}" class="form-control" id="image_{{ $language->lang_code }}">
                                            @if(isset($image[$language->lang_code]))
                                                <img src="{{ $language->domain .'/'. getFolder(['uploads_folder','images_folder'], $language->lang_code). '/' . $image[$language->lang_code] }}" alt="{{ $alt[$language->lang_code] }}" style="width: 100px; margin-top: 10px;">
                                                <input type="hidden" class="form-control" id="old_image_{{ $language->lang_code }}" name="old_image_{{ $language->lang_code }}" value="{{ $image[$language->lang_code] }}" readonly>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="alt_{{ $language->lang_code }}">Alt Metni ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" name="alt_{{ $language->lang_code }}" class="form-control" id="alt_{{ $language->lang_code }}" value="{{ $alt[$language->lang_code] ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sort_{{ $language->lang_code }}">Sıralama ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="number" name="sort_{{ $language->lang_code }}" class="form-control" id="sort_{{ $language->lang_code }}" value="{{ $sort[$language->lang_code] ?? 0 }}" required>
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