<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                <i class="fas fa-school"></i> Sekolah App
            </a>
            <div class="navbar-nav ms-auto">
                <a href="{{ route('profil.index') }}" class="nav-link">Profil</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <h2><i class="fas fa-user"></i> Detail Siswa</h2>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if($siswa->image)
                            <img src="{{ asset('assets/images/' . $siswa->image) }}" 
                                 alt="Foto Siswa" 
                                 class="img-fluid rounded" 
                                 style="max-height: 300px;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="height: 300px;">
                                <i class="fas fa-user fa-5x text-muted"></i>
                            </div>
                            <p class="text-muted mt-2">Tidak ada foto</p>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Nama Lembaga</th>
                                <td>{{ $siswa->lembaga->nama_lembaga ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>NIS</th>
                                <td>{{ $siswa->nis }}</td>
                            </tr>
                            <tr>
                                <th>Nama Siswa</th>
                                <td>{{ $siswa->nama }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $siswa->email }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Dibuat</th>
                                <td>{{ $siswa->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir Diupdate</th>
                                <td>{{ $siswa->updated_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        </table>

                        <div class="mt-3">
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Data
                            </a>
                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Yakin ingin menghapus data siswa?')">
                                    <i class="fas fa-trash"></i> Hapus Data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>