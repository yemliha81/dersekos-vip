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
                            <a href="{{ route('cart.add', $package->id) }}" class="btn btn-primary add-to-cart-btn" data-package-id="{{ $package->id }}">Sepete Ekle</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection

@section('scripts')

        <script>
            $(document).ready(function() {
                // Add to cart Ajax function
                $('.add-to-cart-btn').click(function(e) {
                    e.preventDefault();
                    var packageId = $(this).data('package-id');
                    $.ajax({
                        url: '{{ route("cart.add") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            package_id: packageId
                        },
                        success: function(response) {
                            alert('Paket sepete eklendi!');
                            //redirect to cart page
                            window.location.href = '{{ route("cart.index") }}';
                        },
                        error: function(xhr) {
                            alert('Sepete eklenirken bir hata oluştu.');
                        }
                    });
                });
            })
        </script>

@endsection


