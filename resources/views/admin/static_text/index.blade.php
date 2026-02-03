@extends('admin.layouts.main')
@section('title', 'Sabit Kelime Yönetimi')
@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Sabit Kelime Yönetimi</h3></div>
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
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!-- /.col -->
              <div class="col-md-12">           
                <!-- /.card -->
                <div class="card mb-4">
                  <div class="card-header" >
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="display:inline-block;" class="card-title">Sabit Kelime Yönetimi</h3>
                        <a style="display:inline-block;" href="{{ route('admin.static_text.create') }}" class="btn btn-sm btn-primary">Sabit Kelime Ekle</a>
                    </div>
                    
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
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
                    <table class="table table-striped dataTable">
                      <thead>
                        <tr>
                          <th>
                            <div style="display: flex; gap: 10px;align-items: center; justify-content: space-around;">
                              @foreach($languages as $lang)
                              <div>
                                {{ strtoupper($lang->lang_code) }}
                              </div>
                              @endforeach
                            </div>
                          </th>
                          <th>İşlem</th>
                        </tr>
                      </thead>
                      <tbody class="connectedSortable">
                        @foreach($staticTexts as $staticText)
                        <tr>
                          <td>
                            <form id="static-text-form-{{ $staticText['tr']->text_id }}" action="{{ route('admin.static_text.store', $staticText['tr']->text_id) }}" method="POST">
                              @csrf
                              <div style="display: flex; gap: 10px;">
                                @foreach($staticText as $lang => $text)
                                <input class="form-control" type="text" name="static_text[{{ $lang }}]" value="{{ $text->title }}">
                                @endforeach
                                <input type="hidden" name="text_id" value="{{ $staticText['tr']->text_id }}">
                                <input type="hidden" name="update" value="1">
                              </div>
                            </form>
                          </td>
                          <td>
                            <a href="javascript:void(0)" onclick="document.getElementById('static-text-form-{{ $staticText['tr']->text_id }}').submit();" class="btn btn-sm btn-info">Kaydet</a>
                          </td>
                        </tr>
                        
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                </div>
                <!-- /.col -->
                </div>
            <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
@endsection
