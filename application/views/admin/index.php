<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        background: #f3f1f6;

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
        color: #fff;
        font-size: 18px;

    }



    .profile-details .job {
        font-size: 12px;
    }



    .home-section .home-content {

        display: flex;
        align-items: center;
    }

    .home-section .home-content .fa-bars {
        margin: 0 15px;
        cursor: pointer;
    }

    .home-section .home-content .text {
        font-size: 26px;
        font-weight: 600;
    }



    /* Tabel */
    .table-wrap {
        max-width: 1000px;
        margin: 40px auto;
        overflow-x: auto;

    }

    table,
    td,
    th {
        /*   border: 1px solid #ddd; */
        text-align: center;
        font-size: 15px;
        text-transform: capitalize;
    }

    table thead tr {
        background-color: #6699ff;
        color: #fff;
    }

    table tbody tr td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 15px;
        white-space: nowrap;
    }

    table tbody tr:nth-child(odd) {
        background: #b4b4b442;
        color: #000;
        font-weight: 500;
    }


    .edit {
        background-color: #6699ff;
        /* Ubah warna latar belakang sesuai tema ikon */
    }

    .pulang {
        background-color: #00ff00;
        /* Ubah warna latar belakang sesuai tema ikon */
    }

    .delete {
        background-color: #ff6666;
        /* Ubah warna latar belakang sesuai tema ikon */
    }

    .icon-btn {
        border: none;
        cursor: pointer;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        border-radius: 4px;
    }

    .icon-btn:hover {
        background-color: #555;
        /* Efek hover untuk semua tombol */
    }

    /* Style untuk filter-form */
    .filter-form {
        display: flex;
        flex-direction: column;
        width: 300px;
        margin: 20px 0;
        padding: 10px;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-green {
        background-color: #00ff00;
        color: #fff;

        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
        text-align: center;
        text-decoration: none;
    }

    .btn-green:hover {
        background-color: #66ff66;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-md-3 col-lg-2 d-md-block">
                <a href="<?php echo base_url('admin') ?>"><i class="fas fa-chart-line mr-2"></i>
                    Dashboard
                </a>
                <a href="<?php echo base_url('admin/karyawan') ?>"><i class="fas fa-user-tie mr-2"></i>
                    Rekap Karyawan
                </a>
                <a href="<?php echo base_url('admin/rekapPerHari') ?>"><i class="fas fa-calendar-check mr-2"></i>
                    Rekap Harian
                </a>
                <a href="<?php echo base_url('admin/rekapPerMinggu') ?>"><i class="fas fa-file mr-2"></i>
                    Rekap Mingguan
                </a>
                <a href="<?php echo base_url('admin/rekapPerBulan') ?>"><i class="fas fa-file-invoice mr-2"></i>
                    Rekap Bulanan
                </a>
                <a href="<?php echo base_url('admin/profile') ?>"><i class="fas fa-user mr-2"></i>
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
                        <h1>Dashboard</h1>
                        <div class="profile-details">
                            <div class="profile-content">
                                <?php foreach ($akun as $users): ?>
                                <div class="profile-content">
                                    <a href="<?php echo base_url('admin/profile') ?>">
                                        <img src="<?php echo base_url('images/admin/' . $users->image) ?>"
                                            alt="profileImg">
                                    </a>
                                </div>
                                <?php endforeach ?>

                                <div class="name-job">
                                    <div class="profile_name">
                                        <?php echo $this->session->userdata('username'); ?>
                                    </div>
                                    <div class="job">
                                        <marquee scrolldelay="200">
                                            <?php echo $_SESSION['email']; ?>
                                        </marquee>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card mb-4 shadow" style="background-color:#fff">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card shadow bg-D8D9DA text-black shadow border-10 rounded">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="fas fa-briefcase mr-2" style="font-size: 60px;"></i>
                                    </div>
                                    <div class="ml-auto">Total User</div>
                                    <h2> <?php echo $user; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow bg-D8D9DA text-black shadow border-10 rounded">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="fas fa-user-check mr-2" style="font-size: 60px;"></i>
                                    </div>
                                    <div class="ml-auto">Total Absen</div>
                                    <span style="font-size: 24px;">
                                        <?php echo $absensi_num; ?></h2>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow bg-D8D9DA text-black shadow border-10 rounded">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="fas fa-user-tie mr-2" style="font-size: 60px;"></i>
                                        <p class="m-0"></p>
                                    </div>
                                    <div class="ml-auto">Total Karyawan</div>
                                    <span style="font-size: 24px;">
                                        <h2> <?php echo $karyawan; ?></h2>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">

                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama depan</th>
                                    <th>Nama belakang</th>
                                    <th>image</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                  foreach ($get_karyawan as $row):
                                  $no++ ?>
                                <tr>
                                    <td>
                                        <?php echo $no ?>
                                    </td>
                                    <td>
                                        <?php echo $row->username ?>
                                    </td>
                                    <td>
                                        <?php echo $row->nama_depan ?>
                                    </td>
                                    <td>
                                        <?php echo $row->nama_belakang ?>
                                    </td>
                                    <td>
                                        <img style="width:80px; height:80px; border-radius:50%"
                                            src="<?= base_url('images/user/' . $row->image) ?>" alt="">

                                    </td>
                                    <td>
                                        <?php echo $row->email ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>

    <script>
    const arrows = document.querySelectorAll(".arrow");

    arrows.forEach((arrow) => {
        arrow.addEventListener("click", (e) => {
            const arrowParent = e.target.closest(".arrow").parentElement
                .parentElement;
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
    </div>
    </div>




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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>