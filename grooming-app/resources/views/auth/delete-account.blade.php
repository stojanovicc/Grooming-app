@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-danger text-danger shadow-sm" style="transition: transform 0.3s, box-shadow 0.3s;">
        <div class="card-body">
            <h2 class="card-title text-center fw-bold">UPOZORENJE</h2>
            <p class="card-text text-center">
                Brisanjem naloga svi podaci, uključujući vaš profil, veze sa salonima i druge informacije, biće 
                <strong>zauvek izbrisani</strong>. Ova radnja <strong>se ne može poništiti!</strong>
            </p>
            <hr>
            <p class="text-center">Da li ste sigurni da želite da obrišete svoj nalog?</p>
            <div class="d-flex justify-content-center">
                <form action="{{ route('delete.account.confirm') }}" method="POST">
                    @csrf
                    <button type="submit" name="confirmation" value="yes" href="/" class="btn btn-danger me-2">
                        Da, obriši moj nalog
                    </button>
                </form>
                <a href="{{ route('profile.showProfile') }}" class="btn btn-secondary">Ne, otkaži</a>
            </div>
        </div>
    </div>
</div>
@endsection