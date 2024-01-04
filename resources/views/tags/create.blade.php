@extends('layout')

@section('content')

<h1>Új címke</h1>

@error('name')
    <div class="alert alert-warning">{{ $message }}</div>
@enderror

<form action="{{ route('tags.store') }}" method="post">
    @csrf

    <fieldset>
        <label for="name">Címke név</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
    </fieldset>

    <button type="submit">Mentés</button>
</form>

@endsection