@extends('admin.layouts.main')
@section('title', 'Dil Yönetimi')

@section('content')
   <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dil Yönetimi</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dil Yönetimi</li>
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
                        <h3 style="display:inline-block;" class="card-title">Striped Full Width Table</h3>
                        <a style="display:inline-block;" href="{{ route('admin.language.create') }}" class="btn btn-sm btn-primary">Dil Ekle</a>
                    </div>
                    
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-striped dataTable">
                      <thead>
                        <tr>
                          <th style="width: 30px">#</th>
                          <th>Başlık</th>
                          <th></th>
                          <th>Görsel</th>
                          <th  style="width: 300px">İşlem</th>
                        </tr>
                      </thead>
                      <tbody class="connectedSortable">
                        <?php foreach($languages as $language): ?>
                        <tr>
                          <td>{{ $language->id }}</td>
                          <td>{{ $language->title }}</td>
                          <td>{{ $language->lang_code }}</td>
                          <td><img src="{{ $language->domain .'/'. getFolder(['uploads_folder','images_folder'], $language->lang_code) . '/' . $language->flag_image }}" alt="{{ $language->title }}" style="width: 30px;"></td>
                          <td>
                            <a href="{{ route('admin.language.edit', $language->id) }}" class="btn btn-sm btn-warning">Düzenle</a>
                            <form action="{{ route('admin.language.destroy', $language->id) }}" method="POST" style="display:inline-block;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                            </form>
                          </td>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
@endsection