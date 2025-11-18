<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
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
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>

                <a class="nav-link text-danger fw-bold" href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-grow-1 p-4" style="margin-left: 250px;">
        <div class="container-fluid">

            <h2>Data Siswa</h2>

            <div class="mb-3">
                <a href="{{ route('siswa.create') }}" class="btn btn-success mb-2">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Siswa
                </a>

                <a id="exportBtn" href="{{ route('siswa.export') }}" class="btn btn-success mb-2">
                    <i class="bi bi-file-earmark-excel me-1"></i> Export CSV
                </a>
            </div>

            <!-- FILTER LEMBAGA -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <select id="filterLembaga" class="form-select">
                        <option value="">-- Filter Lembaga --</option>
                        @foreach($lembaga as $l)
                            <option value="{{ $l->nama_lembaga }}">{{ $l->nama_lembaga }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- TABLE -->
            <table id="myTable" class="display table table-striped">
                <thead>
                    <tr>
                        <th>Lembaga</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $s)
                    <tr>
                        <td>{{ $s->lembaga->nama_lembaga }}</td>
                        <td>{{ $s->nis }}</td>
                        <td>{{ $s->nama }}</td>
                        <td>{{ $s->email }}</td>
                        <td>
                            @if($s->image)
                                <img src="{{ asset('assets/images/'.$s->image) }}"
                                     style="width:100px; height:100px; object-fit:cover;">
                            @else
                                <img src="{{ asset('assets/image.png') }}"
                                     style="width:100px; height:100px; object-fit:cover;">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('siswa.edit', $s) }}" class="btn btn-warning btn-sm mb-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </main>

</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#myTable').DataTable({
        paging: true,
        pageLength: 10,
        lengthChange: true,
        info: true,
        autoWidth: false,
        columnDefs: [
            { orderable: false, targets: [4, 5] }
        ]
    });

    // FILTER NIS & NAMA (CARA YANG BENAR)
    $('#myTable_filter input').off().on('keyup', function() {
        let value = this.value.toLowerCase();

        table.rows().every(function() {
            let nis = this.data()[1].toString().toLowerCase();
            let nama = this.data()[2].toString().toLowerCase();

            if (nis.includes(value) || nama.includes(value)) {
                $(this.node()).show();
            } else {
                $(this.node()).hide();
            }
        });

        table.draw();
    });

    // FILTER LEMBAGA
    $('#filterLembaga').on('change', function() {
        let val = this.value.toLowerCase();

        table.rows().every(function() {
            let lembaga = this.data()[0].toString().toLowerCase();
            if (lembaga.includes(val) || val === '') {
                $(this.node()).show();
            } else {
                $(this.node()).hide();
            }
        });

        table.draw();
    });
});
</script>
</body>
</html>
