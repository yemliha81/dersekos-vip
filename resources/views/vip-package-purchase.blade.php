@extends('layouts.main')


@section('content')

    <div class="main-content">
        
        <div class="container">
            <div class="vip-packages">
                <h1>{{ $vip_package->title }}</h1>
                
                    <div class="vip-package" style="border:1px solid #ccc; padding:15px; margin-bottom:20px; display:flex; gap:15px;">
                        <div>
                            <img src="{{ env('APP_URL') .'/'. $vip_package->image }}" alt="">
                        </div>
                        <div>
                            <b>{{ $vip_package->title }}</b>
                            <p>{{ $vip_package->description }}</p>
                            <p>{{ $vip_package->price }} TL</p>
                        </div>
                    </div>

                    <div class="credit card-payment-details">

                        <form action="{{ route('vip.package.purchase.post') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $vip_package->id }}">
                            <div class="form-group">
                                <label for="card_number">Kart Numarası</label>
                                <input type="text" id="card_number" name="card_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="card_name">Kart Sahibi</label>
                                <input type="text" id="card_name" name="card_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="expiry_date">Son Kullanma Tarihi</label>
                                <input type="text" id="expiry_date" name="expiry_date" class="form-control" placeholder="MM/YY" required>
                            </div>
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" name="cvv" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Satın Al</button>
                            </div>
                        </form>

                    </div>
                
            </div>
        </div>
    </div>



@endsection


