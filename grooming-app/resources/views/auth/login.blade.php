<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Stilovi -->
    <style>
        body {
            background: url('{{ asset('images/pozadina.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .btn-secondary {
            background: #d4ac0d;
            border: none;
            transition: all 0.3s ease-in-out;
        }

        .btn-secondary:hover {
            background: #d4ac0d;
            transform: scale(1.1);
        }

        .form-control {
            border: 1px solid #ced4da;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #1f3b73;
            box-shadow: 0 0 5px;
        }

        .form-label {
            font-weight: bold;
            color: #1f3b73;
        }

        .icon {
            font-size: 1.2rem;
            color: #d4ac0d;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6">
        <div class="card">
                <div class="card-header text-center d-flex flex-column justify-content-start align-items-center" style="height: 80px; background-color: #1f3b73; color: white; padding-top: 15px;">
                    <h4 class="mb-1 d-flex align-items-center">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Prijava na Sistem
                    </h4>
                <p class="text-light" style="font-size: 0.9rem;">Unesite podatke da biste pristupili svom nalogu</p>
                <div class="position-absolute top-50 start-50 translate-middle" style="z-index: -1; opacity: 0.1; font-size: 8rem; color: white;">
                    <i class="bi bi-person-circle"></i>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email adresa</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill icon"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Lozinka</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill icon"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center d-flex justify-content-center align-items-center" style="height: 30px;">
                        <button type="submit" class="btn btn-secondary w-50" style="padding: 5px 20px;">Prijavi se</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
