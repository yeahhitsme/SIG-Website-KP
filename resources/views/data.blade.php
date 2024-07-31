<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelompok</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        .navbar-custom {
            background-color: #007bff; /* Warna biru */
            padding: 0.5rem 1rem; /* Padding untuk navbar */
        }
        .navbar-custom .navbar-brand {
            color: #fff; /* Warna teks putih */
            font-size: 1.5rem; /* Ukuran font untuk ikon */
            font-weight: bold; /* Bold untuk ikon */
        }
        .navbar-custom .navbar-brand:hover {
            color: #e0e0e0; /* Warna putih terang saat hover */
        }
        .navbar-custom .navbar-text {
            color: #fff; /* Warna teks putih */
            margin-left: 0.5rem; /* Jarak antara ikon dan teks */
            font-size: 1.5rem; /* Ukuran font untuk "Kelola Data" */
            font-weight: bold; /* Bold untuk teks */
        }
        .table-container {
            max-height: 500px;
            overflow-y: auto;
            position: relative;
        }
        .table-container thead {
            position: sticky;
            top: 0;
            background: #f8f9fa; /* Same as the table background */
            z-index: 1; /* Ensure it stays above the body */
        }
        .table {
            margin-bottom: 0; /* Remove margin to align with container */
        }
        .table-wrapper {
            overflow: hidden; /* Hide any overflow from the container */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="{{ url('/') }}">
            &larr;
        </a>
        <span class="navbar-text">
            Kelola Data
        </span>
    </nav>

    <div class="container mt-3">
        <div class="d-flex justify-content-between mb-3">
            <input type="text" id="searchInput" class="form-control mr-2" style="width: 300px;" placeholder="Cari...">
            <button id="btnDeleteSelected" class="btn btn-danger">Hapus</button>
        </div>
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>Nama Kelompok</th>
                        <th>Alamat</th>
                        <th>Jumlah Anggota</th>
                        <th>Nama Ketua Kelompok</th>
                        <th>Nomor HP</th>
                        <th>Koordinat Lokasi</th>
                        <th>Jenis Budidaya</th>
                        <th>Jenis Komoditas</th>
                        <th>Tanggal SK</th>
                        <th>Luas Lahan</th>
                        <th>Produksi/Siklus</th>
                        <th>Siklus/Tahun</th>
                        <th>Bantuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelompokData as $kelompok)
                    <tr>
                        <td><input type="checkbox" class="select-item" value="{{ $kelompok->id }}"></td>
                        <td>{{ $kelompok->nama_kelompok }}</td>
                        <td>{{ $kelompok->alamat }}</td>
                        <td>{{ $kelompok->jumlah_anggota }}</td>
                        <td>{{ $kelompok->nama_ketua_kelompok }}</td>
                        <td>{{ $kelompok->nomor_hp }}</td>
                        <td>{{ $kelompok->koordinat_lokasi }}</td>
                        <td>{{ $kelompok->jenis_budidaya }}</td>
                        <td>{{ $kelompok->jenis_komoditas }}</td>
                        <td>{{ $kelompok->tanggal_sk }}</td>
                        <td>{{ $kelompok->luas_lahan }}</td>
                        <td>{{ $kelompok->produksi_siklus }}</td>
                        <td>{{ $kelompok->siklus_tahun }}</td>
                        <td>{{ $kelompok->bantuan }}</td>
                        <td>
                            <a href="/edit/{{ $kelompok->id }}" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $kelompok->id }}">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- SweetAlert2 untuk konfirmasi hapus -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Fungsi untuk menghapus data terpilih
        $('#btnDeleteSelected').on('click', function() {
            var selectedIds = $('.select-item:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length === 0) {
                Swal.fire('Peringatan', 'Tidak ada data yang dipilih', 'warning');
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data yang dipilih?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/kelompok',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: selectedIds
                        },
                        success: function(response) {
                            Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                            location.reload();
                        },
                        error: function() {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        }
                    });
                }
            });
        });

        // Fungsi untuk konfirmasi hapus satu data
        $('.btn-delete').on('click', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/kelompok/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                            location.reload();
                        },
                        error: function() {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        }
                    });
                }
            });
        });

        // Fungsi untuk pencarian
        $('#searchInput').on('input', function() {
            var searchQuery = $(this).val().toLowerCase();
            $('tbody tr').each(function() {
                var row = $(this);
                var text = row.text().toLowerCase();
                row.toggle(text.indexOf(searchQuery) > -1);
            });
        });

        // Fungsi untuk select/unselect semua checkbox
        $('#selectAll').on('change', function() {
            $('.select-item').prop('checked', $(this).prop('checked'));
        });
    </script>
</body>
</html>
