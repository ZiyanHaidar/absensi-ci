<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        top: 0;
        left: 0;
        margin: 0;
        padding: 0;
        font-family: 'Montserrat', sans-serif;
    }



    .full-bg {
        background-image: url(https://c4.wallpaperflare.com/wallpaper/700/96/937/space-stars-lights-star-wallpaper-preview.jpg);
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

    .login-button {
        display: inline-block;
        padding: 15px 30px;
        background-color: #FFA500;
        /* Warna latar belakang */
        color: #fff;
        /* Warna teks */
        border-radius: 10px;
        /* Sudut-sudut melengkung */
        text-decoration: none;
        text-align: center;
        font-size: 10px;
        border: none;
        cursor: pointer;
    }

    .login-button:hover {
        background-color: #FFD700;
    }
    </style>
</head>

<body>
    <!DOCTYPE html>
    <html lang="id">

    <head>


    <body>
        <div class="container">
            <div class="card">
                <h5 class="card-header mx-auto">Registrasi</h5>
                <form action="<?php echo base_url('auth/aksi_register'); ?>" method="post">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="Masukkan username" class="form-control"
                        name="username" class="block mb-2 text-sm" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Masukkan email Anda" class="form-control" name="email"
                        class="block mb-2 text-sm" required>

                    <label for="first_name">Nama Depan</label>
                    <input type="text" id="first_name" placeholder="Masukkan nama depan Anda" class="form-control"
                        name="first_name" class="block mb-2 text-sm" required>

                    <label for="last_name">Nama Belakang</label>
                    <input type="text" id="last_name" placeholder="Masukkan nama belakang Anda" class="form-control"
                        name="last_name" class="block mb-2 text-sm" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Masukkan kata sandi Anda" class="form-control"
                        name="password" class="block mb-2 text-sm" required>
                    <small style="color:red">Kata sandi minimal harus 8 karakter!</small>

                    <label for="image">Profil</label>
                    <input type="file" class="form-control" id="image" name="image">

                    <button type="submit" class="btn btn-primary text-bg-info">Register</button>
                </form>
                <p style="text-align: center; margin-top: 10px;">
                    Sudah punya akun? </p><a href="./" class="login-button">Login</a>

            </div>
        </div>

    </body>

    </html>