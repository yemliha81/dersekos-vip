@extends('admin.layouts.main')
@section('title', 'Menü Ekleme')

@section('content')

<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">{{$type == 'footer' ? 'Footer ' : ''}}Menü Ekleme</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Menü Yönetimi</li>
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
                        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="tab-content" id="myTabContent">
                            @foreach($languages as $language)
                            <?php $required = $language->lang_code == 'en' ? 'required' : ''; ?>
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{$language->id}}" role="tabpanel" aria-labelledby="tab{{$language->id}}-tab">
                                
                                    <div class="card-body" style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                        @csrf
                                        <input type="hidden" name="sort" value="0" >
                                        <input type="hidden" name="isActive" value="1">
                                        <input type="hidden" name="lang_{{$language->lang_code}}" value="{{$language->lang_code}}">
                                        <!-- Page Type Dropdown -->
                                        <div class="mb-3">
                                            <label for="page_type_{{$language->lang_code}}" class="form-label">Sayfa Türü ({{ $language->lang_code }})</label>
                                            <select name="page_type_{{$language->lang_code}}" id="page_type_{{$language->lang_code}}" class="form-select" >
                                                <option value="">Seçiniz</option>
                                                <option value="grade">Sınıf</option>
                                                <option value="lesson">Ders</option>
                                                <option value="about">Kurumsal</option>
                                                <option value="contact">İletişim</option>
                                                <option value="blog">Blog</option>
                                                <option value="contact">İletişim</option>
                                                <option value="page">Özel Sayfa</option>
                                            </select>
                                        </div>
                                        <!-- Parent Menu Dropdown -->
                                        <div class="mb-3">
                                            <label for="parent_menu_id_{{$language->lang_code}}" class="form-label">Üst Menü ({{ $language->lang_code }})</label>
                                            <select name="parent_menu_id_{{$language->lang_code}}" id="parent_menu_id_{{$language->lang_code}}" class="form-select" {{ $required }}>
                                                <option value="0">Seçiniz</option>
                                                @foreach($parentMenus as $parentMenu)
                                                    <option value="{{ $parentMenu->menu_id }}">{{ $parentMenu->title }}</option>
                                                    @if($parentMenu->has('children'))
                                                        @foreach($parentMenu->children as $child)
                                                            <option value="{{ $child->menu_id }}">-- {{ $child->title }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Title -->
                                        <div class="mb-3">
                                            <label for="title_{{$language->lang_code}}" class="form-label">Başlık ({{ $language->lang_code }})<span class="text-danger">*</span></label>
                                            <input type="text" name="title_{{$language->lang_code}}" id="title_{{$language->lang_code}}" class="form-control" maxlength="255" {{ $required }}>
                                        </div>
                                        @if($type == 'header')
                                            <!-- Image -->
                                            <div class="mb-3">
                                                <label for="image_{{$language->lang_code}}" class="form-label">Resim ({{ $language->lang_code }})<span class="text-danger">*</span></label>
                                                <input type="file" name="image_{{$language->lang_code}}" id="image_{{$language->lang_code}}" class="form-control" accept="image/*" {{ $required }}>
                                            </div>
                                            
                                            <!-- Alt Text -->
                                            <div class="mb-3">
                                                <label for="alt_{{$language->lang_code}}" class="form-label">Alt Text ({{ $language->lang_code }})<span class="text-danger">*</span></label>
                                                <input type="text" name="alt_{{$language->lang_code}}" id="alt_{{$language->lang_code}}" class="form-control" maxlength="255" {{ $required }}>
                                            </div>
                                        
                                        @endif
                                        <!-- SEO URL -->
                                        <div class="mb-3">
                                            <label for="seo_url_{{$language->lang_code}}" class="form-label">Seo URL ({{ $language->lang_code }})<span class="text-danger">*</span></label>
                                            <input type="text" name="seo_url_{{$language->lang_code}}" id="seo_url_{{$language->lang_code}}" class="form-control" maxlength="255" {{ $required }}>
                                        </div>
                                        <!-- Menu Type -->
                                        <div class="mb-3">
                                            <label for="menu_type_{{$language->lang_code}}" class="form-label">Menu Tipi ({{ $language->lang_code }})<span class="text-danger">*</span></label>
                                            <!-- set selectbox as readonly and default value is $type from controller -->
                                            <select name="menu_type_{{$language->lang_code}}" id="menu_type_{{$language->lang_code}}" class="form-select" readonly {{ $required }}>
                                                <option value="{{ $type }}" selected>{{ ucfirst($type) }}</option>
                                            </select>   

                                            
                                        </div>

                                        <!-- Submit Button -->
                                        
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
        <!--end::App Content-->
@endsection