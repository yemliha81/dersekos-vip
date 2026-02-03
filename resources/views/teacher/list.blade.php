@extends('layouts.main')


@section('content')

 <!-- Ana İçerik -->
  <main class="">
    <!-- list teachers --> 
    <div class="teachers-list">
        <h2>Öğretmenler</h2>
        <div>
            @foreach($teachers as $teacher)
                <div class="teacher-card">
                    <div>
                        <h3>{{ $teacher->name }}</h3>
                        <p>Branş: {{ $teacher->branch }}</p>
                        <p>E-posta: {{ $teacher->email }}</p>
                    </div>
                    <div>
                        <a href="{{ route('teacher.profile', ['id' => $teacher->id]) }}" class="btn btn-primary">Profili İncele</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

  </main>

@endsection