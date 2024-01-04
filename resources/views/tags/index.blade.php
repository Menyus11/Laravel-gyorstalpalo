@extends('layout')

@section('content')

<h1>Címkék</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif

<ul>

    @foreach ($tags as $tag)
        <li class="actions">
            {{ $tag->name }}
            <a href="{{ route('tags.show', $tag->id) }}">Megjelenítés</a>
            <a href="{{ route('tags.edit', $tag->id) }}">Szerkesztés</a>
            <form action="{{ route('tags.destroy', $tag->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="danger" onclick="return confirm('Biztos, hogy töröljük?')">Törlés</button>
            </form>
        </li>
    @endforeach

</ul>

@endsection