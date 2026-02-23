@extends('layouts.main')


@section('content')
    <style>
        .cart-div {
            margin-top: 50px;
            border:1px solid #dddddd;
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
                                            <form action="{{ route('student.cart.remove') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                                                <button type="submit" class="btn btn-danger btn-sm">Kaldır</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div>
                        <h3>Toplam: {{ number_format($totalPrice, 2) }} ₺</h3>
                        <a class="btn btn-primary" href="{{route('student.iyzico.pay')}}">Ödeme Yap</a>
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