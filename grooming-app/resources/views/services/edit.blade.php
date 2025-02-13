@extends('layouts.app')

@section('content')
<div class="container-fluid content-wrapper mt-5">
    <div class="d-flex justify-content-center align-items-center">
        <div class="bg-white p-5 rounded shadow-lg" style="width: 100%; max-width: 500px; border: 1px solid #D3D3D3; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h3 class="text-center mb-4" style="color: #1F3B73;">Izmeni uslugu</h3>
            <form action="{{ route('services.update', ['id' => $salon->id, 'serviceId' => $service->id]) }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-text" style="color: #1F3B73; margin-right: 10px;"></i>
                        <label for="name" style="color: #1F3B73;">Naziv usluge</label>
                    </div>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $service->name }}" required>
                </div>

                <div class="form-group mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-clock" style="color: #1F3B73; margin-right: 10px;"></i>
                        <label for="duration" style="color: #1F3B73;">Trajanje (u minutima)</label>
                    </div>
                    <input type="text" id="duration" name="duration" class="form-control" value="{{ $service->duration }}" required>
                </div>

                <div class="form-group mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-currency-dollar" style="color: #1F3B73; margin-right: 10px;"></i>
                        <label for="price" style="color: #1F3B73;">Cena (RSD)</label>
                    </div>
                    <input type="number" id="price" name="price" class="form-control" value="{{ $service->price }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn" style="background-color: #1F3B73; color: white;">
                        <i class="bi bi-save"></i> Sačuvaj izmene
                    </button>
                    <a href="{{ route('profile.show', $salon->id) }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Otkaži
                    </a>
                </div>
            </form>
        </div>
    </div>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('/images/pozadina3.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
</style>
@endsection
