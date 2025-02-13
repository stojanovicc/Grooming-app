@extends('layouts.app')

@section('title', 'Dobrodošli')

@section('content')
<div class="container text-white rounded-4 shadow-lg p-5 text-center mb-3 position-relative overflow-hidden" style="margin-top: 50px; max-width: 1000px; background-color: #d4ac0d;">
    <!-- Pozadinska slika -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('{{ asset('images/home4.jpg') }}') no-repeat center center/cover; z-index: 0;"></div>

    <!-- Tekstualni sadržaj hero sekcije -->
    <div class="position-relative z-1">
        <h1 class="display-4 fw-bold animate__animated animate__fadeIn animate__delay-1s" style="color: #1f3b73;">Dobrodošli u Dog Grooming!</h1>
        <p class="lead animate__animated animate__fadeIn animate__delay-2s" style="color: black;">Zakazivanje termina za šišanje i negu vašeg ljubimca nikada nije bilo lakše.</p>
        @guest
            <a href="/register" class="btn btn-light btn-lg mt-3 animate__animated animate__fadeIn animate__delay-3s">Registruj svoj salon</a>
        @else
            <a href="/profile" class="btn btn-light btn-lg mt-3 animate__animated animate__fadeIn animate__delay-3s">Moj profil</a>
        @endguest
    </div>
</div>

    <!-- Sekcija sa prednostima -->
    <div class="container pb-2"> 
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-3 hover-shadow position-relative overflow-hidden" style="background-color: white;">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center" style="height: 100%; padding: 20px;">
                        <i class="bi bi-house-door display-4 text-primary mb-3 animate__animated animate__zoomIn animate__delay-1s"></i>
                        <h5 class="card-title text-black">Pregled salona</h5>
                        <p class="card-text text-black">Pronađite najbolje salone za negu u vašoj blizini!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-3 hover-shadow position-relative overflow-hidden" style="background-color: white;">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center" style="height: 100%; padding: 20px;">
                        <i class="bi bi-tags display-4 text-success mb-3 animate__animated animate__zoomIn animate__delay-2s"></i>
                        <h5 class="card-title text-black">Usluge salona</h5>
                        <p class="card-text text-black">Pratite usluge i cene u vašem salonu u bilo kom trenutku!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-3 hover-shadow position-relative overflow-hidden" style="background-color: white;">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center" style="height: 100%; padding: 20px;">
                        <i class="bi bi-star display-4 text-warning mb-3 animate__animated animate__zoomIn animate__delay-3s"></i>
                        <h5 class="card-title text-black">Recenzije</h5>
                        <p class="card-text text-black">Pogledajte recenzije drugih korisnika pre nego što se odlučite!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">
<style>
    body {
        background-image: url('/images/pozadina6.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }
    .btn-light {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        color: #1f3b73;
    }
    .btn-light:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }
    .hover-shadow:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        transform: scale(1.05);
        transition: box-shadow 0.3s ease-in-out, transform 0.3s ease;
    }
</style>
@endsection
