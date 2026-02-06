@extends('layouts.main')


@section('content')
    <style>
        .cart-div {
            margin-top: 50px;
            background: #faffd6ff;
            padding: 20px;
            border-radius: 10px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
    <div class="container">
        <div class="cart-div">
            <h1>Sepetim</h1>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                @if(isset($cartItems) && count($cartItems) == 0)
                    <p>Sepetiniz boş.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ürün</th>
                                <th>Fiyat</th>
                                <th>Adet</th>
                                <th>Toplam</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ number_format($item['price'], 2) }} ₺</td>
                                        <td>1</td>
                                        <td>{{ number_format($item['price'] * 1) }} ₺</td>
                                        <td>
                                            <form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                                                <button type="submit" class="btn btn-danger btn-sm">Kaldır</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <h3>Toplam: {{ number_format($totalPrice, 2) }} ₺</h3>



                    <div class="credit card-payment-details">

                        <form action="{{ route('vip.package.purchase.post') }}" method="post">
                            @csrf
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
                @endif
            </div>
            
        </div>
@endsection

@section('scripts')
    <script>
        // ERemove from Cart function Ajax
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection