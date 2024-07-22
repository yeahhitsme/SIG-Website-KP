<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Persebaran Pokdakan Kabupaten Banyumas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        #map { height: 450px; }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff;
        }
        .dropdown-menu {
            right: 0;
            left: auto;
        }
        @media (max-width: 767px) {
            .search-container {
                flex-direction: column;
            }
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
            <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarToggle">
                <div class="navbar-text">
                    <span class="mr-3">
                        <a class="navbar-brand" href="#">Data Persebaran Pokdakan Kabupaten Banyumas</a>
                    </span>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="navbar-toggler-icon"></span>
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
            <div class="col-12 text-center">
                <div class="search-container d-flex justify-content-center">
                    <select id="searchCriteria" class="form-control mb-3" style="max-width: 200px;">
                        <option value="nama_kelompok">Nama Kelompok</option>
                        <option value="alamat">Alamat</option>
                    </select>
                    <input type="text" id="searchInput" class="form-control mb-3 ml-2 flex-grow-1" placeholder="Cari..." style="max-width: 500px;">
                </div>
            </div>
            <div class="col-12">
                <div id="map" class="mt-4"></div>
                <div class="text-center mt-4">
                    <a href="/input" class="btn btn-primary mb-4">Tambah Data Kelompok</a>
                </div>
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
                            <label>Tahun Terakhir Menerima Bantuan:</label>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js"></script>
    <script>
    var initialView = {
        center: [-7.42751, 109.22631],
        zoom: 14
    };

    var map = L.map('map').setView(initialView.center, initialView.zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var kelompokData = @json($kelompokData);

    var markers = [];

    kelompokData.forEach(function(kelompok) {
        var koordinat = kelompok.koordinat_lokasi.split(',');
        var lat = parseFloat(koordinat[0].trim());
        var lng = parseFloat(koordinat[1].trim());

        var marker = L.marker([lat, lng]).addTo(map)
            .bindTooltip('<b>' + kelompok.nama_kelompok + '</b>', { permanent: true, className: 'custom-tooltip', offset: [0, -10] });

        marker.on('click', function() {
            tampilkanModalDetail(kelompok);
        });

        marker.on('contextmenu', function(e) {
            e.originalEvent.preventDefault();

            Swal.fire({
                title: 'Pilih Aksi',
                showCancelButton: true,
                confirmButtonText: `Edit`,
                cancelButtonText: `Batal`
            }).then((result) => {
                if (result.isConfirmed) {
                    tampilkanModalEdit(kelompok);
                } else if (result.isDenied) {
                    konfirmasiHapus(kelompok);
                }
            });
        });

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

    // Fungsi untuk pencarian dan zoom
    $('#searchInput').on('input', function() {
        var searchQuery = $(this).val().toLowerCase();
        var searchCriteria = $('#searchCriteria').val();
        var found = false;

        if (searchQuery === "") {
            // Reset to initial view and show all markers
            map.setView(initialView.center, initialView.zoom);
            markers.forEach(function(item) {
                item.marker.addTo(map);
            });
        } else {
            markers.forEach(function(item) {
                var kelompok = item.kelompok;
                var isMatch = false;

                if (searchCriteria === 'nama_kelompok') {
                    isMatch = kelompok.nama_kelompok.toLowerCase().includes(searchQuery);
                } else if (searchCriteria === 'alamat') {
                    isMatch = kelompok.alamat.toLowerCase().includes(searchQuery);
                } 

                if (isMatch) {
                    item.marker.addTo(map);
                    if (!found) {
                        map.setView(item.marker.getLatLng(), 15); // Zoom to the first found location
                        found = true;
                    }
                } else {
                    map.removeLayer(item.marker);
                }
            });
        }
    });
    </script>
</body>
</html>
