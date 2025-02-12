@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Dodaj novu uslugu</h3>
    <form action="{{ route('services.store', $salon->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Naziv usluge</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="duration">Trajanje</label>
            <input type="text" id="duration" name="duration" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Cena (RSD)</label>
            <input type="number" id="price" name="price" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Sačuvaj</button>
        <a href="{{ route('profile.show', $salon->id) }}" class="btn btn-secondary">Otkaži</a>
    </form>
</div>
@endsection
