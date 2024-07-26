<!-- resources/views/petunjuk.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petunjuk Penggunaan Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff;
        }
        .dropdown-menu {
            right: auto;
            left: 0;
        }
        .navbar-brand {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Data Persebaran Pokdakan Kabupaten Banyumas</a>
            <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarToggle">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/">Home</a>
                            <a class="dropdown-item" href="/tentang">Tentang Website</a>
                            <a class="dropdown-item" href="/petunjuk">Petunjuk Penggunaan Website</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Petunjuk Penggunaan Website</h1>
                <div style="text-align: justify;">
                    <ol>
                        <li>
                            <strong>Menampilkan Peta Persebaran:</strong> 
                            <p>Buka halaman utama untuk melihat peta persebaran kelompok pembudi daya ikan di Kabupaten Banyumas. Pada peta, Anda dapat melihat lokasi setiap kelompok dengan ikon penanda (marker).</p>
                        </li>
                        <li>
                            <strong>Pencarian Data Kelompok:</strong> 
                            <p>Gunakan kolom pencarian di bagian atas peta untuk mencari kelompok berdasarkan nama atau alamat. Pilih kriteria pencarian dari dropdown dan masukkan kata kunci pada kolom pencarian.</p>
                        </li>
                        <li>
                            <strong>Menampilkan Detail Kelompok:</strong> 
                            <p>Klik pada penanda (marker) di peta untuk menampilkan detail kelompok. Informasi yang ditampilkan mencakup nama kelompok, alamat, jumlah anggota, nama ketua, nomor HP, koordinat lokasi, jenis budidaya, jenis komoditas, tanggal SK, luas lahan, produksi per siklus, jumlah siklus per tahun, dan bantuan yang diterima.</p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html
