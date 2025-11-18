<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
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

    <!-- CONTENT -->
    <main class="flex-grow-1 p-4" style="margin-left: 250px;">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-white">
                            <h4 class="mb-0"><i class="bi bi-pencil-square me-1"></i> Edit Siswa</h4>
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

                            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Lembaga</label>
                                    <select name="lembaga_id" class="form-select" required>
                                        <option value="">-- Pilih Lembaga --</option>
                                        @foreach($lembaga as $l)
                                            <option value="{{ $l->id }}" 
                                                {{ $siswa->lembaga_id == $l->id ? 'selected' : '' }}>
                                                {{ $l->nama_lembaga }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">NIS</label>
                                    <input type="text" name="nis" class="form-control" 
                                           value="{{ $siswa->nis }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nama Siswa</label>
                                    <input type="text" name="nama" class="form-control" 
                                           value="{{ $siswa->nama }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" 
                                           value="{{ $siswa->email }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto (JPG/PNG max 100KB)</label>
                                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png">

                                    @if($siswa->image)
                                        <img src="{{ asset('assets/images/'.$siswa->image) }}"
                                            alt="Foto"
                                            style="width:100px; height:100px; object-fit:cover; border-radius:5px;" 
                                            class="mt-2">
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-pencil-square me-1"></i> Update
                                </button>
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary ms-2">Kembali</a>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

</div>

<!-- Bootstrap JS + jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
