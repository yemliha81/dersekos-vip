@extends('admin.layouts.main')
@section('title', 'Menü Yönetimi')
<style>
  .child-row td {
    background-color: #f1f1f1 !important;
  }
</style>
@section('content')
   <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">{{ $type == 'footer' ? 'Footer Menü Yönetimi' : 'Menü Yönetimi' }}</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $type == 'footer' ? 'Footer Menü Yönetimi' : 'Menü Yönetimi' }}</li>
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
                        <h3 style="display:inline-block;" class="card-title"></h3>
                        <?php $type = $type ?? 'header'; 
                          $url = $type == 'header' ? 'admin.menu' : 'admin.menu.footer';
                        ?>
                        <a style="display:inline-block;" href="{{ route($url . '.create', $type) }}" class="btn btn-sm btn-primary">Menü Ekle</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Başlık</th>
                          <th>Menü Tipi</th>
                          <th  style="width: 300px">İşlem</th>
                        </tr>
                      </thead>
                      <tbody class="connectedSortable" table_name="menu" column_name="menu_id">
                        @foreach($menus as $menu)
                        <tr  data-id="{{$menu->menu_id}}">
                          <td>
                            <i class="bi bi-list"></i>
                          </td>
                          <td><strong>{{ $menu->title }}</strong></td>
                          <td>
                            {{ $menu->menu_type }}
                          </td>
                          <td>
                            <a href="{{ route('admin.menu.edit', $menu->menu_id) }}" class="btn btn-primary btn-sm">Düzenle</a>
                            <form action="{{ route('admin.menu.destroy', $menu->menu_id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                          </td>
                        </tr>
                        @if($menu->children)
                            @foreach($menu->children as $child)
                                <tr  data-id="{{$child->menu_id}}" class="child-row">
                                  <td>
                                    <i class="bi bi-list"></i>
                                  </td>
                                  <td> <!-- bullet icon--> 
                                    &nbsp; &nbsp; - {{ $child->title }}</td>
                                  <td>
                                    {{ $child->menu_type }}
                                  </td>
                                  <td>
                                    <a href="{{ route('admin.menu.edit', $child->menu_id) }}" class="btn btn-primary btn-sm">Düzenle</a>
                                    <form action="{{ route('admin.menu.destroy', $child->menu_id) }}" method="POST" style="display:inline;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bu içeriği silmek istediğinize emin misiniz?')">Sil</button>
                                    </form>
                                  </td>
                                </tr>
                                @if($child->children)
                                    @foreach($child->children as $child2)
                                        <tr  data-id="{{$child2->menu_id}}" class="child-row">
                                          <td>
                                            <i class="bi bi-list"></i>
                                          </td>
                                          <td> <!-- bullet icon--> 
                                            &nbsp; &nbsp; &nbsp; &nbsp; - {{ $child2->title }}</td>
                                          <td>
                                            {{ $child2->menu_type }}
                                          </td>
                                          <td>
                                            <a href="{{ route('admin.menu.edit', $child2->menu_id) }}" class="btn btn-primary btn-sm">Düzenle</a>
                                            <form action="{{ route('admin.menu.destroy', $child2->menu_id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bu içeriği silmek istediğinize emin misiniz?')">Sil</button>
                                            </form>
                                          </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                        @endforeach
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