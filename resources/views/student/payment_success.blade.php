@extends('layouts.main')


@section('content')

 <!-- Ana İçerik -->
  <main class="auth-wrap">
    


    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h2 class="text-center">Ödeme Başarılı!</h2>
            </div>

            <div class="card-body"> 
              <div class="alert alert-success">
                Tebrikler! Ödemeniz başarıyla tamamlanmıştır.
              </div>
              <div>
                <div><b>Satın aldığınız hizmete ait bilgiler aşağıdadır.</b></div>
                <div>
                  <?php $orderData = json_decode($parentOrder->cart_data); 
                    
                  ?>
                  <table class="table">
                    <thead>
                      <tr>
                        <td><b>Hizmet Türü</b></td>
                        <td><b>Hizmet Adı</b></td>
                        <td><b>Tutar</b></td>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($orderData as $item)

                    <tr>
                        <td>{{ $item->type == 'package' ? 'Okula Destek Paketi' : 'Bire bir Ders' }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }} ₺</td>
                    </tr>

                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



  </main>

@endsection