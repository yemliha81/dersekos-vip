@extends('admin.layouts.main')
@section('title', 'Sabit Kelime Güncelleme')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Sabit Kelime Güncelleme</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sabit Kelime Yönetimi</li>
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

                    <?php foreach($staticText as $text){
                        $text_id = $text->text_id;
                        $title[$text->lang] = $text->title;
                        $page_name[$text->lang] = $text->page_name;
                    } ?>

                    <div class="card-body">
                        <form action="{{ route('admin.static_text.store') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="text_id" value="{{ $text_id }}">
                            @csrf
                            <div class="tab-content" id="myTabContent">
                                @foreach($languages as $language)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $language->id }}" role="tabpanel" aria-labelledby="tab-{{ $language->id }}-tab">
                                    <div class="card-body" style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                                        <input type="hidden" name="lang_{{ $language->lang_code }}" value="{{ $language->lang_code }}">
                                        <input type="hidden" name="text_id" value="{{ $text_id }}">
                                        <div class="mb-3">
                                            <label for="title_{{ $language->lang_code }}" class="form-label">Metin ({{ $language->lang_code }})</label>
                                            <textarea class="form-control" id="title_{{ $language->lang_code }}" name="title_{{ $language->lang_code }}" rows="3" required>{{ $title[$language->lang_code] ?? '' }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="page_name_{{ $language->lang_code }}" class="form-label">Sayfa Adı ({{ $language->lang_code }})</label>
                                            <input type="text" class="form-control" id="page_name_{{ $language->lang_code }}" name="page_name_{{ $language->lang_code }}" required value="{{ $page_name[$language->lang_code] ?? '' }}">
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