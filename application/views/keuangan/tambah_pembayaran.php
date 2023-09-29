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

                <a href="<?php echo base_url('keuangan/Pembayaran') ?>">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>


            </div>

            <div id="content" role="main">
                <div class="card mb-4 shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h1>Tambah Pembayaran</h1>

                    </div>
                </div>

                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <form action="<?php echo base_url('keuangan/aksi_tambah_pembayaran') ?>"
                            enctype="multipart/form-data" method="POST" class="grid grid-cols-2 gap-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Siswa</label>
                                        <select id="siswa" name="siswa" class="form-control" required>
                                            <option selected>Pilih Siswa</option>
                                            <?php foreach ($siswa as $row): ?>
                                            <option value="<?php echo $row->id_siswa ?>">
                                                <?php echo $row->nama_siswa ?>
                                            </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pembayaran">Pembayaran</label>
                                        <select class="form-control" id="pembayaran" name="pembayaran" required>
                                            <option selected>
                                                Pilih Pembayaran
                                            </option>
                                            <option value="Pembayaran SPP">Pembayaran SPP</option>
                                            <option value="Pembayaran Uang Gedung">Pembayaran Uang Gedung</option>
                                            <option value="Pembayaran Uang Seragam">Pembayaran Uang Seragam</option>

                                        </select>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total">Total Pembayaran</label>
                                        <input type="text" class="form-control" id="total" name="total"
                                            placeholder="Masukkan total" required>
                                    </div>
                                </div>

                            </div>

                    </div>
                    <button type="submit" class="btn btn-warning">
                        Tambah Pembayaran
                    </button>
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