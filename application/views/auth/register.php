<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    body {
        top: 0;
        left: 0;
        margin: 0;
        padding: 0;
        font-family: 'Montserrat', sans-serif;
    }


    .full-bg {
        background-color: #1450A3;
        background-position: center center;
        background-size: cover;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        z-index: -99;
        transition: all 0.3s ease-in;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .card {
        width: 350px;
        background-color: rgba(255, 255, 255, 0.3);
        border-radius: 15px;
        padding: 40px;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    h2 {
        color: #111;
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        color: #111;
        margin-bottom: 5px;
    }

    input,
    select,
    option {
        padding: 10px;
        margin-bottom: 10px;
        border: none;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.8);
    }

    button {
        padding: 10px;
        background-color: #fff;
        color: #498ffc;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #70c1ff;
    }

    @media (max-width: 480px) {
        .card {
            width: 100%;
            max-width: 350px;
        }
    }

    a {
        color: #498ffc;
        /* Warna teks tautan */
        text-decoration: none;
        /* Menghilangkan garis bawah tautan */
        font-weight: bold;
        /* Ketebalan teks tautan */
    }

    a:hover {
        color: #70c1ff;
        /* Warna teks tautan saat dihover */
    }

    .login-link a {
        color: #498ffc;
        text-decoration: none;
        font-weight: bold;
    }

    .login-link a:hover {
        color: #70c1ff;
    }
    </style>
</head>

<body class="body d-flex align-items-center justify-content-center">
    <div class="full-bg">
        <div class="container">
            <div class="card">
                <h4 class="card-header text-center mb-4" style="color:yellow">Register Karyawan</h4>
                <form action="<?php echo base_url('auth/aksi_register'); ?>" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" class="form-control form-control-sm"
                            placeholder="Masukkan username" class="form-control" name="username"
                            class="block mb-2 text-sm" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control form-control-sm"
                            placeholder="Masukkan email Anda" class="form-control" name="email"
                            class="block mb-2 text-sm" required>
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
                            class="form-control form-control-sm" placeholder="Masukkan kata sandi Anda"
                            class="form-control" name="password" required>
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