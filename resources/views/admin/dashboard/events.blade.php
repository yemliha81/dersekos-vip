@extends('admin.layouts.main')
@section('title', 'Ders Listesi')

@section('content')

<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Ders Listesi</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Ders Yönetimi</li>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Ders Listesi</h5>
                            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Ekle
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped dataTable" id="sortable-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sınıf</th>
                                    <th>Başlık</th>
                                    <th>Eğitmen</th>
                                    <th>Tarih - Saat</th>
                                    <th>URL</th>
                                    <th style="width: 150px;">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody class="" >
                                @foreach($events as $item)
                                     <tr  >
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->grade }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->teacher->name }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->start)->format('d.m.Y H:i') }}
                                        </td>
                                        <td>{{ $item->meet_url }}</td>
                                        <td>
                                            <a href="{{ route('admin.events.show', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i> Detaylar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        <!--end::App Content-->
@endsection
