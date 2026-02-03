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
        <img src="{{ asset($teacher->image) }}" class="profile-img avatar" width="80" alt="">
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

      <div class="col-md-3">
        
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

      <!-- SCHEDULE -->
      <section id="schedule" class="mb-4">
        <div class="card card-rounded p-4 shadow-sm">
          <div class="d-flex justify-content-between align-items-center">
            <h3 class="h5 mb-0">Takvim & Uygunluk</h3>
            <small class="text-muted"></small>
          </div>

          <div class="mt-3 table-responsive">
            <div id="calendar"></div>
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

<!-- BOOKING MODAL -->
<div class="modal fade" id="bookModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ders Rezervasyonu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Tarih</label>
            <input type="date" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Saat</label>
            <input type="time" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Not (özellikler, hedefler...)</label>
            <textarea class="form-control" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        <button class="btn book-btn text-white">Rezervasyonu Gönder</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');
    var selectedDate = null;

   var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'tr',
            selectable: true,
            events: '/teacher-events/{{ $teacher->id }}',

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },

            buttonText: {
                today: 'Bugün',
                month: 'Ay',
                week: 'Hafta',
                day: 'Gün'
            },

            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },

            /*dateClick: function(info) {
                selectedDate = info.dateStr;

                document.getElementById('title').value = '';
                document.getElementById('start_time').value = '';
                document.getElementById('end_time').value = '';
                document.getElementById('meet_url').value = '';

                var modal = new bootstrap.Modal(document.getElementById('eventModal'));
                modal.show();
            },*/

            eventClick: function(info) {
                let event = info.event;

                let priceText = event.extendedProps.is_free == 1 
                    ? 'Ücretsiz' 
                    : /*event.extendedProps.price*/ '250 ₺';

                document.getElementById('detailPrice').innerText = priceText;

                document.getElementById('detailPerson').innerText =
                    event.extendedProps.min_person + " - " + event.extendedProps.max_person + " kişi";


                document.getElementById('detailTitle').innerText = event.title;
                document.getElementById('detailStart').innerText = event.start.toLocaleString('tr-TR');
                document.getElementById('detailEnd').innerText   = event.end ? event.end.toLocaleString('tr-TR') : '-';

                if (event.extendedProps.meet_url) {
                    document.getElementById('meetArea').classList.remove('d-none');
                    document.getElementById('meetLink').href = event.extendedProps.meet_url;
                } else {
                    document.getElementById('meetArea').classList.add('d-none');
                }

                var detailModal = new bootstrap.Modal(document.getElementById('eventDetailModal'));
                detailModal.show();
            }
        });


    calendar.render();

    document.getElementById('saveEvent').addEventListener('click', function () {

        let title = document.getElementById('title').value;
        let startTime = document.getElementById('start_time').value;
        let endTime = document.getElementById('end_time').value;
        let meetUrl = document.getElementById('meet_url').value;
        let isFree     = document.getElementById('is_free').value;
        let price     = document.getElementById('price').value;
        let minPerson = document.getElementById('min_person').value;
        let maxPerson = document.getElementById('max_person').value;

        if (!title || !startTime || !endTime) {
            alert("Lütfen tüm zorunlu alanları doldurun.");
            return;
        }

        let startDateTime = selectedDate + "T" + startTime;
        let endDateTime   = selectedDate + "T" + endTime;
        const teacherId = "{{ $teacher->id }}";

        fetch('/teacher-events/'+teacherId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                title: title,
                start: startDateTime,
                end: endDateTime,
                meet_url: meetUrl,
                is_free: isFree,
                price: price,
                min_person: minPerson,
                max_person: maxPerson
            })
        })
        .then(res => res.json())
        .then(data => {
            calendar.addEvent({
            id: data.id,
            title: data.title,
            start: data.start,
            end: data.end,
            extendedProps: {
                meet_url: data.meet_url,
                is_free: data.is_free,
                price: data.price,
                min_person: data.min_person,
                max_person: data.max_person
            }
        });


            bootstrap.Modal.getInstance(document.getElementById('eventModal')).hide();
        });
    });

    document.getElementById('is_free').addEventListener('change', function () {
        if (this.value == "0") {
            document.getElementById('priceArea').style.display = 'block';
        } else {
            document.getElementById('priceArea').style.display = 'none';
            document.getElementById('price').value = '';
        }
    });



});
</script>

@endsection
