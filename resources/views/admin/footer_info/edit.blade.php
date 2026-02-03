@extends('admin.layouts.main')
@section('title', 'Footer Bilgisi Güncelleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Footer Bilgisi Güncelleme</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Footer Yönetimi</li>
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
                        foreach($footerInfos as $footerInfo){
                            $address[$footerInfo->lang] = $footerInfo->address;
                            $phone[$footerInfo->lang] = $footerInfo->phone;
                            $email[$footerInfo->lang] = $footerInfo->email;
                            $map_url[$footerInfo->lang] = $footerInfo->map_url;
                            $facebook_url[$footerInfo->lang] = $footerInfo->facebook_url;
                            $youtube_url[$footerInfo->lang] = $footerInfo->youtube_url;
                            $linkedin_url[$footerInfo->lang] = $footerInfo->linkedin_url;
                            $x_url[$footerInfo->lang] = $footerInfo->x_url;
                            $instagram_url[$footerInfo->lang] = $footerInfo->instagram_url;
                            $footer_text[$footerInfo->lang] = $footerInfo->footer_text;
                            $footer_logo[$footerInfo->lang] = $footerInfo->footer_logo;
                            $alt[$footerInfo->lang] = $footerInfo->alt;
                        }
                    ?>
                    <div class="card-body">
                        <form action="{{ route('admin.footer_info.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content" id="myTabContent">
                                @foreach($languages as $language)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $language->id }}" role="tabpanel" aria-labelledby="tab-{{ $language->id }}-tab">
                                    <div class="card-body" style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                                        <input type="hidden" name="lang_{{ $language->lang_code }}" value="{{ $language->lang_code }}">
                                        <div class="mb-3">
                                            <label for="address_{{ $language->lang_code }}" class="form-label">Adres ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="address_{{ $language->lang_code }}" name="address_{{ $language->lang_code }}" required value="{{ $address[$language->lang_code] ?? '' }}">
                                        </div>
                                        <!-- title_1 -->
                                        <div class="mb-3">
                                            <label for="phone_{{ $language->lang_code }}" class="form-label">Telefon ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="phone_{{ $language->lang_code }}" name="phone_{{ $language->lang_code }}" required value="{{ $phone[$language->lang_code] ?? '' }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email_{{ $language->lang_code }}" class="form-label">E-posta ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="email_{{ $language->lang_code }}" name="email_{{ $language->lang_code }}" required value="{{ $email[$language->lang_code] ?? '' }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="map_url_{{ $language->lang_code }}" class="form-label">Harita URL ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="map_url_{{ $language->lang_code }}" name="map_url_{{ $language->lang_code }}" required value="{{ $map_url[$language->lang_code] ?? '' }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="facebook_url_{{ $language->lang_code }}" class="form-label">Facebook URL ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="facebook_url_{{ $language->lang_code }}" name="facebook_url_{{ $language->lang_code }}" required value="{{ $facebook_url[$language->lang_code] ?? '' }}">
                                        </div>
                                        
                                        <!-- youtube_url -->
                                        <div class="mb-3">
                                            <label for="youtube_url_{{ $language->lang_code }}" class="form-label">YouTube URL ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="youtube_url_{{ $language->lang_code }}" name="youtube_url_{{ $language->lang_code }}" value="{{ $youtube_url[$language->lang_code] ?? '' }}">
                                        </div>
                                        <!-- linkedin_url -->
                                        <div class="mb-3">
                                            <label for="linkedin_url_{{ $language->lang_code }}" class="form-label">LinkedIn URL ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="linkedin_url_{{ $language->lang_code }}" name="linkedin_url_{{ $language->lang_code }}" value="{{ $linkedin_url[$language->lang_code] ?? '' }}">
                                        </div>
                                        <!-- x_url -->
                                        <div class="mb-3">
                                            <label for="x_url_{{ $language->lang_code }}" class="form-label">X URL ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="x_url_{{ $language->lang_code }}" name="x_url_{{ $language->lang_code }}" value="{{ $x_url[$language->lang_code] ?? '' }}">
                                        </div>
                                        <!-- instagram_url -->
                                        <div class="mb-3">
                                            <label for="instagram_url_{{ $language->lang_code }}" class="form-label">Instagram URL ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="instagram_url_{{ $language->lang_code }}" name="instagram_url_{{ $language->lang_code }}" value="{{ $instagram_url[$language->lang_code] ?? '' }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="footer_text_{{ $language->lang_code }}" class="form-label">Footer Text ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="footer_text_{{ $language->lang_code }}" name="footer_text_{{ $language->lang_code }}" value="{{ $footer_text[$language->lang_code] ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="footer_logo_{{ $language->lang_code }}">Resim ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="file" name="footer_logo_{{ $language->lang_code }}" class="form-control" id="footer_logo_{{ $language->lang_code }}">
                                            @if(isset($footer_logo[$language->lang_code]))
                                            <div style="background:#dddddd; padding:15px;">
                                                <img src="{{ $language->domain .'/'. getFolder(['uploads_folder', 'images_folder'], $language->lang_code) .'/'.$footer_logo[$language->lang_code] }}" alt="{{ $alt[$language->lang_code] }}" style="width: 100px; margin-top: 10px;">
                                                <input type="hidden" class="form-control" id="old_footer_logo_{{ $language->lang_code }}" name="old_footer_logo_{{ $language->lang_code }}" value="{{ $footer_logo[$language->lang_code] }}" readonly>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="alt_{{ $language->lang_code }}" class="form-label">Alt Text ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="alt_{{ $language->lang_code }}" name="alt_{{ $language->lang_code }}" value="{{ $alt[$language->lang_code] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                </div>
        </div>
        <!--end::App Content-->
@endsection