<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .ddd {
        text-align: center;
        color: yellow;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: white;
    }

    .centered {
        text-align: center;
    }

    .login-button {
        display: inline-block;
        padding: 15px 30px;
        background-color: #3498db;
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

    .login-butto {
        display: inline-block;
        padding: 15px 30px;
        background-color: #FFA500;
        color: #fff;
        border-radius: 10px;
        text-decoration: none;
        text-align: center;
        font-size: 10px;
        border: none;
        cursor: pointer;

    }

    .login-button:hover {
        background-color: blue;
    }

    .login-butto:hover {
        background-color: #FFD700;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="card mt-5 w-50 justify-content-center mx-auto">
        <h1 class="text-center">Welcome</h1>
        <a href="auth/register" class="login-button">REGISTER KARYAWAN</a>
        <br>

    </div>
    <div class="card mt-5 w-50 justify-content-center mx-auto">
        <a href="./auth" class="login-butto">LOGIN</a>
    </div>


</body>

</html>