@extends('layout')

@section('content')

<h1>Eszköz szerkesztése</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


@error('name')
    <div class="alert alert-warning">{{ $message }}</div>
@enderror

<form action="{{ route('aitools.update', $aitool->id) }}" method="post">
    @csrf
    @method('PUT')

    <fieldset>
        <label for="name">Eszköznév</label>
        <input type="text" name="name" id="name" value="{{ old('name', $aitool->name) }}">
    </fieldset>

    <fieldset>
        <label for="category_id">Kategória</label>
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{ old('category_id', $category->id) }}" {{ $category->id === $aitool->category_id ? 'selected' : '' }} >{{$category->name }} </option>
            @endforeach
        </select>
    </fieldset>

    <fieldset>
        <label for="description">Leírás</label>
        <textarea name="description" id="description">{{ old('description', $aitool->description) }}</textarea>
    </fieldset>

    <fieldset>
        <label for="link">Link</label>
        <input type="text" name="link" id="link" value="{{ old('link', $aitool->link) }}">
    </fieldset>

    <fieldset>
        <label for="hasFreePlan">Van ingyenes változat?</label>
        <input type="checkbox" name="hasFreePlan" id="hasFreePlan" {{ $aitool->hasFreePlan  ? 'checked' : '' }} >
    </fieldset>

    <fieldset>
        <label for="price">Ár (havonta ft-ban)</label>
        <input type="number" name="price" id="price" value="{{ old('price', $aitool->price) }}">
    </fieldset>

    <fieldset>
        <label for="tags">Címkék</label>
        <select name="tags[]" id="tags" multiple>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </fieldset>

    <button type="submit">Mentés</button>
</form>


@endsection
