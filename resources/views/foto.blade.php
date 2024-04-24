<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <h4 class="text-center">Tambah Foto</h4>
                <br>
                <form action="/foto/post" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judulFoto" class="form-label">Judul Foto</label>
                        <input type="text" name="judulFoto" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control">
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="album_id" class="form-label">Pilih Album</label>
                        <select class="form-select" id="album_id" name="album_id" required>
                            @foreach ($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->namaAlbum }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="lokasifile" class="form-label">File Foto</label>
                        <input type="file" name="lokasifile" class="form-control">
                    </div>
                    <br>
                    <button class="btn btn-secondary w-100" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
