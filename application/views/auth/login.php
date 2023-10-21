<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <h2 class="card-header text-center mb-4" style="color:yellow">Login</h2>
                <form action="<?php echo base_url('auth/aksi_login'); ?>" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control form-control-sm"
                            placeholder="Masukkan email Anda" class="form-control" name="email"
                            class="block mb-2 text-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" minlength="8"
                            class="form-control form-control-sm" placeholder="Masukkan kata sandi Anda"
                            class="form-control" name="password" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-warning btn-block ">Login</button>
                </form>
                <br>
                <p>Belum punya akun?</p>
                <a href="<?php echo base_url('auth/register'); ?>" class="btn btn-success">Register Karyawan</a>

            </div>
        </div>
</body>

</html>