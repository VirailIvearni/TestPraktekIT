<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kandidat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="bg-dark text-white p-3 vh-100" style="width: 250px; position: fixed;">
        <h4 class="mb-4">
            <a href="{{ route('dashboard.index') }}" class="text-white text-decoration-none">
                Dashboard
            </a>
        </h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('siswa.index') }}">
                    <i class="bi bi-people-fill me-2"></i> Siswa
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('profil.index') }}">
                    <i class="bi bi-person-fill me-2"></i> Profil
                </a>
            </li>
            <li class="nav-item mt-4">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <a class="nav-link text-danger fw-bold" href="#" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Profil Card -->
    <div class="container mt-5" style="max-width: 600px; margin-left: 260px;">
        <div class="card shadow text-center">
            <div class="card-body">

                <!-- Foto Kandidat -->
                <img src="{{ $user->foto ? asset('assets/image/' . $user->foto) : asset('assets/image/default.png') }}" 
                alt="Foto Kandidat" 
                class="rounded-circle mb-3" 
                style="width:150px;height:150px;object-fit:cover;">

                <!-- Nama Kandidat -->
                <h3 class="fw-bold">{{ $user->name }}</h3>

                <!-- Email Kandidat -->
                <h5 class="text-muted">{{ $user->posisi }}</h5>

                <!-- Tombol Edit Profil -->
                <a href="{{ route('profil.edit') }}" class="btn btn-warning mt-3">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profil
                </a>


            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
