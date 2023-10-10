<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="body">
    <div class="container ">

        <div class="card mt-5 w-50 justify-content-center mx-auto">

            <h5 class="card-header mx-auto">Login</h5>
            <div class="card-body">
                <form action="<?php echo base_url(); ?>auth/aksi_login" method="post" class="space-y-12">
                    <div class="mb-3">
                        <label for="email" class="block mb-2 text-sm">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Input your email"
                            aria-describedby="emailHelp">
                        <br>
                        <div class="flex justify-between mb-2">
                            <label for="password" class="text-sm">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Input your password" autocomplete="off">

                        </div>

                        <div class="d-grid gap-2 col-6 mx-auto">

                            <button type="submit" class="btn btn-primary text-bg-info">Login</button>

                            <p style="text-align: center; margin-top: 10px;">
                                Belum punya akun? <a href="<?php echo base_url('auth/register'); ?>"
                                    class="login-button">Register Karyawan</a><a
                                    href="<?php echo base_url('auth/registerr'); ?>" class="login-button">Register
                                    Admin</a></p>
                </form>
            </div>
        </div>
    </div>
    </div>

</body>

</html>