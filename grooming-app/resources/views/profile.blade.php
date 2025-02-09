@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hero sekcija -->
    <div class="profile-hero position-relative text-center">
        <div class="hero-background" style="background-image: url('/images/hero-background.jpg'); height: 300px; background-size: cover; background-position: center;"></div>
        <div class="avatar-wrapper position-absolute top-100 start-50 translate-middle">
            <!-- Prikaz profilne slike ili placeholder slike ako nije postavljena -->
            <img src="{{ $user->profile_image_url ? $user->profile_image_url : '/images/avatar-placeholder.jpg' }}" class="rounded-circle border border-light shadow" style="width: 150px; height: 150px; object-fit: cover;" alt="Salon Avatar">
        </div>
    </div>

    <!-- Forma za unos URL-a profilne slike -->
    <div class="container mt-5">
        <h3>Profilna slika</h3>
        <form action="{{ route('profile.updateImage') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="profile_image_url" class="form-label">Profilna slika (URL):</label>
                <input type="url" name="profile_image_url" class="form-control" placeholder="Unesite URL slike" value="{{ $user->profile_image_url ?? '' }}">
            </div>
            <button type="submit" class="btn btn-primary">Postavi profilnu sliku</button>
        </form>

        <div class="mt-4">
            <h5>Trenutna profilna slika</h5>
            <img src="{{ $user->profile_image_url ? $user->profile_image_url : '/images/avatar-placeholder.jpg' }}" class="rounded-circle border border-light shadow" style="width: 150px; height: 150px; object-fit: cover;" alt="Salon Avatar">
        </div>
    </div>

    <!-- Usluge -->
    <div class="mt-5">
        <h3>Usluge i cene</h3>
        @if($viewMode === 'overview')
            <div class="mt-5">
                <h3>Usluge i cene</h3>
                @if(isset($salon) && $salon->services)
                    <div class="card">
                        <div class="card-body">
                            <p>{!! nl2br(e($salon->services)) !!}</p>
                        </div>
                    </div>
                @else
                    <p class="text-muted">Trenutno nema unetih usluga.</p>
                @endif
            </div>
        @endif

        @if(auth()->check() && auth()->id() === $user->id)
            <a href="{{ route('profile.services.edit') }}" class="btn btn-primary mt-3">Uredi usluge</a>
        @endif
    </div>

    <!-- Profil informacije -->
    <div class="mt-5 text-center">
        <h1 class="fw-bold">{{ $salon->name }}</h1>
        <p class="text-muted">{{ $user->email }}</p>
        @if($viewMode === 'public')
            <p class="text-secondary">Ovo je javni profil salona.</p>
        @endif
    </div>

    <!-- Sekcije -->
    <div class="mt-4">
        @if($viewMode === 'overview')
            <div class="row g-4">
                <!-- Info kartice -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Informacije</h5>
                            <p class="mb-0"><strong>Ime:</strong> {{ $salon->name }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <a href="{{ route('profile.edit', ['id' => $user->id]) }}" class="btn btn-primary mt-3">Uredi profil</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Postavke</h5>
                            <a href="{{ route('profile.settings', ['id' => Auth::id()]) }}" class="btn btn-secondary">Podešavanja</a>
                            <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('Da li si siguran?')" class="mt-3">
                                @csrf
                                <button type="submit" class="btn btn-danger">Obriši nalog</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($viewMode === 'settings')
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Postavke</h5>
                    <p>Ovde možeš promeniti postavke naloga.</p>
                    <a href="{{ route('profile') }}" class="btn btn-secondary">Nazad na profil</a>
                </div>
            </div>
        @endif

        @if($viewMode === 'edit')
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Uredi profil</h5>
                    <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Ime:</label>
                            <input type="text" name="name" value="{{ $salon->name }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
                        <a href="{{ route('profile') }}" class="btn btn-secondary">Nazad</a>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection