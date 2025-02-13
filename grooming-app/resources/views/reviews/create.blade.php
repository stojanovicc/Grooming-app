@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-container">
        <h2 class="text-center">Dodaj recenziju za salon: <span class="text1">{{ $salon->name }}</span></h2>

        <form method="POST" action="{{ route('reviews.store', $salon->id) }}">
            @csrf
            <div class="form-group">
                <label for="name">
                    <i class="fas fa-user" style="color: #218838"></i> Ime
                </label>
                <input type="text" name="name" class="form-control" required placeholder="Vaše ime">
            </div>

            <div class="form-group">
                <label for="rating">
                    <i class="fas fa-star" style="color: #218838"></i> Ocena
                </label>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required />
                    <label for="star5" title="5 zvezdica">★</label>
                    <input type="radio" id="star4" name="rating" value="4" />
                    <label for="star4" title="4 zvezdice">★</label>
                    <input type="radio" id="star3" name="rating" value="3" />
                    <label for="star3" title="3 zvezdice">★</label>
                    <input type="radio" id="star2" name="rating" value="2" />
                    <label for="star2" title="2 zvezdice">★</label>
                    <input type="radio" id="star1" name="rating" value="1" />
                    <label for="star1" title="1 zvezdica">★</label>
                </div>
            </div>

            <div class="form-group">
                <label for="comment">
                    <i class="fas fa-comment" style="color: #218838"></i> Komentar
                </label>
                <textarea name="comment" class="form-control" rows="4" required placeholder="Vaš komentar..."></textarea>
            </div>

            <div class="button-container d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Postavi
                </button>
                <a href="{{ route('reviews.index', $salon->id) }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Otkaži
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    body {
        background-image: url('/images/pozadina3.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }
    .form-container {
        max-width: 500px;
        margin: 50px auto;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .star-rating {
        direction: rtl;
        display: flex;
        justify-content: center;
    }
    .star-rating input[type="radio"] {
        display: none;
    }
    .star-rating label {
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    .star-rating input[type="radio"]:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #f39c12;
    }
    .btn-primary {
        background-color: #28a745;
        border: none;
        font-weight: bold;
        border-radius: 30px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #218838;
    }
    .btn-secondary {
        background-color: #6c757d;
        border: none;
        font-weight: bold;
        border-radius: 30px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
    }
    .text1 {
        color: #1f3b73;
    }
    .button-container {
        margin-top: 20px;
    }
</style>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
