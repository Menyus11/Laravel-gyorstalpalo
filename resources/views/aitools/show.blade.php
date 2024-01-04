@extends('layout')

@section('content')

    <h1>{{ $aitool->name }} - {{ $aitool->hasFreePlan ? 'Ingyenes' : 'Fizetős' }}</h1>
    <h2>Kategória: {{ $aitool->category->name }}</h2>

    <p>{{ $aitool->description }}</p>
    <a href="{{ $aitool->link }}">{{ $aitool->link }}</a>
    <p>Ára: {{ $aitool->price ? $aitool->price ." Ft/hó" : 'Ingyenes'}} </p>

    <ul class="tags">
        @foreach ($aitool->tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
    </ul>

@endsection
