@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <h3>{{ $salon->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Adresa:</strong> {{ $salon->address }}</p>
            <p><strong>Grad:</strong> {{ $salon->city }}</p>
            <p><strong>Telefon:</strong> {{ $salon->phone }}</p>
            <p><strong>Email:</strong> {{ $salon->email }}</p>
            <p><strong>Usluge:</strong> {!! nl2br(e($salon->services)) !!}</p>
            <p><strong>Opis:</strong> {{ $salon->description }}</p>

            @if(auth()->check() && auth()->id() === $salon->user_id)
                <a href="{{ route('profile.edit', $salon->id) }}" class="btn btn-primary">Uredi salon</a>
            @endif
        </div>
    </div>

    @if($salon->images->count())
        <div class="row">
            @foreach($salon->images as $image)
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded">
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">Nema slika u galeriji.</p>
    @endif
</div>
@endsection
