@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-3 text-center fw-bold display-7">Recenzije za salon: <span class="text1">{{ $salon->name }}</span></h1>

    <div class="text-center mb-4">
        <p class="lead text-muted">Vaše mišljenje nam je važno! <br> Podelite svoje iskustvo klikom na dugme ispod i pomozite drugima da pronađu najbolje usluge.</p>
        <a href="{{ route('reviews.create', $salon->id) }}" class="btn btn-success btn-lg px-5 py-3 rounded-pill shadow-lg animate-hover">Dodaj recenziju</a>
    </div>

    @if($salon->reviews->count())
        <div class="row gy-4">
            @foreach($salon->reviews as $index => $review)
                <div class="col-md-6">
                    <div class="card border shadow-lg border-success rounded-4 review-card" style="transform: translateY(50px); opacity: 0; transition: transform 0.5s ease, opacity 0.5s ease, box-shadow 0.3s ease, border-color 0.3s ease; max-height: auto; overflow: hidden;" onmouseover="this.style.boxShadow='0 20px 30px rgba(40, 167, 69, 0.5)'; this.style.borderColor='rgba(40, 167, 69, 0.8)';" onmouseout="this.style.boxShadow='0 10px 15px rgba(40, 167, 69, 0.3)'; this.style.borderColor='rgba(40, 167, 69, 0.5)';">
                        <div class="card-body p-3">
                            <h5 class="card-title mb-2 text-dark">{{ $review->name }}</h5>
                            
                            <div class="d-flex align-items-center mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fas fa-star text-warning fs-5"></i>
                                    @else
                                        <i class="far fa-star text-warning fs-5"></i>
                                    @endif
                                @endfor
                            </div>

                            <p class="card-text mb-3 text-muted"><strong>Komentar:</strong> {{ $review->comment }}</p>
                            <p class="text-end text-muted small">Dodato: {{ $review->created_at->format('d.m.Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center fw-bold py-4" role="alert">
            Još nema recenzija za ovaj salon.
        </div>
    @endif
</div>

<style>
    body {
        background-image: url('/images/pozadina3.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }

    .animate-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .animate-hover:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 30px rgba(40, 167, 69, 0.5);
    }
    .card {
        min-height: 150px;
        max-height: 300px;
        overflow: hidden;
        border: 1px solid rgba(40, 167, 69, 0.5);
    }
    .card:hover {
        box-shadow: 0 20px 30px rgba(40, 167, 69, 0.5) !important;
        border-color: rgba(40, 167, 69, 0.8) !important;
    }
    .review-card {
        animation: fadeInUp 0.5s ease forwards;
    }
    .text1 {
        color: #1f3b73;
    }

    @keyframes fadeInUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const reviewCards = document.querySelectorAll('.review-card');
        reviewCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.transform = 'translateY(0)';
                card.style.opacity = '1';
                card.style.boxShadow = '0 10px 15px rgba(40, 167, 69, 0.3)';
            }, index * 150);
        });
    });
</script>
@endsection