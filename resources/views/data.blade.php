<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Style yang sama seperti sebelumnya */
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
        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0 5px;
        }
        .icon-btn.edit {
            color: #ffc107;
        }
        .icon-btn.edit:hover {
            color: #e0a800;
        }
        .icon-btn.delete {
            color: #dc3545;
        }
        .icon-btn.delete:hover {
            color: #c82333;
        }
        .icon-btn.print {
            color: #28a745;
        }
        .icon-btn.print:hover {
            color: #218838;
        }
        .actions {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .btn-delete-selected, .btn-print {
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        .btn-delete-selected {
            background-color: #dc3545;
        }
        .btn-delete-selected svg {
            color: #000;
        }
        .btn-delete-selected:hover {
            background-color: #c82333;
        }
        .btn-print {
            background-color: #28a745;
        }
        .btn-print svg {
            color: #fff;
        }
        .btn-print:hover {
            background-color: #218838;
        }
        .selected-data {
            display: none; /* Initially hidden */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="btn-back" href="{{ url('/') }}">
            <i class="fas fa-arrow-left"></i> <!-- Icon previous page -->
        </a>
        <span class="navbar-text">
            Kelola Data
        </span>
    </nav>

    <div class="container mt-3">
        <div class="d-flex justify-content-between mb-3">
            <input type="text" id="searchInput" class="form-control mr-2" style="width: 300px;" placeholder="Cari...">
            <div>
                <button id="btnPrint" class="btn-print">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M3 0h10a1 1 0 0 1 1 1v3H2V1a1 1 0 0 1 1-1zM2 4v1h12V4H2zm12 2H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h1v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm-4 9H6v-1h4v1zm3-3H3v-2h8v2z"/>
                    </svg>
                </button>
                <button id="btnDeleteSelected" class="btn-delete-selected">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                        <path d="M3.5 1a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1V2H3.5V1zM1 2v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2H1z"/>
                        <path fill-rule="evenodd" d="M2 5h12v9a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5zm4.5 0h3v9a.5.5 0 0 1-1 0V5H7v9a.5.5 0 0 1-1 0V5H5v9a.5.5 0 0 1-1 0V5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H6.5V1z"/>
                    </svg>
                </button>
            </div>
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
                <tbody id="tableBody">
                    @foreach ($kelompokData as $kelompok)
                    <tr data-id="{{ $kelompok->id }}">
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
                        <td class="actions">
                            <button class="icon-btn edit" onclick="editData({{ $kelompok->id }})">✎</button>
                            <button class="icon-btn delete" onclick="deleteData({{ $kelompok->id }})">🗑️</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    $(document).ready(function() {
        var selectedIds = [];

        // Restore previously selected checkboxes
        function restoreSelectedCheckboxes() {
            $('.select-item').each(function() {
                if (selectedIds.includes($(this).val())) {
                    $(this).prop('checked', true);
                }
            });
            updateSelectAllCheckbox();
        }

        // Save selected checkboxes
        function saveSelectedCheckboxes() {
            selectedIds = $('.select-item:checked').map(function() {
                return $(this).val();
            }).get();
        }

        // Clear selected checkboxes
        function clearSelectedCheckboxes() {
            $('.select-item').prop('checked', false);
            selectedIds = [];
            updateSelectAllCheckbox();
        }

        // Search and filter
        $('#searchInput').on('input', function() {
            var searchText = $(this).val().toLowerCase();
            $('tbody tr').each(function() {
                var row = $(this);
                var text = row.text().toLowerCase();
                var isVisible = text.indexOf(searchText) !== -1;
                row.toggle(isVisible);
            });

            clearSelectedCheckboxes(); // Clear selected checkboxes when searching
        });

        // Header checkbox to select all
        $('#selectAll').on('change', function() {
            var isChecked = $(this).prop('checked');
            $('.select-item:visible').prop('checked', isChecked);
            saveSelectedCheckboxes(); // Save selected checkboxes
        });

        // Update header checkbox status based on search results
        function updateSelectAllCheckbox() {
            var allVisibleChecked = $('.select-item:visible').length === $('.select-item:visible:checked').length;
            $('#selectAll').prop('checked', allVisibleChecked);
        }

        // Select individual items
        $('.select-item').on('change', function() {
            saveSelectedCheckboxes(); // Save selected checkboxes
            updateSelectAllCheckbox();
        });

        // Print Button
        $('#btnPrint').on('click', function() {
            if ($('.select-item:checked').length === 0) {
                Swal.fire('Peringatan', 'Tidak ada data yang dipilih untuk dicetak', 'warning');
                return;
            }

            var printWindow = window.open('', '', 'height=600,width=800');
            var content = '<html><head><title>Cetak Data</title>';
            content += '<style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid black; padding: 8px; text-align: left; } th { background-color: #f2f2f2; }</style>';
            content += '</head><body>';
            content += '<table><thead><tr><th>Nama Kelompok</th><th>Alamat</th><th>Jumlah Anggota</th><th>Nama Ketua Kelompok</th><th>Nomor HP</th><th>Koordinat Lokasi</th><th>Jenis Budidaya</th><th>Jenis Komoditas</th><th>Tanggal SK</th><th>Luas Lahan</th><th>Produksi/Siklus</th><th>Siklus/Tahun</th><th>Bantuan</th></tr></thead><tbody>';

            $('.select-item:checked').each(function() {
                var id = $(this).val();
                var row = $('tbody tr').filter(function() {
                    return $(this).find('.select-item').val() === id;
                });
                var cells = row.find('td').not(':first').map(function() {
                    return '<td>' + $(this).text() + '</td>';
                }).get().join('');
                content += '<tr>' + cells + '</tr>';
            });

            content += '</tbody></table></body></html>';

            printWindow.document.open();
            printWindow.document.write(content);
            printWindow.document.close();

            // Call print after the window finishes loading
            printWindow.onload = function() {
                printWindow.print();
                printWindow.close();
            };
        });

        // Hapus Data Terpilih
        $('#btnDeleteSelected').on('click', function() {
            var selectedIds = $('.select-item:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length === 0) {
                Swal.fire('Peringatan', 'Tidak ada data yang dipilih untuk dihapus', 'warning');
                return;
            }

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data yang dipilih?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("kelompok.destroyMultiple") }}',
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: selectedIds
                        },
                        success: function(response) {
                            Swal.fire('Berhasil', 'Data berhasil dihapus', 'success');
                            location.reload();
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus data', 'error');
                        }
                    });
                }
            });
        });

        // Restore selected checkboxes on document load
        restoreSelectedCheckboxes();
    });

    // Edit and Delete data functions triggered by action buttons
    function editData(id) {
        window.location.href = '/edit/' + id;
    }

    // Hapus Data Per Baris
function deleteData(id) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/kelompok/' + id,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire('Berhasil', 'Data berhasil dihapus', 'success');
                    location.reload();
                },
                error: function(xhr) {
                    Swal.fire('Error', 'Terjadi kesalahan saat menghapus data', 'error');
                }
            });
        }
    });
}
</script>
</body>
</html>