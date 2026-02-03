@extends('layouts.main')


@section('content')
<form action="{{ route('calendar.store') }}" method="POST">

    <h2>Google Takvim'e Ekle</h2>
                @csrf

                <!-- TAKVİM SEÇİMİ -->
                <label>Takvim Seç</label>
                <select name="calendar_id" required>
                    @foreach($calendars as $calendar)
                        <option value="{{ $calendar->id }}"
                            {{ $calendar->primary ? 'selected' : '' }}>
                            {{ $calendar->summary }}
                            {{ $calendar->primary ? '(Ana Takvim)' : '' }}
                        </option>
                    @endforeach
                </select>

                <br><br>

                <!-- BAŞLIK -->
                <input type="text" name="title" placeholder="Başlık" required>

                <br><br>

                <!-- AÇIKLAMA -->
                <textarea name="description" placeholder="Açıklama"></textarea>

                <br><br>

                <!-- TARİH SAAT -->
                <label>Başlangıç</label>
                <input type="datetime-local" name="start" required>

                <label>Bitiş</label>
                <input type="datetime-local" name="end" required>

                <br><br>

                <button type="submit">Google Takvim’e Ekle</button>
            </form>

@endsection