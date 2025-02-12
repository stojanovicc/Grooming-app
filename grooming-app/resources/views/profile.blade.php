@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Profil salona -->
    <div class="card shadow-lg p-4 mb-5 position-relative">
        <!-- Sticker u uglu -->
        <div class="sticker position-absolute top-0 end-0 text-white rounded-circle shadow" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; background-color: #d4ac0d">
            <i class="fa-solid fa-star"></i>
        </div>
        <div class="row align-items-center">
            <!-- Profilna slika sa animacijom -->
            <div class="col-md-4 text-center">
                <div class="profile-image-container position-relative">
                    @if($salon->profile_image_url)
                        <img src="{{ $salon->profile_image_url }}" alt="Profile Image" class="img-fluid rounded-circle shadow-lg animate-pop" style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Image" class="img-fluid rounded-circle shadow-lg animate-pop" style="width: 200px; height: 200px; object-fit: cover;">
                    @endif
                </div>
            </div>

            <!-- Informacije o salonu -->
            <div class="col-md-8">
                <h1 class="display-5 d-flex align-items-center">
                    {{ $salon->name }}
                    <i class="fa-solid fa-spa ms-3" style="color: #1f3b73;"></i>
                </h1>
                <p class="text-muted"><strong>Vlasnik:</strong> {{ $user->owner_name }}</p>
                <div class="mt-3">
                    <p><i class="fa-solid fa-envelope text-primary me-2"></i><strong>Email:</strong> {{ $user->email ?? 'Nije dostupno' }}</p>
                    <p><i class="fa-solid fa-phone text-success me-2"></i><strong>Kontakt:</strong> {{ $salon->phone ?? 'Nije dostupno' }}</p>
                    <p><i class="fa-solid fa-city text-warning me-2"></i><strong>Grad:</strong> {{ $salon->city ?? 'Nije dostupno' }}</p>
                    <p><i class="fa-solid fa-location-dot text-danger me-2"></i><strong>Adresa:</strong> {{ $salon->address ?? 'Nije dostupno' }}</p>
                    <p><i class="fa-solid fa-map text-secondary me-2"></i><strong>Podrucje:</strong> {{ $salon->area ?? 'Nije dostupno' }}</p>
                </div>
                <div class="mt-4">
                    <a href="#services-section" class="btn btn-lg custom-btn">
                        <i class="fa-solid fa-briefcase me-2"></i>Usluge
                    </a>
                    <a href="#gallery-section" class="btn btn-lg custom1-btn">
                        <i class="fa-solid fa-images me-2"></i>Galerija
                    </a>
                </div>
                @auth
                    @if (auth()->id() === $salon->user_id)
                        <a href="{{ route('profile.edit', $salon->id) }}" class="btn mt-3" style="border: 2px solid #5a6268; background-color: #5a6268; color: white;">
                            <i class="fa-solid fa-edit me-2" style="color: white;"></i>Uredi profil
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Usluge -->
    <div id="services-section" class="card shadow-lg p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="card-title">
                <i class="fa-solid fa-briefcase me-2" style="color: #1f3b73"></i>Usluge u salonu
            </h3>
            @auth
                @if (auth()->id() === $salon->user_id)
                    <a href="{{ route('services.create', $salon->id) }}" class="btn custom3-btn">
                        <i class="fa-solid fa-plus me-2"></i>Dodaj uslugu
                    </a>
                @endif
            @endauth
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table" style="background-color: #1f3b73; color: white">
                    <tr>
                        <th><i class="fa-solid fa-signature me-2"></i>Naziv</th>
                        <th><i class="fa-solid fa-hourglass-half me-2"></i>Trajanje (min)</th>
                        <th><i class="fa-solid fa-money-bill-wave me-2"></i>Cena (RSD)</th>
                        @auth
                            @if (auth()->id() === $salon->user_id)
                                <th><i class="fa-solid fa-cog me-2"></i>Akcije</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($salon->services as $service)
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->duration }}</td>
                            <td>{{ number_format($service->price, 2) }}</td>
                            @auth
                                @if (auth()->id() === $salon->user_id)
                                    <td>
                                        <form action="{{ route('services.destroy', ['id' => $salon->id, 'serviceId' => $service->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovu uslugu?');">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('services.edit', ['id' => $salon->id, 'serviceId' => $service->id]) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i> Izmeni</a>
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Obriši</button>
                                        </form>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Trenutno nema usluga.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Galerija -->
    <div id="gallery-section" class="card shadow-lg p-4 mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="card-title">
                <i class="fa-solid fa-images me-2" style="color: #d4ac0d"></i>Galerija
            </h3>
            @auth
                @if (auth()->id() === $salon->user_id)
                    <!-- Dugme za dodavanje slike -->
                    <form action="{{ route('galleries.store', $salon->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="image" class="btn custom4-btn me-2">
                            <i class="fa-solid fa-upload me-2"></i>Dodaj sliku
                        </label>
                        <input type="file" name="image" id="image" class="d-none" onchange="this.form.submit()">
                    </form>
                @endif
            @endauth
        </div>

        <div class="row">
            @forelse($salon->galleries as $gallery)
                <div class="col-md-4 mb-4">
                    <div class="card gallery-card">
                        <!-- Klik na sliku da je prikaže u fullscreen-u -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-slide-to="{{ $loop->index }}">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery Image" class="card-img-top gallery-image" style="height: 200px; object-fit: cover;">
                        </a>

                        @auth
                            @if (auth()->id() === $salon->user_id)
                                <div class="card-body text-center delete-container">
                                    <form action="{{ route('galleries.destroy', [$salon->id, $gallery->id]) }}" method="POST" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovu sliku?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i> Obriši
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <p class="text-center">Galerija je trenutno prazna.</p>
            @endforelse
        </div>
    </div>

    <!-- Lightbox modal za prikazivanje slika u fullscreen-u -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Dugme za zatvaranje modala (X) -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="lightbox-gallery" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($salon->galleries as $gallery)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="d-block w-100" alt="Gallery Image" style="object-fit: contain; height: 600px;">
                                </div>
                            @endforeach
                        </div>
                        <!-- Kontrole za strelice -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#lightbox-gallery" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#lightbox-gallery" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Omogućiti prebacivanje na odgovarajuću sliku kada je modal otvoren
        var galleryModal = document.getElementById('galleryModal')
        galleryModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget // dugme koje je otvorilo modal
            var slideIndex = button.getAttribute('data-bs-slide-to') // indeks slike
            var carousel = galleryModal.querySelector('#lightbox-gallery')
            var carouselInstance = new bootstrap.Carousel(carousel)
            carouselInstance.to(slideIndex) // Podesi početnu sliku prema indeksu
        })
    </script>
</div>

<!-- Dodate CSS animacije -->
<style>
    .animate-pop {
        animation: pop-in 0.5s ease-in-out;
    }
    @keyframes pop-in {
        0% {
            transform: scale(0.7);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Smooth scroll efekat */
    html {
        scroll-behavior: smooth;
    }

    .sticker {
        animation: bounce 1.5s infinite;
    }

    .custom-btn {
        color: #1f3b73;
        border: 2px solid #1f3b73;
        transition: all 0.3s ease;
        padding: 10px 20px;
        background-color: transparent;
    }

    .custom-btn:hover {
        color: #fff;
        border-color: #fff;
        background-color: #1f3b73;
        transform: scale(1.05);
    }

    .custom1-btn {
        color: #d4ac0d;
        border: 2px solid #d4ac0d;
        transition: all 0.3s ease;
        padding: 10px 20px;
        background-color: transparent;
    }

    .custom1-btn:hover {
        color: #fff;
        border-color: #fff;
        background-color: #d4ac0d;
        transform: scale(1.05);
    }

    .custom3-btn {
        background-color: #1f3b73;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom3-btn:hover {
        color: #fff;
        background-color: #162a54;
    }

    .custom4-btn {
        background-color: #d4ac0d;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom4-btn:hover {
        color: #fff;
        background-color:rgb(190, 155, 11);
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    /* Hover efekat za uvećanje slike */
    .gallery-image {
        transition: transform 0.3s ease;
    }

    .gallery-image:hover {
        transform: scale(1.1); /* Uvećava sliku pri hover-u */
    }

        /* Prikazivanje dugmeta za brisanje prilikom hover-a */
    .gallery-card {
        position: relative;
    }

    .delete-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-card:hover .delete-container {
        opacity: 1; /* Prikazivanje dugmeta za brisanje */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #1f3b73; /*boja za strelice */
    }
</style>
@endsection
