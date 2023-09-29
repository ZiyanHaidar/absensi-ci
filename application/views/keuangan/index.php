<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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

<body class="flex h-screen bg-gray">
    <!-- Sidebar -->
    <div id="sidebar" class="col-md-3 col-lg-2 d-md-block">
        <a href="<?php echo base_url('keuangan') ?>">
            <i class="fas fa-wallet mr-2"></i> Keuangan
        </a>
        <a href="<?php echo base_url('keuangan/pembayaran') ?>">
            <i class="fas fa-money-bill mr-2"></i> pembayaran
        </a>


        <a type="button" onclick="confirmLogout()">
            <i class="fas fa-sign-out-alt text-danger" style="color:red">LogOut</i>
        </a>
    </div>
    <div id="content" role="main">
        <header class="flex justify-between items-center p-2 bg-white border-b-2 border-gray-200">
            <h1 class="text-4xl">Keuangan</h1>
            <div class="flex items-center space-x-2">

            </div>
        </header>
        <br>
        <div class="card mb-4 shadow">
            <div class="card-body">


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-white border p-6 rounded-lg relative">

                        <p class="text-black mb-2">Jumlah Pembayaran SPP</p>
                        <p class="text-black text-2xl font-bold">
                            Rp.120.000
                        </p>
                        <br>
                        <i class="fas fa-coins text-gray-600 text-6xl absolute right-4 top-12"></i>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white border p-6 rounded-lg relative">
                        <i class="fas fa-coins text-gray-600 text-6xl absolute right-4 top-12"></i>
                        <p class="text-black mb-2">Jumlah Pembayaran Uang Gedung</p>
                        <p class="text-black text-2xl font-bold">
                            Rp.1.500.000
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white border p-6 rounded-lg relative">
                        <i class="fas fa-coins text-gray-600 text-6xl absolute right-4 top-12"></i>
                        <p class="text-black mb-2">Jumlah Pembayaran Uang Seragam</p>
                        <p class="text-black text-2xl font-bold">
                            Rp.500.000
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- LOGOUT -->
    <script>
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin mau LogOut?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('/') ?>";
            }
        });
    }
    </script>
    <script>
    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        var content = document.getElementById("content");
        sidebar.style.width = sidebar.style.width === "250px" ? "0" : "250px";
        content.style.marginLeft = content.style.marginLeft === "250px" ? "0" : "250px";
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>