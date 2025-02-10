@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Prikaz naziva salona -->
    <h1>{{ $salon->name }}</h1>

    <!-- Profilna slika -->
    @if($salon->profile_image_url)
        <img src="{{ $salon->profile_image_url }}" alt="Profile Image" class="img-thumbnail" style="max-width: 200px;">
    @else
        <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Image" class="img-thumbnail" style="max-width: 200px;">
    @endif

    <!-- Ime i prezime vlasnika -->
    <p><strong>Vlasnik:</strong> {{ $user->owner_name }}</p>

    <!-- Javni podaci salona -->
    <p><strong>Email:</strong> {{ $user->email ?? 'Nije dostupno' }}</p>
    <p><strong>Contact:</strong> {{ $salon->phone ?? 'Nije dostupno' }}</p>
    <p><strong>City:</strong> {{ $salon->city ?? 'Nije dostupno' }}</p>
    <p><strong>Adress:</strong> {{ $salon->address ?? 'Nije dostupno' }}</p>

    <!-- Provera da li je vlasnik salona -->
    @auth
        @if (auth()->id() === $salon->user_id)
            <a href="{{ route('profile.edit', $salon->id) }}" class="btn btn-primary mt-3">Uredi profil</a>
        @endif
    @endauth
</div>
@endsection