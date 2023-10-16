<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Izin</title>
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



    .container {
        padding: 20px;
    }

    .form-container {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        margin-top: 20px;
    }

    .form-container h1 {
        text-align: center;
    }

    .form-container label {
        font-weight: bold;
    }

    .form-container textarea {
        width: 100%;
    }

    .form-container button {
        display: block;
        margin: 0 auto;
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-md-3 col-lg-2 d-md-block">
                <h3> <i class="fas fa-chart-line mr-2"></i> Dashboard</h3>
                <a href="<?php echo base_url('karyawan') ?>"><i class="fas fa-user-tag mr-2"></i>
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
                        <h1>Izin/cuti</h1>
                        <div class="profile-details">
                            <div class="profile-content">
                                <?php
                        $image_url = isset($this->session->userdata['image']) ? base_url('images/user/' . $this->session->userdata('image')) : base_url('images/user/User.png');
                        ?>
                                <a href="<?php echo base_url('karyawan/profile') ?>">
                                    <img src="<?php echo $image_url; ?>" alt="profileImg">
                                </a>
                            </div>

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
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="col-md-6 mb-10">
                            <div class="card shadow bg-D8D9DA text-black shadow border-15 rounded ">
                                <div class="card-body">
                                    <form action="<?= base_url('karyawan/menu_izin'); ?>" method="post">
                                        <div class="mb-3">
                                            <label for="keterangan">Keterangan Izin</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" rows="4"
                                                required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Ajukan Izin</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
                </script>
                <script src="path/to/your/custom.js"></script>
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
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
                </script>
</body>

</html>