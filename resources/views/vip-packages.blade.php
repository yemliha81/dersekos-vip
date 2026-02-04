@extends('layouts.main')


@section('content')
    <style>
        .vip-packages {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .vip-package {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: space-between;
            gap: 20px;
        }
        .vip-package img {
            width: 100%;
            height: auto;
        }
        @media (max-width: 768px) {
            
            .vip-package img {
                width: 100%;
                height: auto;
        }
        }
           
    </style>
    <div class="main-content">
        
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="section-title mb-4 mt-4 text-center">
                <h1>Paketlerimiz</h1>
            </div>
            <div class="vip-packages">
                @foreach($vip_packages as $package)
                    <div class="vip-package">
                        <div>
                            <img src="{{ env('APP_URL') .'/'. $package->image }}" width="200" alt="">
                        </div>
                        <div>
                            <b>{{ $package->title }}</b>
                            <p>{{ $package->description }}</p>
                            <p>Aylık: {{ $package->price }} TL</p>
                        </div>
                        <div>
                            <a href="{{ route('vip.package.purchase', $package->id) }}" class="btn btn-primary">Satın Al</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection


