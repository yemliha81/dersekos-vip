<ul>
    @foreach ($quiz_list as $quiz)
        <li><a href="/quiz/{{ $quiz->id }}">{{ $quiz->title }}</a></li>
    @endforeach
</ul>