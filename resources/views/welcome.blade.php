<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery Foto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="/">Gallery Foto</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/album">Album</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/foto">Foto</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar-nav ms-auto">
                    @guest
                        <a href="/login" class="btn btn-primary" style="margin-right: 10px;">Login</a>
                        <a href="/register" class="btn btn-secondary">Register</a>
                    @else
                        <a href="{{ route('logout') }}" class="btn btn-info">Logout</a>

                    @endguest
                </div>
            </div>
        </nav>
    </header>
    <div class="container mt-4">
        <div class="row">
            @foreach ($fotos as $photo)
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark">
                        <div class="position-relative">
                            <form action="{{ route('delete.potos', ['id' => $photo->id]) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-primary btn-sm position-absolute top-0 start-0 mt-2 ms-2"
                                    onclick="confirmDelete({{ $photo->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>

                            <img src="{{ asset($photo->lokasifile) }}" class="card-img-top" alt="...">
                        </div>

                        <div class="card-body text-white">
                            <h5 class="card-title text-white">{{ $photo->judulFoto }}</h5>
                            <p class="card-text text-white">{{ $photo->deskripsi }}</p>
                            <div class="col d-flex justify-content-start ">
                                <p class="card-text" style="margin-right: 15px;">{{ $likeCount[$photo->id] }} Likes</p>
                            </div>
                        </div>
                        <div class="card-footer d-flex ">
                            <form action="{{ route('like', ['id' => $photo->id]) }}" method="POST"
                                style="margin-right: 5px;">
                                @csrf
                                <input type="hidden" name="foto_id" value="{{ $photo->id }}">
                                <button type="submit" class="btn btn-secondary"><i
                                        class="far fa-thumbs-up"></i></button>
                            </form>
                            <a href="{{ route('komentar', ['id' => $photo->id]) }}" class="btn btn-light"><i
                                    class="far fa-comment"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Bootstrap JS (optional, for dropdowns and other features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
