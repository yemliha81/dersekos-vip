@extends('admin.layouts.main')
@section('title', 'Menü Güncelleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Menü Güncelleme</h3></div>
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
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $language->lang_code }}-tab" data-bs-toggle="tab" data-bs-target="#tab-{{ $language->lang_code }}"
                                            type="button" role="tab" aria-controls="tab-{{ $language->lang_code }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        <img src="{{ $language->domain .'/'. getFolder(['uploads_folder', 'images_folder'], $language->lang_code) .'/'.$language->flag_image }}" alt="{{ $language->title }}" style="width: 20px; margin-right: 5px;"> {{ strtoupper($language->lang_code) }}

                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="myTabContent">
                            @foreach($menu_items as $key => $menu)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{$menu->lang}}" role="tabpanel" aria-labelledby="tab{{$menu->lang}}-tab">
                                    <div class="card-body" style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px;">    
                                        <input type="hidden" name="lang_{{$menu->lang}}" value="{{$menu->lang}}">
                                        <input type="hidden" name="menu_id" value="{{ $menu->menu_id }}">
                                        <!-- Page Type Dropdown -->
                                        <div class="mb-3">
                                            <label for="page_type_{{$menu->lang}}" class="form-label">Sayfa Türü ({{ $menu->lang }})</label>
                                            <select name="page_type_{{$menu->lang}}" id="page_type_{{$menu->lang}}" class="form-select">
                                                <option value="">Seçiniz</option>
                                                <option value="grade" {{ $menu->page_type == 'grade' ? 'selected' : '' }}>Sınıf</option>
                                                <option value="lesson" {{ $menu->page_type == 'lesson' ? 'selected' : '' }}>Ders</option>
                                                <option value="about" {{ $menu->page_type == 'about' ? 'selected' : '' }}>Kurumsal</option>
                                                <option value="contact" {{ $menu->page_type == 'contact' ? 'selected' : '' }}>İletişim</option>
                                                <option value="blog" {{ $menu->page_type == 'blog' ? 'selected' : '' }}>Blog</option>
                                                <option value="contact" {{ $menu->page_type == 'contact' ? 'selected' : '' }}>İletişim</option>
                                                <option value="page" {{ $menu->page_type == 'page' ? 'selected' : '' }}>Özel Sayfa</option>
                                            </select>
                                        </div>
                                        <!-- Parent Menu Dropdown -->
                                        <div class="mb-3">
                                            <label for="parent_menu_id_{{$menu->lang}}" class="form-label">Üst Menü ({{ $menu->lang }})</label>
                                            <select name="parent_menu_id_{{$menu->lang}}" id="parent_menu_id_{{$menu->lang}}" class="form-select">
                                                <option value="0">Seçiniz</option>
                                                @foreach($parentMenus as $parentMenu)
                                                    <option value="{{ $parentMenu->menu_id }}" {{ $parentMenu->menu_id == $menu->parent_menu_id ? 'selected' : '' }}>{{ $parentMenu->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Title -->
                                        <div class="mb-3">
                                            <label for="title_{{$menu->lang}}" class="form-label">Başlık ({{ $menu->lang }})<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="title_{{$menu->lang}}" name="title_{{$menu->lang}}" value="{{ $menu->title }}" required>
                                        </div>
                                        <!-- Image -->
                                        @if($menu->menu_type == 'header')
                                        <div class="mb-3">
                                            <label for="image_{{$menu->lang}}" class="form-label">Resim ({{ $menu->lang }})</label>
                                            <input type="file" class="form-control" id="image_{{$menu->lang}}" name="image_{{$menu->lang}}" accept="image/*">
                                            @if($menu->{'image'})
                                                <input type="hidden" class="form-control mt-2" name="old_image_{{$menu->lang}}" value="{{ $menu->{'image'} }}" readonly>
                                                <img src="{{ $languages[$key]->domain .'/'. getFolder(['uploads_folder', 'images_folder'], $menu->lang) .'/'.$menu->image }}" alt="Menu Image" class="img-thumbnail mt-2" style="max-width: 200px;">
                                            @endif
                                        </div>
                                        <!-- Alt Text -->
                                        <div class="mb-3">
                                            <label for="alt_{{$menu->lang}}" class="form-label">Alt Text ({{ $menu->lang }})<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="alt_{{$menu->lang}}" name="alt_{{$menu->lang}}" value="{{ $menu->{'alt'} }}" required>
                                        </div>
                                        @endif
                                        
                                        <!-- SEO URL -->
                                        <div class="mb-3">
                                            <label for="seo_url_{{$menu->lang}}" class="form-label">SEO URL ({{ $menu->lang }})<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="seo_url_{{$menu->lang}}" name="seo_url_{{$menu->lang}}" value="{{ $menu->seo_url }}" required>
                                        </div>
                                        <!-- Menu Type -->
                                        <div class="mb-3">
                                            <label for="menu_type_{{$menu->lang}}" class="form-label">Menü Türü ({{ $menu->lang }})<span class="text-danger">*</span></label>
                                            <select class="form-select" id="menu_type_{{$menu->lang}}" name="menu_type_{{$menu->lang}}" required>
                                                <option value="header" {{ $menu->{'menu_type'} == 'header' ? 'selected' : '' }}>Header</option>
                                                <option value="footer" {{ $menu->{'menu_type'} == 'footer' ? 'selected' : '' }}>Footer</option>
                                            </select>
                                        </div>
                                        <!-- Sort Order -->
                                        <div class="mb-3">
                                            <label for="sort_{{$menu->lang}}" class="form-label">Sıralama ({{ $menu->lang }})</label>
                                            <input type="number" class="form-control" id="sort_{{$menu->lang}}" name="sort_{{$menu->lang}}" value="{{ $menu->{'sort'} }}" min="0">
                                        </div>
                                        <!-- URL Block -->
                                        <div class="mb-3">
                                            <label for="url_block_{{$menu->lang}}" class="form-label">URL Engelleme ({{ $menu->lang }})</label>
                                            <input type="checkbox" class="form-check-input" id="url_block_{{$menu->lang}}" name="url_block_{{$menu->lang}}" value="1" {{ $menu->{'url_block'} ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </div>
                        </form>
                    </div>
                </div>
        </div>
        <!--end::App Content-->
@endsection