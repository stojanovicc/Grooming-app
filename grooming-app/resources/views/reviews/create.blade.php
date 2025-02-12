@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dodaj recenziju za: {{ $salon->name }}</h1>

    <form method="POST" action="{{ route('reviews.store', $salon->id) }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="rating">Rating</label>
            <select name="rating" class="form-control" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea name="comment" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
    </div>
@endsection