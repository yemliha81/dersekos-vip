@extends('layouts.main')


@section('content')
<main>
    <style>
        .teachers-list{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            justify-content: center;
        }
    </style>
  <div class="">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-50 mt-50 lead-text">
                        <h1 class="mb-20">Eğitmenlerimiz</h1>
                        
                        <div class="teachers-list">
                            @foreach($teachers as $teacher)
                                <div style="padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                                    @if($teacher->image == null)
                                        <img src="{{ asset('assets/img/default-image.png') }}" class="profile-img" width="80" alt="">
                                    @else
                                    <img src="{{ env('APP_URL') . '/' . $teacher->image }}" class="profile-img" width="80" alt="">
                                    @endif
                                    <div style=""><strong>{{ $teacher->name }} {{ $teacher->surname }}</strong></div>
                                    <span class="">{{ ucwords(str_replace('_', ' ',   $teacher->branch)) }} </span>
                                    <div style="margin-top:8px; display:flex; gap:8px; align-items:center; justify-content:center">
                                        <a href="{{route('teacher.public.profile', ['id' => $teacher->id])}}" class="btn btn-primary" style="padding:8px 12px; font-weight:700">Profili İncele</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </div>
</main>

@endsection


