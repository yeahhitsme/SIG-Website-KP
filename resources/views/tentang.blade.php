<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <style>
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
        p {
            text-align: justify;
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
                <h1 class="text-center">Tentang Website</h1>
                <p id="dynamic-content">{{ $tentangContent }}</p>
                @auth
                <button class="btn btn-primary" onclick="showEditModal()">Edit</button>
                @endauth
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Konten Tentang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea id="content" class="form-control" rows="10">{{ $tentangContent }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="updateContent()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <script>
        function showEditModal() {
            $('#editModal').modal('show');
        }

        function updateContent() {
            const content = $('#content').val();

            $.ajax({
                url: '/tentang/update',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    content: content
                },
                success: function(response) {
                    $('#dynamic-content').text(content);
                    $('#editModal').modal('hide');
                    Swal.fire('Sukses', 'Konten berhasil diperbarui', 'success');
                },
                error: function() {
                    Swal.fire('Gagal', 'Terjadi kesalahan', 'error');
                }
            });
        }
    </script>
</body>
</html>
