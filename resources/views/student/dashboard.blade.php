@extends('layouts.main')


@section('content')

    

    <main>
        <div class="container mt-4">
        <!-- col-3 in pc screen, col-12 in mobile screen -->
        <div class="row">
            <div class="col-12 col-md-3">
            <section class="hero-card mb-3" aria-labelledby="hero-title">
                <div class="hero-left">
                    <div class="mb-3">Hoş geldin, <br> <b id="hero-title">{{ auth('student')->user()->name }}!</b></div>
                    <p class="muted d-none d-sm-block">Burada derslerini yönetebilir, eğitmenlerinle iletişim kurabilir ve öğrenme yolculuğuna devam edebilirsin.</p>
                </div>
                
            </section>

            
      </div>
        
        
        </div>
        

        

        
    </div>
    </main>

@endsection


@section('scripts')

@endsection

