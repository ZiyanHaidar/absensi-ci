<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <a href="<?php echo base_url('admin') ?>">
                    <i class="fas fa-chart-line mr-2"></i> Dashboard
                </a>
                <a href="<?php echo base_url('admin/siswa') ?>">
                    <i class="fas fa-user mr-2"></i> Siswa
                </a>
                <a href="<?php echo base_url('admin/akun') ?>">
                    <i class="fas fa-chalkboard mr-2"></i> Akun
                </a>
                <a type="button" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt text-danger">LogOut</i>
                </a>
            </div>

            <div id="content" role="main">
                <div class="card mb-4 shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h1>Ubah Akun</h1>

                    </div>
                </div>

                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">


                            <?php foreach ($user as $users): ?>

                            <form action="<?php echo base_url('auth/aksi_ubah_password'); ?>" method="post"
                                class="grid grid-cols-2 gap-4">
                                <input name="id" type="hidden" value="<?php echo $users->id ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Masukkan Email Anda" value="<?php echo $users->email ?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Masukkan Username Anda"
                                                value="<?php echo $users->username ?>" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passwordbaru">Password Baru</label>
                                            <input type="password" class="form-control" id="passwordbaru"
                                                name="passwordbaru" placeholder="Masukkan Password Baru Anda" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="konfirmasi_password">Konfirmasi Password</label>
                                            <input type="konfirmasi_password" class="form-control"
                                                id="konfirmasi_password" name="konfirmasi_password"
                                                placeholder="Masukkan Password Anda" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>


                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

            <!-- SweetAlert untuk berhasil mengubah siswa -->
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

            <!-- SweetAlert untuk gagal mengubah siswa -->
            <?php if ($this->session->flashdata('error')): ?>
            <script>
            Swal.fire({
                icon: 'error',
                title: '<?= $this->session->flashdata('error') ?>',
                showConfirmButton: false,
                timer: 1500
            });
            </script>
            <?php endif; ?>
</body>

</html>