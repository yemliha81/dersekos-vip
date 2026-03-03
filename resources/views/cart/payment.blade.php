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
        /* Cart Items */
        .cart-item {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .item-image {
            width: 120px;
            height: 120px;
            border-radius: 15px;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .item-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
            color: #1e293b;
        }

        .item-subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .item-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .item-feature {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #f1f5f9;
            border-radius: 50px;
            padding: 0.25rem;
        }

        .qty-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: none;
            background: white;
            color: #667eea;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: #667eea;
            color: white;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .item-price {
            text-align: right;
        }

        .price-current {
            font-size: 1.5rem;
            font-weight: 800;
            color: #667eea;
        }

        .price-original {
            font-size: 0.9rem;
            color: #94a3b8;
            text-decoration: line-through;
            margin-right: 0.5rem;
        }

        .btn-remove {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-remove:hover {
            background: #ef4444;
            color: white;
        }
        @media (max-width: 768px) {
            .parent-payment-div{
                grid-template-columns: 1fr;
            }
        }
    </style>
    <div class="container">
        <div class="mt-5">
            
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
                    <div class="col-lg-12">
                
                        @foreach($cartItems as $item)
                        
                        <div class="cart-item fade-in">
                            <div class="row align-items-center">
                                <div class="col-md-2 col-4 mb-3 mb-md-0">
                                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=300&h=300&fit=crop" alt="Package" class="item-image">
                                </div>
                                <div class="col-md-5 col-8 mb-3 mb-md-0">
                                    <h3 class="item-title">{{ $item['name'] }}</h3>
                                    @if($item['type'] == 'lesson')
                                    <p class="item-subtitle">Ders sonrası ödev ve uygulama</p>
                                    @else
                                    <p class="item-subtitle">Canlı grup dersleri ile etkileşimli öğrenme</p>
                                    @endif
                                    <!--<p class="item-subtitle">Matematik + Fen Bilimleri</p>-->
                                    <div class="item-features">
                                        
                                        @if($item['type'] == 'lesson')
                                        <span class="item-feature"><i class="bi bi-person"></i>Bire bir</span>
                                        <span class="item-feature"><i class="bi bi-person"></i>Hedef odaklı</span>
                                        <span class="item-feature"><i class="bi bi-person"></i>Başarı takibi</span>
                                        @else
                                        <span class="item-feature"><i class="bi bi-camera-video"></i>Canlı Ders</span> 
                                        <span class="item-feature"><i class="bi bi-camera-video"></i>Ödev Takibi</span>
                                        <span class="item-feature"><i class="bi bi-camera-video"></i>PDF Kaynaklar</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    
                                </div>
                                <div class="col-md-2 col-6 text-end">
                                    <div class="item-price">
                                        <div class="price-current">{{ number_format($item['price'], 2) }} ₺</div>
                                    </div>
                                    
                                    <form action="{{ route('student.cart.remove') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                                        <button type="submit" class="btn-remove mt-2">
                                            <i class="bi bi-trash"></i> Kaldır
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                @endif
                
            </div>
            <div class="parent-payment-div">
                <div class="cart-item">
                    <h3 style="border-bottom: 1px solid #f1f1f1;padding-bottom: 20px;">Veli Bilgileri (Fatura için gereklidir)</h3>
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
                <div id="iyzipay-checkout-form" class="responsive cart-item">
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