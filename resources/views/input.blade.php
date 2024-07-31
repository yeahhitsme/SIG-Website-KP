<!-- resources/views/input.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kelompok</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.0/sweetalert2.min.css">
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="{{ url('/') }}">
            &larr;
        </a>
        <span class="navbar-text">
            Tambah Data 
        </span>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Tambah Data Kelompok</h2>
                <form id="formInput" action="{{ route('kelompok.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kelompok">Nama Kelompok</label>
                        <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok" placeholder="Masukkan Nama Kelompok" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_anggota">Jumlah Anggota</label>
                        <input type="number" class="form-control" id="jumlah_anggota" name="jumlah_anggota" placeholder="Masukkan Jumlah Anggota">
                    </div>
                    <div class="form-group">
                        <label for="nama_ketua_kelompok">Nama Ketua Kelompok</label>
                        <input type="text" class="form-control" id="nama_ketua_kelompok" name="nama_ketua_kelompok" placeholder="Masukkan Nama Ketua Kelompok">
                    </div>
                    <div class="form-group">
                        <label for="nomor_hp">Nomor HP</label>
                        <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="Masukkan Nomor HP">
                    </div>
                    <div class="form-group">
                        <label for="koordinat_lokasi">Koordinat Lokasi</label>
                        <input type="text" class="form-control" id="koordinat_lokasi" name="koordinat_lokasi" placeholder="Masukkan Koordinat Lokasi (contoh: -7.422848875203752, 109.24185349485774)" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_budidaya">Jenis Budidaya</label>
                        <input type="text" class="form-control" id="jenis_budidaya" name="jenis_budidaya" placeholder="Masukkan Jenis Budidaya">
                    </div>
                    <div class="form-group">
                        <label for="jenis_komoditas">Jenis Komoditas</label>
                        <input type="text" class="form-control" id="jenis_komoditas" name="jenis_komoditas" placeholder="Masukkan Jenis Komoditas">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_sk">Tanggal SK</label>
                        <input type="date" class="form-control" id="tanggal_sk" name="tanggal_sk">
                    </div>
                    <div class="form-group">
                        <label for="luas_lahan">Luas Lahan</label>
                        <input type="text" class="form-control" id="luas_lahan" name="luas_lahan" placeholder="Masukkan Luas Lahan">
                    </div>
                    <div class="form-group">
                        <label for="produksi_siklus">Produksi/Siklus</label>
                        <input type="text" class="form-control" id="produksi_siklus" name="produksi_siklus" placeholder="Masukkan Jumlah Produksi/Siklus">
                    </div>
                    <div class="form-group">
                        <label for="siklus_tahun">Siklus/Tahun</label>
                        <input type="text" class="form-control" id="siklus_tahun" name="siklus_tahun" placeholder="Masukkan Jumlah Siklus/Tahun">
                    </div>
                    <div class="form-group">
                        <label for="bantuan">Tahun Terakhir Menerima Bantuan</label>
                        <input type="text" class="form-control" id="bantuan" name="bantuan" placeholder="Masukkan Tahun">
                    </div>
                    <div id="map" class="mb-3"></div>
                    <button type="button" class="btn btn-primary btn-tampilkan-lokasi float-left" onclick="updateMap()">Tampilkan Lokasi</button>
                    <button type="button" class="btn btn-primary btn-block mb-2" onclick="simpanData()">Simpan</button>
                    <button type="button" class="btn btn-danger btn-block" onclick="batal()">Batal</button>
                    <div class="form-group-last"></div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.0/sweetalert2.all.min.js"></script>
    <script>
        var map = L.map('map').setView([-7.422848875203752, 109.24185349485774], 13); // contoh koordinat pusat peta
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        var marker = L.marker([-7.422848875203752, 109.24185349485774]).addTo(map); // Marker awal

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

        function simpanData() {
            document.getElementById('formInput').submit();
        }

        function batal() {
            window.location.href = '/';
        }
    </script>
</body>
</html>
