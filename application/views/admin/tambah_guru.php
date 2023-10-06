<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Guru</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
    body {
        display: flex;

        margin: 0;
        min-height: 100vh;
        background-color: #61677A;

    }

    #sidebar {
        background-color: #272829;

        color: #fff;
        height: 100%;
        width: 250px;
        position: fixed;
        left: 0;
        top: 0;
        transition: 0.3s;
        padding-top: 20px;
    }

    #sidebar a {
        padding: 10px 15px;
        text-decoration: none;
        color: #fff;
        display: block;
    }

    #sidebar a:hover {
        background-color: black;

    }

    #content {
        flex: 1;
        margin-left: 250px;
        transition: 0.3s;
        padding: 20px;
    }

    @media screen and (max-width: 788px) {
        #sidebar {
            width: 100%;
            position: static;
            height: auto;
            margin-bottom: 20px;
        }

        #content {
            margin-left: 0;
        }
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-md-3 col-lg-2 d-md-block">
                <a href="<?php echo base_url('admin/siswa') ?>">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>

            </div>

            <div id="content" role="main">
                <div class="card mb-4 shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h1>Tambah Guru</h1>

                    </div>
                </div>

                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/aksi_Tambah_guru') ?>" enctype="multipart/form-data"
                            method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Guru</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama Guru" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nisn">NIK</label>
                                        <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NIK"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option selected>Pilih Gender</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <label for="mapel">Mapel</label>
                                    <select class="form-control" id="mapel" name="mapel" required>
                                        <option selected>Pilih Mapel</option>
                                        <?php foreach ($mapel as $row): ?>
                                        <option value="<?php echo $row->id ?>">
                                            <?php echo $row->nama_mapel ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <?php if ($this->session->flashdata('success')): ?>
        <script>
        Swal.fire({
            icon: 'success',
            title: '<?= $this->session->flashdata('success') ?>',
            showConfirmButton: false,
            timer: 1500
        });
        </script>
        <?php endif; ?>
</body>

</html>