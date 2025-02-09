@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Uredi usluge</h1>
    <form action="{{ route('profile.update.services') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="services" class="form-label">Unesite usluge</label>
            <textarea name="services" class="form-control" rows="5">{{ old('services', $user->services) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Spasi izmene</button>
    </form>
</div>
@endsection
