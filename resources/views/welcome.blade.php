<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Persebaran Pokdakan Kabupaten Banyumas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        #map {
            height: 450px;
            width: 100%; 
        }

        .navbar {
            background-color: #007bff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Menambah bayangan agar navbar lebih jelas */
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-toggler {
            margin-left: 0;
        }

        .navbar-nav .nav-item .dropdown-menu {
            position: absolute;
            will-change: transform;
            overflow: visible;
        }

        .navbar-brand {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            padding: 10px 0;
            font-weight: bold;
        }

        .navbar-nav {
            display: flex;
            justify-content: flex-end;
        }

        .navbar-nav .nav-item .dropdown-menu {
            background-color: #007bff;
            right: auto;
            left: 0;
        }

        .search-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 10px;
        }

        .search-container select,
        .search-container input {
            max-width: 200px;
            margin-right: 10px;
        }

        .search-container input {
            width: 100%;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .action-buttons a {
            margin-left: 10px;
            margin-bottom: 10px;
        }

        .btn-icon {
            display: flex;
            align-items: center;
        }

        .btn-icon i {
            margin-right: 5px;
        }

        @media (max-width: 767px) {
            .search-container {
                flex-direction: column;
                margin-bottom: 20px;
            }

            .navbar-brand {
                position: static;
                transform: none;
            }

            .navbar-nav {
                flex-direction: column;
                text-align: center;
                width: 100%;
            }

            .action-buttons {
                justify-content: center;
                width: 100%;
                margin-top: 10px;
            }

            .action-buttons a {
                margin: 5px 0;
            }
        }

    .modal-content {
        padding: 15px;
    }

    .modal-body p {
        font-size: 14px;
        line-height: 1.5;
    }

    .modal-footer {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }

    .custom-tooltip {
        background-color: rgba(0, 123, 255, 0.7);
        color: white;
        font-size: 12px;
        padding: 5px 8px;
        border-radius: 5px;
    }

    .swal2-popup {
        font-size: 14px;
    }

    .swal2-button {
        font-size: 16px;
    }

    hr {
        border: 0;
        border-top: 1px solid #ccc; /* Garis tipis berwarna abu-abu */
        margin: 10px 0;
    }

    .form-group {
        padding-bottom: 15px;
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
            <a class="navbar-brand" href="#">
                <span class="navbar-brand-text">Data Persebaran Pokdakkan</span>
                <span class="navbar-brand-text">Dinas Perikanan dan Peternakan Kabupaten Banyumas</span>
            </a>
            <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarToggle">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
                            Menu
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/">Home</a>
                            <a class="dropdown-item" href="/tentang">Tentang Website</a>
                            <a class="dropdown-item" href="/petunjuk">Petunjuk Penggunaan Website</a>
                        </div>
                    </li>
                </ul>
                @auth
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-light nav-link" style="color: #000;">Logout</button>
                        </form>
                    </li>
                </ul>
                @endauth
                @guest
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-light" href="{{ route('login') }}" style="color: #000;">Login</a>
                    </li>
                </ul>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container mt-5">
    <div class="row">
        <div class="col-12 d-flex justify-content-between">
            <div class="search-container">
                <select id="searchCriteria" class="form-control mb-3" style="max-width: 200px;">
                    <option value="nama_kelompok">Nama Kelompok</option>
                    <option value="alamat">Alamat</option>
                    <option value="jenis_budidaya">Jenis Budidaya</option>
                    <option value="jenis_komoditas">Jenis Komoditas</option>
                </select>
                <input type="text" id="searchInput" class="form-control mb-3 ml-2" placeholder="Cari..." style="max-width: 500px;">
            </div>
            @auth
            <div class="action-buttons">
                <a href="/input" class="btn btn-primary mb-3 btn-icon">
                    <i class="fas fa-plus"></i> Tambah
                </a>
                <a href="/data" class="btn btn-secondary mb-3 btn-icon">
                    <i class="fas fa-cogs"></i> Kelola Data
                </a>
            </div>
            @endauth
        </div>
        <div class="col-12">
            <div id="map" class="mt-4"></div>
        </div>
    </div>
</div>

    <!-- Modal untuk detail data -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Data Kelompok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formDetail">
                        <div class="form-group">
                            <label>Nama Kelompok:</label>
                            <p id="detail_nama_kelompok"></p>
                        </div>
                        <div class="form-group">
                            <label>Alamat:</label>
                            <p id="detail_alamat"></p>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Anggota:</label>
                            <p id="detail_jumlah_anggota"></p>
                        </div>
                        <div class="form-group">
                            <label>Nama Ketua Kelompok:</label>
                            <p id="detail_nama_ketua_kelompok"></p>
                        </div>
                        <div class="form-group">
                            <label>Nomor HP:</label>
                            <p id="detail_nomor_hp"></p>
                        </div>
                        <div class="form-group">
                            <label>Koordinat Lokasi:</label>
                            <p id="detail_koordinat_lokasi"></p>
                        </div>
                        <div class="form-group">
                            <label>Jenis Budidaya:</label>
                            <p id="detail_jenis_budidaya"></p>
                        </div>
                        <div class="form-group">
                            <label>Jenis Komoditas:</label>
                            <p id="detail_jenis_komoditas"></p>
                        </div>
                        <div class="form-group">
                            <label>Tanggal SK:</label>
                            <p id="detail_tanggal_sk"></p>
                        </div>
                        <div class="form-group">
                            <label>Luas Lahan:</label>
                            <p id="detail_luas_lahan"></p>
                        </div>
                        <div class="form-group">
                            <label>Produksi/Siklus:</label>
                            <p id="detail_produksi_siklus"></p>
                        </div>
                        <div class="form-group">
                            <label>Siklus/Tahun:</label>
                            <p id="detail_siklus_tahun"></p>
                        </div>
                        <div class="form-group">
                            <label>Bantuan:</label>
                            <p id="detail_bantuan"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 untuk konfirmasi hapus -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    var initialView = {
        center: [-7.423007307477761, 109.24186484513977],
        zoom: 14
    };

    var map = L.map('map', {preferCanvas: true}).setView(initialView.center, initialView.zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> Fahmi'
    }).addTo(map);

    var layerGroup = L.layerGroup().addTo(map);
    var markers = [];
    var kelompokData = @json($kelompokData);

    // Tambahkan marker berwarna hijau untuk Dinas Perikanan dan Peternakan Kabupaten Banyumas
    var greenIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var customTooltip = L.divIcon({ className: 'custom-tooltip', offset: [0, -10] });

    kelompokData.forEach(function(kelompok) {
        var koordinat = kelompok.koordinat_lokasi.split(',');
        var lat = parseFloat(koordinat[0].trim());
        var lng = parseFloat(koordinat[1].trim());

        var marker = L.marker([lat, lng]).addTo(map)
            .bindTooltip('<b>' + kelompok.nama_kelompok + '</b>', {className: 'custom-tooltip', offset: [0, -10] });

        layerGroup.addLayer(marker);

        marker.on('click', function() {
            tampilkanModalDetail(kelompok);
        });

        @auth
    marker.on('contextmenu', function(e) {
        e.originalEvent.preventDefault();

        Swal.fire({
            title: 'Pilih Aksi',
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonText: 'Edit',
            denyButtonText: 'Hapus',      // Tombol deny
            cancelButtonText: 'Batal',   // Tombol cancel
            customClass: {
                confirmButton: 'btn btn-primary',  // Warna biru untuk Edit
                denyButton: 'btn btn-danger',      // Warna merah untuk Hapus
                cancelButton: 'btn btn-secondary' // Warna abu-abu untuk Cancel
            }
        }).then((result) => {
            if (result.isConfirmed) {
                tampilkanModalEdit(kelompok);  // Jika Edit dipilih
            } else if (result.isDenied) {
                konfirmasiHapus(kelompok);     // Jika Hapus dipilih
            }
        // Tidak perlu menambahkan kode untuk cancelButton, karena pop-up otomatis tertutup
        });
    });
    @endauth
        markers.push({ marker: marker, kelompok: kelompok });
    });

    function tampilkanModalDetail(kelompok) {
        $('#detail_nama_kelompok').text(kelompok.nama_kelompok);
        $('#detail_alamat').text(kelompok.alamat);
        $('#detail_jumlah_anggota').text(kelompok.jumlah_anggota);
        $('#detail_nama_ketua_kelompok').text(kelompok.nama_ketua_kelompok);
        $('#detail_nomor_hp').text(kelompok.nomor_hp);
        $('#detail_koordinat_lokasi').text(kelompok.koordinat_lokasi);
        $('#detail_jenis_budidaya').text(kelompok.jenis_budidaya);
        $('#detail_jenis_komoditas').text(kelompok.jenis_komoditas);
        $('#detail_tanggal_sk').text(kelompok.tanggal_sk);
        $('#detail_luas_lahan').text(kelompok.luas_lahan);
        $('#detail_produksi_siklus').text(kelompok.produksi_siklus);
        $('#detail_siklus_tahun').text(kelompok.siklus_tahun);
        $('#detail_bantuan').text(kelompok.bantuan);

        $('#detailModal').modal('show');
    }

    function tampilkanModalEdit(kelompok) {
        window.location.href = '/edit/' + kelompok.id;
    }

    function konfirmasiHapus(kelompok) {
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
                    url: '/kelompok/' + kelompok.id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                        map.removeLayer(markers.find(m => m.kelompok.id === kelompok.id).marker);
                    },
                    error: function() {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                    }
                });
            }
        });
    }

    // Fungsi untuk pencarian dan zoom
    $('#searchInput').on('input', function() {
        var searchQuery = $(this).val().toLowerCase();
        var searchCriteria = $('#searchCriteria').val();
        var found = false;

        if (searchQuery === "") {
            // Reset to initial view and show all markers
            map.setView(initialView.center, initialView.zoom);
            markers.forEach(function(item) {
            layerGroup.addLayer(item.marker);
        });
        } else {
            markers.forEach(function(item) {
                var kelompok = item.kelompok;
                var isMatch = false;

                if (searchCriteria === 'nama_kelompok') {
                    isMatch = kelompok.nama_kelompok.toLowerCase().includes(searchQuery);
                } else if (searchCriteria === 'alamat') {
                    isMatch = kelompok.alamat.toLowerCase().includes(searchQuery);
                } else if (searchCriteria === 'jenis_budidaya') {
                    isMatch = kelompok.jenis_budidaya && kelompok.jenis_budidaya.toLowerCase().includes(searchQuery);
                } else if (searchCriteria === 'jenis_komoditas') {
                    isMatch = kelompok.jenis_komoditas && kelompok.jenis_komoditas.toLowerCase().includes(searchQuery);
                }

                if (isMatch) {
                    layerGroup.addLayer(item.marker);
                    if (!found) {
                        map.setView(item.marker.getLatLng(), 15); // Zoom to the first found location
                        found = true;
                    }
                } else {
                    layerGroup.removeLayer(item.marker);
                }
            });
        }
    });
    </script>
</body>
</html>