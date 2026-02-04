@extends('layouts.main')


@section('content')

    <div class="main-content">
        
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="vip-packages">
                <h1>Paketlerimiz</h1>
                @foreach($vip_packages as $package)
                    <div class="vip-package" style="border:1px solid #ccc; padding:15px; margin-bottom:20px; display:flex; gap:15px;">
                        <div>
                            <img src="{{ env('APP_URL') .'/'. $package->image }}" width="200" alt="">
                        </div>
                        <div>
                            <b>{{ $package->title }}</b>
                            <p>{{ $package->description }}</p>
                            <p>{{ $package->price }} TL</p>
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


