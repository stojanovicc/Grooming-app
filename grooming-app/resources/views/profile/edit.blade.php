@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #333;">Uredi profil</h1>

    <!-- Prikazivanje grešaka ako postoje -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update', $salon->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <!-- Ime i prezime vlasnika -->
                <div class="mb-3">
                    <label for="owner_name" class="form-label"><i class="fas fa-user"></i> Ime:</label>
                    <input type="text" name="owner_name" id="owner_name" class="form-control" value="{{ old('owner_name', $user->owner_name) }}">
                </div>

                <!-- Telefon -->
                <div class="mb-3">
                    <label for="phone" class="form-label"><i class="fas fa-phone-alt"></i> Telefon:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $salon->phone) }}">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                </div>

                <!-- Grad -->
                <div class="mb-3">
                    <label for="city" class="form-label"><i class="fas fa-city"></i> Grad:</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $salon->city) }}">
                </div>

                <!-- Adresa -->
                <div class="mb-3">
                    <label for="address" class="form-label"><i class="fas fa-map-marker-alt"></i> Adresa:</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $salon->address) }}">
                </div>

                <!-- URL Profilne slike -->
                <div class="mb-3">
                    <label for="profile_image_url" class="form-label"><i class="fas fa-image"></i> URL Profilne slike:</label>
                    <input type="url" name="profile_image_url" id="profile_image_url" class="form-control" value="{{ old('profile_image_url', $salon->profile_image_url) }}">
                </div>

                <!-- Dugmadi za čuvanje ili otkazivanje -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success btn-lg">Sačuvaj izmene</button>
                    <a href="{{ route('profile.show', $salon->id) }}" class="btn btn-secondary btn-lg">Otkaži</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
    <!-- Font Awesome ikone -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* Koristimo Poppins font za lepši izgled */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 700px;
            margin-top: 40px;
        }

        /* Stilizovanje kartice (card) */
        .card {
            border-radius: 12px;
            border: none;
        }

        /* Kartica unutar tela */
        .card-body {
            padding: 30px;
        }

        /* Veće margine za formu */
        .form-label {
            font-size: 1.1rem;
            font-weight: 500;
            color: #555;
        }

        .form-control {
            border-radius: 8px;
            font-size: 1rem;
            padding: 12px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }

        /* Dugmadi */
        .btn {
            font-size: 1.1rem;
            padding: 10px 25px;
            font-weight: 500;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        /* Smaller form for mobile */
        @media (max-width: 768px) {
            .container {
                margin-top: 20px;
            }

            .form-control {
                font-size: 0.95rem;
                padding: 10px;
            }

            .btn {
                font-size: 1rem;
            }
        }
    </style>
@endpush