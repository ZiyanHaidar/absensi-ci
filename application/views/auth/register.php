<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .body {
        height: 100vh;
        margin: 0;
        background-color: #1450A3;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        background-color: #337CCF;
    }


    .card-header {
        border-radius: 15px 15px 0 0;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-success:hover,
    .btn-info:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .text-danger {
        font-size: 14px;
    }

    .card-title {
        font-size: 2rem;
        color: #FFA500;
    }

    .form-control-sm {
        height: 30px;
    }
    </style>
</head>

<body class="body">
    <div class="container">
        <div class="card">
            <h5 class="card-header text-center card-title mb-4">Registrasi Karyawan</h5>
            <form action="<?php echo base_url('auth/aksi_register'); ?>" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control form-control-sm"
                        placeholder="Masukkan username" class="form-control" name="username" class="block mb-2 text-sm"
                        required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control form-control-sm"
                        placeholder="Masukkan email Anda" class="form-control" name="email" class="block mb-2 text-sm"
                        required>
                </div>

                <div class="form-group">
                    <label for="nama_depan">Nama Depan</label>
                    <input type="text" id="nama_depan" class="form-control form-control-sm"
                        placeholder="Masukkan nama depan Anda" class="form-control" name="nama_depan"
                        class="block mb-2 text-sm" required>
                </div>

                <div class="form-group">
                    <label for="nama_belakang">Nama Belakang</label>
                    <input type="text" id="nama_belakang" class="form-control form-control-sm"
                        placeholder="Masukkan nama belakang Anda" class="form-control" name="nama_belakang"
                        class="block mb-2 text-sm" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" minlength="8"
                        class="form-control form-control-sm" placeholder="Masukkan kata sandi Anda" class="form-control"
                        name="password" required>
                    <small class="text-warning">*Kata sandi minimal harus 8 karakter!</small>
                </div>


                <button type="submit" class="btn btn-warning btn-block ">Register</button>
            </form>
            <p class="text-center mt-3">Sudah punya akun? <a href="<?php echo base_url('auth'); ?>"
                    class="btn btn-info btn-sm">Login</a></p>
        </div>
    </div>


</body>

</html>