@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Settings</h2>

        <!-- Brisanje naloga -->
        <form action="{{ route('deleteAccount') }}" method="POST">
            @csrf
            <div class="alert alert-warning" role="alert">
                Ovaj korak je nepovratan. Tvoj profil će biti zauvek obrisan!
            </div>
            <button type="submit" class="btn btn-danger">Obriši nalog</button>
        </form>
    </div>
@endsection
