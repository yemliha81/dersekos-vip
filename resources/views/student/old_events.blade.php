@extends('layouts.main')


@section('content')

    

    <main>
        <!-- col-3 in pc screen, col-12 in mobile screen -->
        <div class="row">
            <div class="col-12 col-md-3">
            <section class="hero-card mb-50" aria-labelledby="hero-title">
                <div class="hero-left">
                    <div class="mb-3"><b id="hero-title">{{ auth('student')->user()->name }}!</b></div>
                    <p class="muted">Bu sayfada geçmiş derslerinizi görebilir, yorum ve puan ekleyebilirsiniz.</p>
                </div>
                
            </section>

            <section class="hero-card mb-50" aria-labelledby="hero-title">
                <div class="left-student-menu">
                    <a href="{{route('student.dashboard')}}"> <i class="bi bi-person "></i> Öğrenci Sayfam</a>
                </div>
                <div class="left-student-menu">
                    <a href="{{route('student.old_lessons')}}"> <i class="bi bi-file-earmark-text"></i> Geçmiş Derslerim</a>
                </div>
            </section>
      </div>
        
        <div class="col-12 col-md-9">
            <section class="dashboard-cards">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="mb-50">
                    <div class="lesson-title-div"><b>Katıldığım dersler</b></div>
                    @if(count($joined_events) > 0)
                        @foreach($joined_events as $event)
                            <div class="free-lesson-card">
                                <div class="dashboard-card-left">
                                    <div class="dashboard-card-subtitle"><b>{{ $event->teacher->name }}</b> - {{ $event->teacher->branch }}</div>
                                    <div class="dashboard-card-title">{{ $event->title }}</div>
                                </div>
                                <div class="flex-space-between">
                                    <div class="dashboard-card-date">{{ date('d.m.Y', strtotime($event->start)) }} / {{ date('H:i', strtotime($event->start)) }} - {{ date('H:i', strtotime($event->end)) }} </div>
                                    <a class="btnx rate-event" href="#" event-id="{{ $event->id }}" data-bs-toggle="modal" data-bs-target="#rateModal">Yorum yap & Puan ver</a>
                                </div>
                            </div>
                        @endforeach
                    @else 

                    @endif
                </div>
                
            </section>
        </div>
        </div>

        <!-- Rate and leave comment modal --> 
         <div class="modal fade" id="rateModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{route('student.event_rate')}}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Katıldığınız bu ders için puan ve yorum bırakın.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            
                                @csrf
                                <input type="hidden" name="event_id" id="event_id">
                                <div class="mb-3">
                                    <label for="rate" class="form-label">Puan</label>
                                    <!-- Rating stars here -->
                                    <div class="star-rating">
                                        <label for="star1">
                                            <span>1</span>
                                            <input type="radio" id="star1" name="rate" value="1" required/>
                                        </label>
                                        <label for="star2">
                                            <span>2</span>
                                            <input type="radio" id="star2" name="rate" value="2"  required/>
                                        </label>
                                        <label for="star3">
                                            <span>3</span>
                                            <input type="radio" id="star3" name="rate" value="3"  required/>
                                        </label>
                                        <label for="star4">
                                            <span>4</span>
                                            <input type="radio" id="star4" name="rate" value="4"  required/>
                                        </label>
                                        <label for="star5">
                                            <span>5</span>
                                            <input type="radio" id="star5" name="rate" value="5"  required/>
                                        </label>
                                        
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Yorum</label>
                                    <textarea class="form-control" name="comment" id="comment" rows="3"  required></textarea>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                            <input type="submit" class="btn btn-primary" value="Kaydet">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
         

        
         
     

    </main>

@endsection


@section('scripts')
<script>
    // Öğrenci paneli için özel JavaScript kodları buraya eklenebilir
    $(document).ready(function() {

        $('.rate-event').click(function() {
            var eventId = $(this).attr('event-id');
            $('#event_id').val(eventId);
        })
        

    });
</script>

@endsection

