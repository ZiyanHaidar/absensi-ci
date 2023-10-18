<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
    body {
        display: flex;

        margin: 0;
        min-height: 100vh;
        background-color: #61677A;

    }

    #sidebar {
        background-color: #0C134F;

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
        font-size: 20px;
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

    .card {

        text-align: center;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
        border-radius: 5px;

    }



    .profile-details {
        background: none;
    }

    .profile-details {
        width: 78px;
    }



    .profile-details img {
        height: 52px;
        width: 52px;
        object-fit: cover;
        border-radius: 20px;

        background: #1d1b31;
    }

    .profile-details .profile_name,
    .profile-details .job {
        color: #6699ff;
        font-size: 18px;

    }



    .profile-details .job {
        font-size: 12px;
    }

    /* CSS untuk card */
    .card {
        border: 1px solid #6699ff;
        border-radius: 10px;

        max-width: 1200px;
        text-align: center;

    }

    /* CSS untuk gambar profil */
    .card img {
        width: 100px;
        /* Sesuaikan ukuran gambar profil sesuai kebutuhan Anda */
        height: 100px;
        object-fit: cover;
        border: 2px solid #6699ff;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    /* CSS untuk judul card (username) */
    .card h5 {
        margin: 0;
        font-size: 1.5em;
    }

    /* CSS untuk informasi tambahan */
    .card p {
        font-size: 1em;
        color: #555;
    }

    /* CSS untuk membuat tata letak responsif */
    @media (max-width: 767px) {

        /* Misalnya, pada layar dengan lebar kurang dari atau sama dengan 767px */
        .card {
            max-width: 100%;
            /* Lebar kartu akan mengisi seluruh lebar tata letak */
        }

        .card img {
            width: 80px;
            /* Ukuran gambar profil lebih kecil pada layar kecil */
            height: 80px;
        }

        .card p {
            font-size: 10px;
            /* Ukuran font lebih kecil pada layar kecil */
        }
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-md-3 col-lg-2 d-md-block">
                <h3> <i class="fas fa-chart-line mr-2"></i> Dashboard</h3>
                <a href="<?php echo base_url('karyawan') ?>"><i class="fas fa-user-tie mr-2"></i>
                    Karyawan
                </a>
                <a href="<?php echo base_url('karyawan/history') ?>"><i class="fas fa-file mr-2"></i>
                    History
                </a>
                <a href="<?php echo base_url('karyawan/menu_absen') ?>"><i class="fas fa-calendar-check mr-2"></i>
                    Menu Absen
                </a>
                <a href="<?php echo base_url('karyawan/menu_izin') ?>"><i class="fas fa-user-check mr-2"></i>
                    Menu Izin
                </a>
                <a href="<?php echo base_url('karyawan/profile') ?>"><i class="fas fa-user mr-2"></i>
                    Profile
                </a>
                <a type="button" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt text-danger">LogOut</i>
                </a>
            </div>

            <div id="content" role="main">
                <div class="card mb-4 shadow">
                    <div class="card-body d-flex text-white justify-content-between align-items-center"
                        style="background-color:#1D267D">

                        <h1>Profile</h1>
                    </div>
                </div>

                <section class="home-section">
                    <div class="home-content">

                    </div>
                    <div class="card">
                        <div class="card-body text-center">
                            <form action="<?= base_url('karyawan/ubah_absensi/' . $absen_id); ?>" method="post">
                                <div class="mb-3">
                                    <label for="kegiatan" class="form-label">Kegiatan:</label>
                                    <input type="text" class="form-control" id="kegiatan" name="kegiatan"
                                        value="<?= $absensi->kegiatan; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_masuk" class="form-label">Jam Masuk:</label>
                                    <input type="text" class="form-control" id="jam_masuk" name="jam_masuk"
                                        value="<?= $absensi->jam_masuk; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>

        </section>



        <script>
        const arrows = document.querySelectorAll(".arrow");

        arrows.forEach((arrow) => {
            arrow.addEventListener("click", (e) => {
                const arrowParent = e.target.closest(".arrow").parentElement.parentElement;
                arrowParent.classList.toggle("showMenu");
            });
        });

        const sidebar = document.querySelector(".sidebar");
        const sidebarBtn = document.querySelector(".fa-bars");

        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
        </script>

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
                    window.location.href = "<?php echo base_url('auth') ?>";
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>