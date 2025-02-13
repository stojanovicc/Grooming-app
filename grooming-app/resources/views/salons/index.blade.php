@extends('layouts.app')

@section('content')
<div class="container mt-5" style="min-height: 500px;">
    <h1 class="mb-4 text-center" style="color: #1f3b73">Saloni</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="GET" action="{{ route('salons.index') }}" class="mb-4">
        <div class="row g-3 justify-content-center">
            <div class="col-md-3 icon-input">
                <span class="input-icon"><i class="fas fa-search"></i></span>
                <input type="text" name="name" value="{{ request('name') }}" class="form-control shadow-sm" placeholder="Search by Name">
            </div>

            <div class="col-md-3 icon-input">
                <span class="input-icon"><i class="fas fa-city"></i></span>
                <input type="text" name="city" value="{{ request('city') }}" class="form-control shadow-sm" placeholder="Search by City">
            </div>

            <div class="col-md-3 icon-input">
                <span class="input-icon"><i class="fas fa-map-marked-alt"></i></span>
                <input type="text" name="area" value="{{ request('area') }}" class="form-control shadow-sm" placeholder="Search by Area">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 shadow-sm">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
    </form>

    @if($message)
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @else
    <div class="row">
        @foreach($salons as $salon)
            <div class="col-md-4 mb-4">
                <div class="card card-hover shadow-lg">
                    @if($salon->profile_image_url)
                        <img src="{{ $salon->profile_image_url }}" class="card-img-top" alt="{{ $salon->name }}">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" class="card-img-top" alt="{{ $salon->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-paw"></i> {{ $salon->name }}</h5>
                        <p class="card-text">
                            <strong><i class="fas fa-map-marker-alt"></i> Address:</strong> {{ $salon->address }}<br>
                            <strong><i class="fas fa-city"></i> City:</strong> {{ $salon->city }}<br>
                            <strong><i class="fas fa-map"></i> Area:</strong> {{ $salon->area }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('profile.show', ['id' => $salon->id]) }}" class="btn btn-primary">
                                <i class="fas fa-user"></i> Profile
                            </a>
                            <a href="{{ route('reviews.index', $salon->id) }}" class="btn btn-secondary">
                                <i class="fas fa-comments"></i> Reviews
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    .card-hover:hover {
        transform: scale(1.05) rotate(1deg);
        box-shadow: 0 20px 30px #1f3b73 !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .form-control::placeholder {
        font-style: italic;
        color: #6c757d;
    }
    .card-img-top {
        object-fit: cover;
        height: 200px;
        border-radius: 0.5rem 0.5rem 0 0;
    }
    .btn-primary {
        background: linear-gradient(90deg, #ff7e5f, #feb47b);
        border: none;
        border-radius: 25px;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #feb47b, #ff7e5f);
    }
    .btn-secondary {
        background: linear-gradient(90deg, #1f3b73, rgb(80, 118, 192));
        border: none;
        border-radius: 25px;
        color: #fff;
        transition: all 0.3s ease;
    }
    .btn-secondary:hover {
        background: linear-gradient(90deg, rgb(80, 118, 192), #1f3b73);
    }
    .icon-input {
        position: relative;
    }
    .icon-input input {
        padding-left: 2.5rem;
    }
    .icon-input .input-icon {
        position: absolute;
        top: 50%;
        left: 0.75rem;
        transform: translateY(-50%);
        color: #6c757d;
    }
</style>
@endsection