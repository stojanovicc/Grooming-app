@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Recenzije za: {{ $salon->name }}</h1>

    <a href="{{ route('reviews.create', $salon->id) }}" class="btn btn-primary mb-3">Dodaj recenziju</a>

    @if($salon->reviews->count())
        @foreach($salon->reviews as $review)
        <div class="review">
            <h5>{{ $review->name }}</h5>
            <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
            <p><strong>Comment:</strong> {{ $review->comment }}</p>
            <small class="text-muted">Dodato: {{ $review->created_at->format('d.m.Y') }}</small>
        </div>
    @endforeach
        @else
        <p>Još nema recenzija za ovaj salon.</p>
    @endif
</div>
@endsection