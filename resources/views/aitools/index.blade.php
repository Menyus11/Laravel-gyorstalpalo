@extends('layout')

@section('content')
    <h1>AI eszközök <a href="{{ route('aitools.create') }}" title="Új AI eszköz">Felvétel</a> </h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <ul>
        @foreach ($aitools as $aitool)
            <li class="actions"> {{ $aitool->name }}

                <ul class="tags">
                    @foreach ($aitool->tags as $tag)
                        <li>{{ $tag->name }}</li>
                    @endforeach
                </ul>

                <a href="{{ route('aitools.show', $aitool->id) }}" class="button">Megjelenítés</a>
                <a href="{{ route('aitools.edit', $aitool->id) }}" class="button">Szerkesztés</a>
                <form action="{{ route('aitools.destroy', $aitool->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="danger"
                        onclick="return confirm('Bitosan törölni akarod a kategóriát?')">Törlés</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
