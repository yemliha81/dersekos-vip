@extends('admin.layouts.main')
@section('title', 'Ders Detay')

@section('content')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Ders Detay</h3></div>
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
                    
                    <div class="card-body">
                        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content" id="myTabContent">
                                
                                
                                <div class="tab-pane show active " id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
                                    <div class="card-body">
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                      <div class="grids-3">
                                            <div class="mb-3">
                                                <label for="teacher" class="form-label">Eğitmen </label>
                                                <input type="text" class="form-control" id="teacher" name="teacher" value="{{ $event->teacher->name }}" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="branch" class="form-label">Branş </label>
                                                <input type="text" class="form-control" id="branch" name="branch" value="{{ $event->teacher->branch }}" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Başlık </label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="start" class="form-label">Başlangıç Tarih - Saat </label>
                                                <input type="datetime-local" class="form-control" id="start" name="start" value="{{ \Carbon\Carbon::parse($event->start)->format('Y-m-d\TH:i') }}" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="end" class="form-label">Bitiş Tarih - Saat </label>
                                                <input type="datetime-local" class="form-control" id="end" name="end" value="{{ \Carbon\Carbon::parse($event->end)->format('Y-m-d\TH:i') }}" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="min_person" class="form-label">Katılımcı Minimum </label>
                                                <input type="number" class="form-control" id="min_person" name="min_person" value="{{ $event->min_person }}" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="max_person" class="form-label">Katılımcı Maksimum </label>
                                                <input type="number" class="form-control" id="max_person" name="max_person" value="{{ $event->max_person }}" >
                                            </div>
                                            <!-- is_free selectbox -->
                                            <div class="mb-3">
                                                <label for="is_free" class="form-label">Ücretsiz Mi? </label>
                                                <select class="form-control" id="is_free" name="is_free">
                                                    <option value="1" {{ $event->is_free ? 'selected' : '' }}>Ücretsiz</option>
                                                    <option value="0" {{ !$event->is_free ? 'selected' : '' }}>Ücretli</option>
                                                </select>
                                            </div>
                                            <!-- price -->
                                            <div class="mb-3" style="{{ $event->is_free ? 'display:none;' : '' }}" id="price-container">
                                                <label for="price" class="form-label">Ücret </label>
                                                <input type="text" class="form-control" id="price" name="price" value="{{ $event->price }}" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="grade" class="form-label">Sınıf Seviyesi </label>
                                                <input type="number" class="form-control" id="grade" name="grade" value="{{ $event->grade }}" >
                                            </div>
                                             <!-- meet_url -->
                                            <div class="mb-3">
                                                <label for="meet_url" class="form-label">Ders Url </label>
                                                <input type="text" class="form-control" id="meet_url" name="meet_url" value="{{ $event->meet_url }}" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="attendees" class="form-label">Katılımcılar </label>
                                                <input type="text" class="form-control" id="attendees" name="attendees" value="{{ $event->attendees }}" >
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                           
                            </div>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                </div>
        </div>
        <!--end::App Content-->
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize any JavaScript components if needed
            // price input will be shown if is_free is 0
            const isFreeSelect = document.getElementById('is_free');
            const priceInput = document.getElementById('price-container');

            isFreeSelect.addEventListener('change', function () {
                
                if (this.value == '0') {
                    priceInput.style.display = 'block';
                } else {
                    priceInput.style.display = 'none';
                }
            });
        });
    </script>
@endsection

@section('scripts')

    

@endsection