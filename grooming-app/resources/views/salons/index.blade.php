@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Salons</h1>

    <!-- Prikaz greške -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Forma za pretragu -->
    <form method="GET" action="{{ route('salons.index') }}" class="mb-4">
        <div class="row g-2">
            <!-- Pretraga po nazivu -->
            <div class="col-md-4">
                <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Search by Name">
            </div>

            <!-- Pretraga po gradu -->
            <div class="col-md-3">
                <input type="text" name="city" value="{{ request('city') }}" class="form-control" placeholder="Search by City">
            </div>

            <!-- Pretraga po području -->
            <div class="col-md-3">
                <input type="text" name="area" value="{{ request('area') }}" class="form-control" placeholder="Search by Area">
            </div>

            <!-- Dugme za pretragu -->
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    <!-- Provera rezultata -->
    @if($message)
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @else
    <div class="row">
        @foreach($salons as $salon)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($salon->profile_image_url)
                        <img src="{{ $salon->profile_image_url }}" class="card-img-top" alt="{{ $salon->name }}">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" class="card-img-top" alt="{{ $salon->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $salon->name }}</h5>
                        <p class="card-text">
                            <strong>Address:</strong> {{ $salon->address }}<br>
                            <strong>City:</strong> {{ $salon->city }}<br>
                            <strong>Area:</strong> {{ $salon->area }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('profile.show', ['id' => $salon->id]) }}" class="btn btn-primary">Profile</a>
                            <a href="{{ route('reviews.index', $salon->id) }}" class="btn btn-secondary">Recenzije</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>
@endsection