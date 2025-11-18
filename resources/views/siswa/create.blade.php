<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<div class="d-flex">
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4>Tambah Siswa</h4>
                    </div>

                    <div class="card-body">

                        {{-- Error Validasi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            {{-- Lembaga --}}
                            <div class="mb-3">
                                <label class="form-label">Lembaga</label>
                                <select name="lembaga_id" class="form-select" required>
                                    <option value="">-- Pilih Lembaga --</option>
                                    @foreach($lembaga as $l)
                                        <option value="{{ $l->id }}">{{ $l->nama_lembaga }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- NIS --}}
                            <div class="mb-3">
                                <label class="form-label">NIS</label>
                                <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS" required>
                            </div>

                            {{-- Nama --}}
                            <div class="mb-3">
                                <label class="form-label">Nama Siswa</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Siswa" required>
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto (JPG/PNG max 100KB)</label>
                                <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png">
                            </div>

                            {{-- Tombol --}}
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary ms-2">Kembali</a>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
