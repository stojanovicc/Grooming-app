@extends('layouts.app')

@section('content')
<div class="container-fluid content-wrapper">
    <div class="d-flex justify-content-center align-items-center">
        <div class="card p-4 shadow-lg rounded-3" style="background-color: rgba(255, 255, 255, 0.8); width: 100%; max-width: 500px;">
            <h3 class="text-center mb-4" style="font-family: 'Roboto', sans-serif; font-weight: 500; color: #1f3b73;">Dodaj novu uslugu u salonu</h3>
            <form action="{{ route('services.store', $salon->id) }}" method="POST">
                @csrf

                <div class="form-group mb-4">
                    <label for="name" class="form-label">
                        <i class="fas fa-cogs"></i> Naziv usluge
                    </label>
                    <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Unesite naziv usluge" required>
                </div>

                <div class="form-group mb-4">
                    <label for="duration" class="form-label">
                        <i class="fas fa-clock"></i> Trajanje
                    </label>
                    <input type="text" id="duration" name="duration" class="form-control form-control-lg" placeholder="Unesite trajanje usluge" required>
                </div>

                <div class="form-group mb-4">
                    <label for="price" class="form-label">
                        <i class="fas fa-money-bill-wave"></i> Cena (RSD)
                    </label>
                    <input type="number" id="price" name="price" class="form-control form-control-lg" placeholder="Cena u RSD" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-sm px-4 py-2" style="background-color: #1f3b73; border-radius: 5px; transition: background-color 0.3s ease, transform 0.3s;">
                        Sačuvaj
                    </button>
                    <a href="{{ route('profile.show', $salon->id) }}" class="btn btn-secondary btn-sm px-4 py-2" style="border-radius: 5px; transition: background-color 0.3s ease, transform 0.3s;">
                        Otkaži
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('/images/pozadina3.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .content-wrapper {
        min-height: 100px;
        padding-top: 80px;
        position: relative;
        z-index: 1;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.8);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        margin-top: 0;
        padding: 20px;
        z-index: 2;
    }

    .form-control {
        border-radius: 5px;
        transition: all 0.3s ease;
        padding: 1.2rem;
        font-size: 1rem;
    }

    .form-control:focus {
        border-color: #1f3b73;
        box-shadow: 0 0 8px rgba(31, 59, 115, 0.6);
    }

    .btn-primary, .btn-secondary {
        font-size: 1.5rem;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #1f3b73;
        color: white;
    }

    .btn-primary:hover, .btn-secondary:hover {
        transform: translateY(-2px);
    }

    .btn-primary:hover {
        background-color:rgb(10, 38, 75);
    }

    .btn-secondary:hover {
        background-color: #575757;
    }

    .shadow-lg {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: 500;
        color: #1f3b73;
        display: flex;
        align-items: center;
    }

    .form-label i {
        margin-right: 10px;
    }

    @media (max-width: 768px) {
        .form-control {
            font-size: 1rem;
        }

        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>