@extends('layouts.app')

@section('title', 'Registracija Vlasnika Salona')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center text-white position-relative">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="bi bi-person-circle fs-4 me-2"></i>
                        <h5 class="mb-0">Registracija Vlasnika Salona</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3 position-relative">
                            <span class="icon-container"><i class="bi bi-person"></i></span>
                            <label for="owner_name" class="form-label">Ime i Prezime Vlasnika</label>
                            <input type="text" class="form-control @error('owner_name') is-invalid @enderror" 
                                   id="owner_name" name="owner_name" value="{{ old('owner_name') }}" required>
                            @error('owner_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 position-relative">
                            <span class="icon-container"><i class="bi bi-envelope"></i></span>
                            <label for="email" class="form-label">Email adresa</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 position-relative">
                            <span class="icon-container"><i class="bi bi-lock"></i></span>
                            <label for="password" class="form-label">Lozinka</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 position-relative">
                            <span class="icon-container"><i class="bi bi-lock-fill"></i></span>
                            <label for="password_confirmation" class="form-label">Potvrda lozinke</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        
                        <div class="mb-3 position-relative">
                            <span class="icon-container"><i class="bi bi-shop"></i></span>
                            <label for="name" class="form-label">Naziv salona</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="text-center d-flex justify-content-center align-items-center" style="height: 30px;">
                            <button type="submit" class="btn btn-secondary w-50" style="padding: 5px 20px;">Registruj se</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: url('{{ asset('images/pozadina.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        font-family: 'Arial', sans-serif;
    }
    .card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        color: #333;
    }
    .card-header {
        background-color: #1f3b73;
        color: #fff;
        border-radius: 15px 15px 0 0;
    }
    .form-control {
        border-radius: 10px;
    }
    .btn-secondary {
        background-color: #d4ac0d;
        border: none;
        border-radius: 10px;
        transition: background-color 0.3s ease;
    }
    .btn-secondary:hover {
        background-color: #d4ac0d;
        transform: scale(1.1);
    }
    .form-label i {
        color: #1f3b73;
    }
    .icon-container {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #1f3b73;
    }
    .form-control {
        padding-left: 40px;
    }
</style>
@endsection