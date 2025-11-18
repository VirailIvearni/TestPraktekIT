<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="d-flex">

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
                <a class="nav-link text-white" href="/profil">
                    <i class="bi bi-person-fill me-2"></i>
                    Profil
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

    <main class="flex-grow-1 p-4" style="margin-left: 250px;">
        <h2 class="mb-4">Dashboard Siswa</h2>

        <div class="row g-3">
            <!-- Total Siswa -->
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Siswa</h5>
                        <p class="card-text fs-4">{{ $totalSiswa }}</p>
                    </div>
                </div>
            </div>

            @foreach($totalPerLembaga as $l)
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-success h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $l->nama_lembaga }}</h5>
                        <p class="card-text fs-4">{{ $l->siswa_count }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
