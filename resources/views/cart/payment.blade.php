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
        #iyzipay-checkout-form{
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        .parent-payment-div{
            margin-top:50px;
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .parent-form{
            padding: 15px;
            border: 1px solid #ddd;
            background: #e7e7e7;
            border-radius: 10px;
        }
        @media (max-width: 768px) {
            .parent-payment-div{
                grid-template-columns: 1fr;
            }
        }
    </style>
    <div class="container">
        <div class="cart-div">
            <h1>Ödeme Formu</h1>
                <?php $cartItems = session()->get('cart', []); 
                    $totalPrice = 0;
                    foreach ($cartItems as $item) {
                        $totalPrice += $item['price'];
                    }
                ?>
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
                    <h3>Toplam: {{ number_format($totalPrice, 2) }} ₺</h3>

                @endif
                
            </div>
            <div class="parent-payment-div">
                <div class="parent-form">
                    <h2>Veli Bilgileri (Fatura için gereklidir)</h2>
                    <form action="{{route('student.save.parent')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Ad (Zorunlu)</label>
                            <input type="text" name="first_name" class="form-control" value="{{$student->studentParent->first_name ?? ''}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Soyad (Zorunlu)</label>
                            <input type="text" name="last_name" class="form-control" value="{{$student->studentParent->last_name ?? ''}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">TC Kimlik No (Zorunlu değil)</label>
                            <input type="text" name="tc_no" class="form-control" value="{{$student->studentParent->tc_no ?? ''}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-posta (Zorunlu)</label>
                            <input type="email" name="email" class="form-control" required value="{{$student->studentParent->email ?? ''}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefon (Zorunlu)</label>
                            <input type="tel" name="phone" class="form-control" required value="{{$student->studentParent->phone ?? ''}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adres (Zorunlu)</label>
                            <input type="text" name="address" class="form-control" required value="{{$student->studentParent->address ?? ''}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">İl (Zorunlu)</label>
                            <input type="text" name="city" class="form-control" required value="{{$student->studentParent->city ?? ''}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">İlçe (Zorunlu)</label>
                            <input type="text" name="town" class="form-control" required value="{{$student->studentParent->town ?? ''}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Posta Kodu (Zorunlu Değil)</label>
                            <input type="text" name="zipcode" class="form-control" value="{{$student->studentParent->zipcode ?? ''}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </form>
                </div>
                <div id="iyzipay-checkout-form" class="responsive">
                    @if(isset($checkoutForm))
                    {!! $checkoutForm->getCheckoutFormContent() !!}
                    @else
                    <div class="alert alert-warning">
                        Veli bilgileri girildikten sonra ödeme formu açılacaktır.
                    </div>
                    @endif
                </div>
            </div>
            
        </div>
@endsection

@section('scripts')
 
@endsection