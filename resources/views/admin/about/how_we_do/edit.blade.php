@extends('admin.layouts.main')
@section('title', 'Hakkımızda(Nasıl Yaparız) Güncelleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Hakkımızda(Nasıl Yaparız) Güncelleme</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb item active" aria-current="page">Hakkımızda(Nasıl Yaparız) Yönetimi</li>
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
                        foreach($howWeDoContent as $content){
                            $content_id[$content->lang] = $content->content_id;
                            $title[$content->lang] = $content->title;
                            $title_1[$content->lang] = $content->title_1;
                            $description[$content->lang] = $content->description;
                            $image[$content->lang] = $content->image;
                            $icon_image[$content->lang] = $content->icon_image;
                            $alt[$content->lang] = $content->alt;
                        }
                    ?>
                    <div class="card-body">
                        <form action="{{ route('admin.about.how_we_do.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <?php 
                                $iconList = getIconList();
                            ?>

                            
                            
                            <div class="tab-content" id="myTabContent">
                                @foreach($languages as $key => $language)
                                <input type="hidden" name="content_id" value="{{ $content_id[$language->lang_code] }}">
                                <input type="hidden" name="lang" value="{{ $language->lang_code }}">
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $language->id }}" role="tabpanel" aria-labelledby="tab-{{ $language->id }}-tab">
                                    <div class="card-body" style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                                        <div class="form-group">
                                            <label for="title_{{ $language->lang_code }}">Başlık ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" class="form-control" id="title_{{ $language->lang_code }}" name="title_{{ $language->lang_code }}" value="{{ $title[$language->lang_code] }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="title_1_{{ $language->lang_code }}">Başlık 1 ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" class="form-control" id="title_1_{{ $language->lang_code }}" name="title_1_{{ $language->lang_code }}" value="{{ $title_1[$language->lang_code] }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description_{{ $language->lang_code }}">Açıklama ({{ strtoupper($language->lang_code) }})</label>
                                            <textarea class="form-control" id="description_{{ $language->lang_code }}" name="description_{{ $language->lang_code }}" rows="3" required>{{ $description[$language->lang_code] }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="image_{{ $language->lang_code }}">Resim ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="file" class="form-control" id="image_{{ $language->lang_code }}" name="image_{{ $language->lang_code }}">
                                            @if(isset($image[$language->lang_code]))
                                                <img src="{{ $languages[$key]->domain .'/'. getFolder(['uploads_folder', 'images_folder'], $language->lang_code) .'/'.$image[$language->lang_code] }}" alt="{{ $alt[$language->lang_code] }}" style="width: 200px; height: auto; margin-top: 10px;">
                                                <input type="hidden" class="form-control" id="old_image_{{ $language->lang_code }}" name="old_image_{{ $language->lang_code }}" value="{{ $image[$language->lang_code] }}" readonly>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <label for="icon_image_{{ $language->lang_code }}">İkon Seçimi ({{ strtoupper($language->lang_code) }})</label>
                                                <select name="icon_image_{{ $language->lang_code }}" id="icon_image_{{ $language->lang_code }}" class="form-control" onchange="updateIconPreview('{{ $language->lang_code }}')">
                                                    <?php foreach($iconList as $icon): ?>
                                                        <option value="{{ $icon }}" {{ $icon_image[$language->lang_code] === $icon ? 'selected' : '' }}>{{ $icon }}</option>
                                                    <?php endforeach; ?>
                                                </select>
                                                @if(isset($icon_image[$language->lang_code]))
                                                    <div style="margin-top: 10px;">
                                                        <i class="iconfont {{ $icon_image[$language->lang_code] }}" style="font-size: 40px;"></i>
                                                    </div>
                                                    <input type="hidden" class="form-control" id="old_icon_image_{{ $language->lang_code }}" name="old_icon_image_{{ $language->lang_code }}" value="{{ $icon_image[$language->lang_code] }}" readonly>
                                                @endif
                                            </div>
                                        </div>
                                        <script>
                                            function updateIconPreview(langCode) {
                                                var selectElement = document.getElementById('icon_image_' + langCode);
                                                var selectedIcon = selectElement.value;
                                                var previewDiv = selectElement.nextElementSibling;
                                                
                                                if (!previewDiv || !previewDiv.querySelector('i')) {
                                                    previewDiv = document.createElement('div');
                                                    previewDiv.style.marginTop = '10px';
                                                    selectElement.parentNode.insertBefore(previewDiv, selectElement.nextSibling);
                                                }
                                                
                                                previewDiv.innerHTML = '<i class="iconfont ' + selectedIcon + '" style="font-size: 40px;"></i>';
                                            }
                                        </script>
                                        <div class="form-group">
                                            <label for="alt_{{ $language->lang_code }}">Alt Metin ({{ strtoupper($language->lang_code) }})</label>
                                            <input type="text" class="form-control" id="alt_{{ $language->lang_code }}" name="alt_{{ $language->lang_code }}" value="{{ $alt[$language->lang_code] }}" required>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Güncelle</button>
                                <a href="{{ route('admin.about.how_we_do') }}" class="btn btn-secondary">Geri Dön</a>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        <!--end::App Content-->
@endsection