<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kelompok</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        #map { height: 400px; }
        .btn-tampilkan-lokasi {
            font-size: 12px;
            padding: 4px 8px;
            margin-bottom: 10px;
        }
        .form-group-last {
            margin-bottom: 20px; /* Margin bawah tambahan di bawah tombol Simpan */
        }
        .btn-batal {
            background-color: #fff;
            color: #007bff;
            border: 1px solid #007bff;
        }
        .btn-batal:hover {
            background-color: #e9ecef;
        }
        .navbar-custom {
            background-color: #007bff; /* Warna biru */
            padding: 0.5rem 1rem; /* Padding untuk navbar */
            position: relative;
        }
        .navbar-custom {
            background-color: #007bff; /* Warna biru */
            padding: 0.5rem 1rem; /* Padding untuk navbar */
        }
        .navbar-custom .navbar-brand {
            color: #fff; /* Warna teks putih */
            font-size: 1.5rem; /* Ukuran font untuk ikon */
            font-weight: bold; /* Bold untuk ikon */
            display: flex;
            align-items: center;
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
        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #007bff;
            color: #fff;
            font-size: 24px;
            text-decoration: none;
            margin-right: 15px;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
        .form-container {
            background-color: #ffffff; /* Latar belakang putih */
            border: 1px solid #ddd; /* Border abu-abu ringan */
            border-radius: 8px; /* Sudut border membulat */
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); /* Efek bayangan */
            padding: 20px; /* Ruang dalam untuk konten */
            margin: 20px auto; /* Memberikan jarak atas-bawah */
            max-width: 800px; /* Batas lebar maksimum form */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="btn-back" href="{{ url('/') }}">
            <i class="fa fa-arrow-left"></i>
        </a>
        <span class="navbar-text">
            Edit Data 
        </span>
    </nav>
    
    <div class="form-container">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Edit Data Kelompok</h2>
                <form id="formEdit" action="{{ route('kelompok.update', $kelompok->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Tambahkan input hidden untuk menyimpan URL asal -->
                    <input type="hidden" name="redirect_to" value="{{ session('redirect_to') }}">
                    <div class="form-group">
                        <label for="nama_kelompok">Nama Kelompok</label>
                        <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok" value="{{ $kelompok->nama_kelompok }}" placeholder="Masukkan Nama Kelompok" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat" required>{{ $kelompok->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_anggota">Jumlah Anggota</label>
                        <input type="number" class="form-control" id="jumlah_anggota" name="jumlah_anggota" value="{{ $kelompok->jumlah_anggota }}" placeholder="Masukkan Jumlah Anggota">
                    </div>
                    <div class="form-group">
                        <label for="nama_ketua_kelompok">Nama Ketua Kelompok</label>
                        <input type="text" class="form-control" id="nama_ketua_kelompok" name="nama_ketua_kelompok" value="{{ $kelompok->nama_ketua_kelompok }}" placeholder="Masukkan Nama Ketua Kelompok">
                    </div>
                    <div class="form-group">
                        <label for="nomor_hp">Nomor HP</label>
                        <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{ $kelompok->nomor_hp }}" placeholder="Masukkan Nomor HP">
                    </div>
                    <div class="form-group">
                        <label for="koordinat_lokasi">Koordinat Lokasi</label>
                        <input type="text" class="form-control" id="koordinat_lokasi" name="koordinat_lokasi" value="{{ $kelompok->koordinat_lokasi }}" placeholder="Masukkan Koordinat Lokasi (contoh: -7.345, 110.454)" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_budidaya">Jenis Budidaya</label>
                        <input type="text" class="form-control" id="jenis_budidaya" name="jenis_budidaya" value="{{ $kelompok->jenis_budidaya }}" placeholder="Masukkan Jenis Budidaya">
                    </div>
                    <div class="form-group">
                        <label for="jenis_komoditas">Jenis Komoditas</label>
                        <input type="text" class="form-control" id="jenis_komoditas" name="jenis_komoditas" value="{{ $kelompok->jenis_komoditas }}" placeholder="Masukkan Jenis Komoditas">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_sk">Tanggal SK</label>
                        <input type="date" class="form-control" id="tanggal_sk" name="tanggal_sk" value="{{ $kelompok->tanggal_sk }}">
                    </div>
                    <div class="form-group">
                        <label for="luas_lahan">Luas Lahan</label>
                        <input type="text" class="form-control" id="luas_lahan" name="luas_lahan" value="{{ $kelompok->luas_lahan }}" placeholder="Masukkan Luas Lahan">
                    </div>
                    <div class="form-group">
                        <label for="produksi_siklus">Produksi/Siklus</label>
                        <input type="text" class="form-control" id="produksi_siklus" name="produksi_siklus" value="{{ $kelompok->produksi_siklus }}" placeholder="Masukkan Jumlah Produksi/Siklus">
                    </div>
                    <div class="form-group">
                        <label for="siklus_tahun">Siklus/Tahun</label>
                        <input type="text" class="form-control" id="siklus_tahun" name="siklus_tahun" value="{{ $kelompok->siklus_tahun }}" placeholder="Masukkan Jumlah Siklus/Tahun">
                    </div>
                    <div class="form-group">
                        <label for="bantuan">Tahun Terakhir Menerima Bantuan</label>
                        <input type="text" class="form-control" id="bantuan" name="bantuan" value="{{ $kelompok->bantuan }}" placeholder="Masukkan Tahun">
                    </div>
                    <div id="map" class="mb-3"></div>
                    <button type="button" class="btn btn-primary btn-tampilkan-lokasi float-left" onclick="updateMap()">Tampilkan Lokasi</button>
                    <button type="submit" class="btn btn-primary btn-block mb-2">Simpan</button>
                    <button type="button" class="btn btn-danger btn-block" id="btnBatal" data-previous-url="{{ url()->previous() }}">Batal</button>
                    <div class="form-group-last"></div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        var map = L.map('map').setView([{{ explode(',', $kelompok->koordinat_lokasi)[0] }}, {{ explode(',', $kelompok->koordinat_lokasi)[1] }}], 13); // Koordinat dari data
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        var marker = L.marker([{{ explode(',', $kelompok->koordinat_lokasi)[0] }}, {{ explode(',', $kelompok->koordinat_lokasi)[1] }}]).addTo(map);

        function updateMap() {
            var koordinat = document.getElementById('koordinat_lokasi').value;
            if (koordinat) {
                var latlng = koordinat.split(',');
                var lat = parseFloat(latlng[0]);
                var lng = parseFloat(latlng[1]);
                if (!isNaN(lat) && !isNaN(lng)) {
                    map.setView([lat, lng], 13);
                    marker.setLatLng([lat, lng]);
                } else {
                    Swal.fire('Format koordinat salah', 'Gunakan format angka yang sesuai, misal: -7.345, 110.454', 'error');
                }
            } else {
                Swal.fire('Koordinat Tidak Ditemukan', 'Masukkan koordinat terlebih dahulu.', 'warning');
            }
        }

        document.getElementById('btnBatal').addEventListener('click', function() {
            var previousUrl = this.getAttribute('data-previous-url');
            window.location.href = previousUrl;
        });
    </script>
</body>
</html>