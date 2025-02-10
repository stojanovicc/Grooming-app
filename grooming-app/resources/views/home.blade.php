@extends('layouts.app')

@section('title', 'Dobrodošli')

@section('content')
<div class="container">
    <!-- Hero sekcija -->
    <div class="bg-light rounded-4 shadow-sm p-5 text-center mb-5">
        <h1 class="display-4 fw-bold">Dobrodošli u Dog Grooming!</h1>
        <p class="lead">Zakazivanje termina za šišanje i negu vašeg ljubimca nikada nije bilo lakše.</p>
        @guest
            <a href="/register" class="btn btn-primary btn-lg mt-3">Registruj svoj salon</a>
        @else
            <a href="/profile" class="btn btn-primary btn-lg mt-3">Moj profil</a>
        @endguest
    </div>

    <!-- Sekcija sa prednostima -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-calendar-check display-4 text-primary mb-3"></i>
                    <h5 class="card-title">Brzo zakazivanje</h5>
                    <p class="card-text">Jednostavno zakazivanje termina za vašeg ljubimca putem naše platforme.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-house-door display-4 text-success mb-3"></i>
                    <h5 class="card-title">Pregled salona</h5>
                    <p class="card-text">Pronađite najbolje salone za negu u vašoj blizini.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-star display-4 text-warning mb-3"></i>
                    <h5 class="card-title">Recenzije</h5>
                    <p class="card-text">Pogledajte recenzije drugih korisnika pre nego što se odlučite.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
