<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Absensi and Izin</title>
    <style>
    body {
        padding: 50px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Absensi</h2>
        <form action="absensi.php" method="post">
            <div class="form-group">
                <label for="kegiatan">Kegiatan:</label>
                <textarea class="form-control" id="kegiatan" name="kegiatan" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Absensi</button>
        </form>

        <h2>Izin</h2>
        <form action="izin.php" method="post">
            <div class="form-group">
                <label for="keterangan">Keterangan Izin:</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Izin</button>
        </form>
    </div>
</body>

</html>