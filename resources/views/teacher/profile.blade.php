@extends('layouts.main')


@section('content')

 <!-- Ana İçerik -->
  <main class="">
    <!-- list teachers --> 
    <div class="teachers-list">
        <h2>Öğretmen Profil Sayfası</h2>
        <div>
            <h3>{{ $teacher->name }}</h3>
            <p>Branş: {{ $teacher->branch }}</p>
            
        </div>
        <div class="calendar">
            <h3>Takvim</h3>
            <!-- Burada öğretmenin takvimini gösterebilirsiniz -->
             <div id="calendar"></div>
        </div>
    </div>

    <!-- Event Ekleme Modal -->
        <div class="modal fade" id="eventModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Yeni Etkinlik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="eventDate">

                    <div class="mb-3">
                    <label>Başlık</label>
                    <input type="text" id="title" class="form-control">
                    </div>

                    <div class="mb-3">
                    <label>Başlangıç Saati</label>
                    <input type="time" id="start_time" class="form-control">
                    </div>

                    <div class="mb-3">
                    <label>Bitiş Saati</label>
                    <input type="time" id="end_time" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Ücretsiz mi?</label>
                        <select id="is_free" class="form-select">
                            <option value="1">Ücretsiz</option>
                            <option value="0">Ücretli</option>
                        </select>
                        </div>

                        <div class="mb-3" id="priceArea" style="display:none;">
                        <label>Ücret (₺)</label>
                        <input type="number" id="price" class="form-control" min="0" step="0.01">
                        </div>

                        <div class="mb-3">
                        <label>Minimum Katılımcı</label>
                        <input type="number" id="min_person" class="form-control" min="1">
                        </div>

                        <div class="mb-3">
                        <label>Maksimum Katılımcı</label>
                        <input type="number" id="max_person" class="form-control" min="1">
                        </div>


                    <div class="mb-3">
                    <label>Toplantı Linki</label>
                    <input type="url" id="meet_url" class="form-control" placeholder="https://meet.google.com/...">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" id="saveEvent" class="btn btn-primary">Kaydet</button>
                </div>

                </div>
            </div>
        </div>

        <!-- Event Detay Modal -->
        <div class="modal fade" id="eventDetailModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Etkinlik Detayı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p><strong>Başlık:</strong> <span id="detailTitle"></span></p>
                    <p><strong>Başlangıç:</strong> <span id="detailStart"></span></p>
                    <p><strong>Bitiş:</strong> <span id="detailEnd"></span></p>
                    <p><strong>Ücret:</strong> <span id="detailPrice"></span></p>
                    <p><strong>Katılımcı:</strong> <span id="detailPerson"></span></p>

                    <div id="meetArea" class="d-none">
                    <hr>
                    <a href="#" target="_blank" id="meetLink" class="btn btn-success w-100" style="display:none;">
                        Derse Başla
                    </a>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                </div>

                </div>
            </div>
        </div>

  </main>

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