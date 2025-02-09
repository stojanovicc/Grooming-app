@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Svi Saloni</h1>
    <div class="row">
        @foreach($salons as $salon)
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded-3">
                <img src="{{ asset('storage/' . $salon->profile_image) }}" class="card-img-top" alt="{{ $salon->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $salon->name }}</h5>
                    <p class="card-text">{{ $salon->address }}</p>
                    <p class="card-text"><i class="bi bi-geo-alt"></i> {{ $salon->location }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('salons.show', $salon->id) }}" class="btn btn-primary">Profil</a>
                        <button class="btn btn-outline-secondary" disabled>Recenzija</button> <!-- Recenzija dugme ostaviti kasnije -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
<style>
.card {
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}
</style>
@endsection
