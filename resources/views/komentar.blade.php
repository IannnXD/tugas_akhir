<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Komentar {{ $foto->judulFoto }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <a class="btn btn-primary" href="/dashboard">back</a>
        <!-- Tampilkan Foto -->
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <img src="{{ asset($foto->lokasifile) }}" alt="{{ $foto->judulFoto }}" class="img-fluid">
            </div>
        </div>

        <!-- Tambah Komentar Form -->
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <form action="{{ route('komentar.store', $foto->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="komentar">Komentar:</label>
                        <textarea id="komentar" name="komentar" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah Komentar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tampilkan Komentar -->
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                @foreach ($komentar as $k)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $k->NamaKomentar }}</h5>
                            <p class="card-text">{{ $k->komentar }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
