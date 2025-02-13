@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-2" style="color: #1f3b73; font-size: 2rem; font-weight: 600;">Uredi profil</h2>

    <!-- Prikazivanje grešaka ako postoje -->
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
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

        <div class="card shadow-lg mx-auto" style="max-width: 600px; border-radius: 15px; border: 1px solid #1f3b73;">
            <div class="card-body">
                <div class="mb-4">
                    <label for="owner_name" class="form-label" style="font-weight: 500; font-size: 1.1rem;"><i class="fas fa-user" style="color: #1f3b73;"></i> Ime i prezime:</label>
                    <input type="text" name="owner_name" id="owner_name" class="form-control" value="{{ old('owner_name', $user->owner_name) }}" style="border-radius: 10px; font-size: 1rem; padding: 12px;">
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label" style="font-weight: 500; font-size: 1.1rem;"><i class="fas fa-phone-alt" style="color: #1f3b73;"></i> Telefon:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $salon->phone) }}" style="border-radius: 10px; font-size: 1rem; padding: 12px;">
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label" style="font-weight: 500; font-size: 1.1rem;"><i class="fas fa-envelope" style="color: #1f3b73;"></i> Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" style="border-radius: 10px; font-size: 1rem; padding: 12px;">
                </div>

                <div class="mb-4">
                    <label for="city" class="form-label" style="font-weight: 500; font-size: 1.1rem;"><i class="fas fa-city" style="color: #1f3b73;"></i> Grad:</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $salon->city) }}" style="border-radius: 10px; font-size: 1rem; padding: 12px;">
                </div>

                <div class="mb-4">
                    <label for="address" class="form-label" style="font-weight: 500; font-size: 1.1rem;"><i class="fas fa-map-marker-alt" style="color: #1f3b73;"></i> Adresa:</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $salon->address) }}" style="border-radius: 10px; font-size: 1rem; padding: 12px;">
                </div>

                <div class="mb-4">
                    <label for="area" class="form-label" style="font-weight: 500; font-size: 1.1rem;"><i class="fas fa-map" style="color: #1f3b73;"></i> Podrucje:</label>
                    <input type="text" name="area" id="area" class="form-control" value="{{ old('area', $salon->area) }}" style="border-radius: 10px; font-size: 1rem; padding: 12px;">
                </div>

                <div class="mb-4">
                    <label for="profile_image_url" class="form-label" style="font-weight: 500; font-size: 1.1rem;"><i class="fas fa-image" style="color: #1f3b73;"></i> URL Profilne slike:</label>
                    <input type="url" name="profile_image_url" id="profile_image_url" class="form-control" value="{{ old('profile_image_url', $salon->profile_image_url) }}" style="border-radius: 10px; font-size: 1rem; padding: 12px;">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn" style="background-color: #1f3b73; color: white; border-radius: 8px; font-size: 1.1rem; font-weight: 500; padding: 10px 25px; border: none; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#173b56'" onmouseout="this.style.backgroundColor='#1f3b73'">
                        Sačuvaj izmene
                    </button>
                    <a href="{{ route('profile.show', $salon->id) }}" class="btn" style="background-color: #6c757d; color: white; border-radius: 8px; font-size: 1.1rem; font-weight: 500; padding: 10px 25px; text-decoration: none; border: none; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#5a6268'" onmouseout="this.style.backgroundColor='#6c757d'">
                        Otkaži
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection