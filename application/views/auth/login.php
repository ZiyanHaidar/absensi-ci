<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    .body {
        height: 100vh;
        margin: 0;
    }

    .card {
        border-radius: 15px;
        background-color: #CDFAD5;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-size: 2rem;
        color: #FFA500;
    }

    .btn-warning {
        background-color: #FFA500;
        border-color: #FFA500;
    }

    .btn-warning:hover {
        background-color: #FFD700;
        border-color: #FFD700;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .form-control-sm {
        height: 30px;
    }
    </style>
</head>


<body class="body d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="card p-4 text-center">
            <h5 class="card-header text-center card-title mb-4">Login</h5>
            <form action="<?php echo base_url(); ?>auth/aksi_login" method="post">
                <div class="mb-3">
                    <input type="email" class="form-control form-control-sm" name="email" id="email"
                        placeholder="Masukan Email Anda" autocomplete="on" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control form-control-sm" name="password" id="password"
                        placeholder="Masukan Password Anda" autocomplete="off" required>
                </div>
                <button type="submit" class="btn btn-warning btn-block">Login</button>
            </form>
            <div class="mt-3">
                <p>Belum punya akun?</p>
                <a href="<?php echo base_url('auth/register'); ?>" class="btn btn-success me-2">Register Karyawan</a>
                <a href="<?php echo base_url('auth/register_admin'); ?>" class="btn btn-danger">Register Admin</a>
            </div>
        </div>
    </div>
</body>

</html>