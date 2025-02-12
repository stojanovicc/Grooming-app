@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Izmeni uslugu</h3>
    <form action="{{ route('services.update', ['id' => $salon->id, 'serviceId' => $service->id]) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Naziv usluge</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $service->name }}" required>
        </div>

        <div class="form-group">
            <label for="duration">Trajanje (u minutima)</label>
            <input type="test" id="duration" name="duration" class="form-control" value="{{ $service->duration }}" required>
        </div>

        <div class="form-group">
            <label for="price">Cena (RSD)</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ $service->price }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
        <a href="{{ route('profile.show', $salon->id) }}" class="btn btn-secondary">Otkaži</a>
    </form>
</div>
@endsection
