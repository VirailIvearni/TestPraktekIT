<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="bg-dark text-white p-3 vh-100" style="width: 250px; position: fixed;">
        <h4 class="mb-4">
            <a href="{{ route('dashboard.index') }}" class="text-white text-decoration-none">Dashboard</a>
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

    <!-- Main Content -->
    <div class="container mt-5" style="margin-left: 270px; max-width: 600px;">
        <div class="card shadow">
            <div class="card-header bg-warning text-white">
                <h4>Edit Profil</h4>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Foto -->
                    <div class="mb-3 text-center">
                        <img src="{{ $user->foto ? asset('assets/image/' . $user->foto) : asset('assets/image/default.png') }}" 
                        alt="Foto Kandidat" 
                        class="rounded-circle mb-3" 
                        style="width:150px;height:150px;object-fit:cover;">
                        <input type="file" name="foto" class="form-control mt-2" accept=".jpg,.png">
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <!-- Posisi -->
                    <div class="mb-3">
                        <label class="form-label">Posisi</label>
                        <input type="text" name="posisi" class="form-control" value="{{ $user->posisi }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-1"></i> Update
                        </button>
                        <a href="{{ route('profil.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
