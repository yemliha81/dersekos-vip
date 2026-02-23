@extends('layouts.main')


@section('content')
 <?php $avg = $reviews->avg('rating'); // round value to 2 decimals
  $avg = number_format($avg, 2);?>
<!-- HERO / PROFILE HEADER -->
<div class="profile-cover py-5">
  <div class="container">
    <div class="row g-3 align-items-center">
      <div class="col-md-3 text-center text-md-start">
       @if($teacher->image == null)
            <img src="{{ asset('assets/img/default-image.png') }}" class="profile-img avatar" width="80" alt="">
        @else
        <img src="{{ env('APP_URL') . '/' . $teacher->image }}" class="profile-img avatar" width="80" alt="">
        @endif
      </div>

      <div class="col-md-6">
        <h1 class="h3 mb-1">{{$teacher->name}}</h1>
        <p class="mb-1 text-muted">{{ucwords(str_replace('_', ' ', $teacher->branch))}} Eğitmeni | Online ve Yüz yüze</p>

        <div class="d-flex flex-wrap gap-2 align-items-center mt-2">
          <div class="badge-subject">{{ucwords(str_replace('_', ' ', $teacher->branch))}}</div>

          <div class="ms-3 d-flex align-items-center">
            <i class="bi bi-star-fill review-star me-1"></i>
            <span class="fw-bold">{{$avg}}</span>
            <small class="text-muted ms-2">({{count($reviews)}} değerlendirme)</small>
          </div>
        </div>

        <div class="mt-3 d-flex gap-3">
          <!--<button class="btn book-btn text-white px-4" data-bs-toggle="modal" data-bs-target="#bookModal"><i class="bi bi-calendar-check me-2"></i>Ders Al</button>
          <a href="#contact" class="btn btn-outline-secondary"><i class="bi bi-chat-dots me-2"></i>Mesaj Gönder</a>-->
        </div>
      </div>

      <div class="col-md-3" style="text-align:right;">
          <a class="btn btn-primary add-to-cart-btn" href="javascript:;" style="display: inline-block" data-package-id="{{ $teacher->id }}" data-package-type="lesson">Özel Ders Talep et</a>
      </div>
    </div>
  </div>
</div>

<!-- MAIN -->
<main class="container my-5">
  <div class="row g-4">
    <!-- LEFT: ABOUT / QUALS / COURSES -->
    <div class="col-lg-8">
      <section id="about" class="mb-4">
        <div class="card card-rounded p-4 shadow-sm">
          <h3 class="h5">Hakkında</h3>
          <p class="text-muted">{{$teacher->about}}</p>

          
        </div>
      </section>

      <section id="qualifications" class="mb-4">
        <div class="card card-rounded p-4 shadow-sm">
          <h3 class="h5">Eğitim & Sertifikalar</h3>
          <div>
            {{$teacher->certificates}}
          </div>
        </div>
      </section>

      <section id="courses" class="mb-4">
        <div class="card card-rounded p-4 shadow-sm">
          <h3 class="h5">Etiketler</h3>

          <div class="row g-3">
            @foreach(explode(',', $teacher->tags) as $tag)
              <div class="col-6">
                <div class="badge-subject">{{$tag}}</div>
              </div>
            @endforeach
          </div>

        </div>
      </section>

     

    </div>

    <!-- RIGHT: CONTACT CARD / VIDEO / SOCIAL -->
    <aside class="col-lg-4">
      

      <div class="card card-rounded p-3 shadow-sm mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
          
            {!!$teacher->video_iframe!!}
          
          
        </div>
        <hr>
        <div class="d-flex gap-2 flex-wrap">
          <small class="text-muted"><i class="bi bi-clock"></i> 45dk - 90dk</small>
          <small class="text-muted"><i class="bi bi-globe"></i> Online</small>
        </div>
        <div class="text-end">
            <small class="text-muted">Deneyim</small>
            <div class="fw-bold">{{$teacher->experience}} yıl</div>
          </div>
      </div>

      <section id="reviews" class="mb-4">
        <div class="card card-rounded p-4 shadow-sm">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="h5 mb-0">Öğrenci Yorumları</h3>
            <div class="text-end">
             
              <div class="fw-bold">{{$avg}} <small class="text-muted">/ 5</small></div>
              <small class="text-muted">{{count($reviews)}} değerlendirme</small>
            </div>
          </div>

          <div class="mb-3">
            <!-- Review 1 -->
             @if(count($reviews) > 0)
                @foreach($reviews as $review)
                <div class="d-flex gap-3 mb-3">
                  <i class="bi bi-person"></i>
                  <div>
                    <div class="fw-bold">
                      <!-- get first letters of first name and then add *** after --> 
                      {{maskName($review->student->name) }}
                    </div>
                    <div class="small text-muted">{{$review->comment}}</div>
                    <div class="small mt-1"> 
                      @for($i = 1; $i <= $review->rating; $i++)
                      <i class="bi bi-star-fill review-star"></i>
                      @endfor
                    </div>
                  </div>
                </div>
                @endforeach
            @else 

            <div class="alert alert-info">
              <p>Henüz herhangi bir degerlendirme bulunmamaktadır.</p>
            </div>

            @endif
            

          </div>

          <a href="#" class="small">Tüm yorumları gör</a>

        </div>
      </section>

         <!-- REVIEWS -->
      
    </aside>
  </div>
</main>


@endsection

@section('scripts')

        <script>
            $(document).ready(function() {
                // Add to cart Ajax function
                $('.add-to-cart-btn').click(function(e) {
                    e.preventDefault();
                    var packageId = $(this).data('package-id');
                    var packageType = $(this).data('package-type');
                    $.ajax({
                        url: '{{ route("student.cart.add") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            teacher_id: packageId,
                            item_type: 'lesson'
                        },
                        success: function(response) {
                            alert('Paket sepete eklendi!');
                            //redirect to cart page
                            window.location.href = '{{ route("student.cart.index") }}';
                        },
                        error: function(xhr) {
                            alert('Sepete eklenirken bir hata oluştu.');
                        }
                    });
                });
            })
        </script>

@endsection
