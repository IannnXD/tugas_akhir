<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Album</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <h4 class="text-center">Tambah Album</h4>
                <br>
                <form action="/album/post" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="namaAlbum" class="form-label">Judul Album</label>
                        <input type="text" name="namaAlbum" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control">
                    </div>
                    <br>
                    <button class="btn btn-secondary w-100" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
