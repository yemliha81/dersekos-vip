@extends('layouts.main')


@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-bg: #f8fafc;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: #1e293b;
        }

        /* Header */
        .cart-header {
            background: var(--primary-gradient);
            padding: 3rem 0;
            color: white;
            position: relative;
            overflow: hidden;
            margin: 20px 0;
            text-align: center;
            font-size: 24px;
            border-radius: 20px;
        }

        .cart-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .breadcrumb-item a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: white;
        }

        /* Cart Steps */
        .cart-steps {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
            position: relative;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            color: #667eea;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            border: 3px solid #667eea;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: #667eea;
            color: white;
            box-shadow: 0 0 0 5px rgba(102, 126, 234, 0.2);
        }

        .step.completed .step-number {
            background: var(--success-color);
            border-color: var(--success-color);
            color: white;
        }

        .step-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #64748b;
        }

        .step.active .step-label {
            color: #667eea;
        }

        .step-line {
            position: absolute;
            top: 25px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 3px;
            background: #e2e8f0;
            z-index: 0;
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

        /* Summary Card */
        .summary-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            position: sticky;
            top: 2rem;
        }

        .summary-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .summary-row:last-of-type {
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
        }

        .summary-label {
            color: #64748b;
        }

        .summary-value {
            font-weight: 600;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .total-label {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .total-value {
            font-size: 2rem;
            font-weight: 800;
            color: #667eea;
        }

        /* Coupon Section */
        .coupon-section {
            background: #f8fafc;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 2px dashed #cbd5e1;
        }

        .coupon-input {
            border: 2px solid #e2e8f0;
            border-radius: 50px 0 0 50px;
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
        }

        .coupon-input:focus {
            border-color: #667eea;
            box-shadow: none;
        }

        .btn-coupon {
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 0 50px 50px 0;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }

        .applied-coupon {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--success-color);
            border-radius: 50px;
            padding: 0.75rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .coupon-code {
            font-weight: 700;
            color: var(--success-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-checkout {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-checkout:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .secure-badge {
            text-align: center;
            margin-top: 1rem;
            color: #64748b;
            font-size: 0.85rem;
        }

        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            width: 150px;
            height: 150px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 4rem;
            color: #667eea;
        }

        .empty-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .empty-text {
            color: #64748b;
            margin-bottom: 2rem;
        }

        /* Recommended Products */
        .recommended-section {
            margin-top: 3rem;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .recommended-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .recommended-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .recommended-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .recommended-body {
            padding: 1.25rem;
        }

        .recommended-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .recommended-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .btn-add-cart {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border: none;
            padding: 0.75rem;
            border-radius: 50px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-add-cart:hover {
            background: #667eea;
            color: white;
        }

        /* Trust Badges */
        .trust-badges {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 3rem;
            flex-wrap: wrap;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #64748b;
        }

        .trust-icon {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #667eea;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .cart-header {
                padding: 2rem 0;
            }

            .item-image {
                width: 80px;
                height: 80px;
            }

            .quantity-control {
                margin: 1rem 0;
            }

            .item-price {
                text-align: left;
                margin-top: 1rem;
            }

            .step-line {
                width: 100px;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-in {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>


    

    <!-- Cart Steps -->
    <div class="container">
        <div class="cart-header">Sepetim</div>
    </div>

    <!-- Main Content -->
    <div class="container mb-5">
        <div class="row g-4">
            
            <!-- Cart Items -->
            <div class="col-lg-8">
                
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

                <!-- Add More Button -->
                <div class="text-center mt-4">
                    <a href="#" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-plus-circle me-2"></i>Başka Paket Ekle
                    </a>
                </div>

            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h3 class="summary-title">
                        <i class="bi bi-receipt"></i>Sipariş Özeti
                    </h3>

                    <!-- Coupon Section -->
                    <div class="coupon-section">
                        <label class="fw-semibold mb-2 d-block">İndirim Kodu</label>
                        <div class="input-group">
                            <input type="text" class="form-control coupon-input" placeholder="Kodunuzu girin" id="couponCode">
                            <button class="btn btn-coupon" onclick="applyCoupon()">Uygula</button>
                        </div>
                        
                        <!-- Applied Coupon (Hidden by default) -->
                        <div class="applied-coupon d-none" id="appliedCoupon">
                            <span class="coupon-code">
                                <i class="bi bi-check-circle-fill"></i>
                                <span id="couponText">KAMPANYA2024</span>
                            </span>
                            <button class="btn btn-sm btn-link text-danger" onclick="removeCoupon()">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Summary Details -->
                    <div class="summary-row">
                        <span class="summary-label">Ara Toplam</span>
                        <span class="summary-value" id="subtotal">{{ number_format($totalPrice, 2) }} ₺</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">KDV (%20)</span>
                        <span class="summary-value" id="tax">₺{{ number_format($totalPrice * 0.2, 2) }}</span>
                    </div>

                    <div class="summary-total">
                        <span class="total-label">Toplam</span>
                        <span class="total-value" id="total">₺{{ number_format($totalPrice, 2) }}</span>
                    </div>

                    <button class="btn-checkout" onclick="proceedToCheckout()">
                        <i class="bi bi-credit-card"></i>
                        Ödemeye Geç
                        <i class="bi bi-arrow-right"></i>
                    </button>

                    <div class="secure-badge">
                        <i class="bi bi-shield-check me-1"></i>
                        256-bit SSL güvenli ödeme
                    </div>

                    <!-- Payment Methods -->
                    <div class="mt-4 pt-4 border-top">
                        <small class="text-muted d-block mb-2">Güvenli Ödeme Seçenekleri</small>
                        <div class="d-flex gap-2 justify-content-center">
                            <i class="bi bi-credit-card-2-front fs-3 text-muted"></i>
                            <i class="bi bi-paypal fs-3 text-muted"></i>
                            <i class="bi bi-bank fs-3 text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Trust Badges -->
        <div class="trust-badges">
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div>
                    <div class="fw-bold">Güvenli Alışveriş</div>
                    <small class="text-muted">256-bit SSL</small>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </div>
                <div>
                    <div class="fw-bold">Kolay İade</div>
                    <small class="text-muted">7 Gün İçinde</small>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <div>
                    <div class="fw-bold">7/24 Destek</div>
                    <small class="text-muted">Canlı Yardım</small>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="bi bi-award"></i>
                </div>
                <div>
                    <div class="fw-bold">Kalite Garantisi</div>
                    <small class="text-muted">Memnuniyet</small>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <!--<footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-mortarboard-fill me-2"></i>DERSE KOŞ</h5>
                    <p class="text-white-50">Kaliteli eğitim, uzman öğretmenler ve başarı odaklı yaklaşım.</p>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Yardım</h6>
                    <ul class="list-unstyled text-white-50">
                        <li><a href="#" class="text-white-50 text-decoration-none">Sıkça Sorulan Sorular</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">İade Politikası</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Gizlilik Politikası</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">İletişim</h6>
                    <p class="text-white-50 mb-1"><i class="bi bi-envelope me-2"></i>info@dersekos.com</p>
                    <p class="text-white-50 mb-1"><i class="bi bi-telephone me-2"></i>0850 123 45 67</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center text-white-50">
                <small>&copy; 2024 DERSE KOŞ. Tüm hakları saklıdır.</small>
            </div>
        </div>
    </footer>-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Quantity Update
        function updateQuantity(btn, change) {
            const input = btn.parentElement.querySelector('.qty-input');
            let value = parseInt(input.value) + change;
            if (value < 1) value = 1;
            if (value > 10) value = 10;
            input.value = value;
            updateTotal();
        }

        // Apply Coupon
        function applyCoupon() {
            const code = document.getElementById('couponCode').value;
            if (code) {
                document.getElementById('appliedCoupon').classList.remove('d-none');
                document.getElementById('couponText').textContent = code.toUpperCase();
                document.getElementById('couponCode').value = '';
                updateTotal();
                
                // Show success animation
                const couponSection = document.querySelector('.coupon-section');
                couponSection.style.borderColor = '#10b981';
                setTimeout(() => {
                    couponSection.style.borderColor = '#cbd5e1';
                }, 1000);
            }
        }

        // Remove Coupon
        function removeCoupon() {
            document.getElementById('appliedCoupon').classList.add('d-none');
            updateTotal();
        }

        // Update Total (Demo calculation)
        function updateTotal() {
            // In real app, this would calculate based on actual items
            console.log('Total updated');
        }

        // Proceed to Checkout
        function proceedToCheckout() {
            const btn = document.querySelector('.btn-checkout');
            btn.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Yönlendiriliyor...';
            btn.disabled = true;
            
            setTimeout(() => {
                window.location.href = '{{route('student.iyzico.pay')}}';
            }, 1500);
        }

        // Remove Item Animation
        document.querySelectorAll('.btn-remove').forEach(btn => {
            btn.addEventListener('click', function() {
                const item = this.closest('.cart-item');
                item.style.transform = 'translateX(100px)';
                item.style.opacity = '0';
                setTimeout(() => {
                    item.remove();
                    updateCartCount();
                }, 300);
            });
        });

        // Update Cart Count
        function updateCartCount() {
            const items = document.querySelectorAll('.cart-item').length;
            const badge = document.querySelector('.badge');
            if (badge) {
                badge.textContent = items;
                if (items === 0) {
                    showEmptyCart();
                }
            }
        }

        // Show Empty Cart
        function showEmptyCart() {
            const container = document.querySelector('.col-lg-8');
            container.innerHTML = `
                <div class="empty-cart fade-in">
                    <div class="empty-icon">
                        <i class="bi bi-cart-x"></i>
                    </div>
                    <h3 class="empty-title">Sepetiniz Boş</h3>
                    <p class="empty-text">Eğitim paketlerimize göz atın ve öğrenmeye başlayın!</p>
                    <a href="#" class="btn btn-primary rounded-pill px-5">
                        <i class="bi bi-arrow-left me-2"></i>Paketlere Göz At
                    </a>
                </div>
            `;
        }

        // Add to Cart from Recommended
        document.querySelectorAll('.btn-add-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="bi bi-check-lg me-2"></i>Eklendi';
                this.classList.add('btn-success');
                this.classList.remove('btn-add-cart');
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.classList.remove('btn-success');
                    this.classList.add('btn-add-cart');
                }, 2000);
            });
        });
    </script>


<!--

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
            
        </div>-->
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