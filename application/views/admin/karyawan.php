<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                <a href="<?php echo base_url('admin') ?>"><i class="fas fa-chart-line mr-2"></i>
                    Dashboard
                </a>
                <a href="<?php echo base_url('admin/karyawan') ?>"><i class="fas fa-user-tie mr-2"></i>
                    Karyawan
                </a>
                <a class="dropdown-toggle" href="#" id="rekapDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-file mr-2"></i> Rekap
                </a>
                <div class="dropdown-menu" aria-labelledby="rekapDropdown">
                    <a class="dropdown-item" href="#" data-target="rekapHarian">Harian</a>
                    <a class="dropdown-item" href="#" data-target="rekapMingguan">Mingguan</a>
                    <a class="dropdown-item" href="#" data-target="rekapBulanan">Bulanan</a>
                </div>

                <a href="<?php echo base_url('admin/profile') ?>"><i class="fas fa-user mr-2"></i>
                    Profile
                </a>
                <div class="logout-button mt-auto">
                    <a type="button" onclick="confirmLogout()">
                        <i class="fas fa-sign-out-alt text-danger">LogOut</i>
                    </a>
                </div>

                <div id="content" role="main">
                    <div class="card mb-4 shadow">
                        <div class="card-body d-flex text-white justify-content-between align-items-center"
                            style="background-color:#1D267D">
                            <h1>Rekap Karyawan</h1>
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
                    <div class="shadow" style="background-color:#fff">

                        <a class="btn btn-sm btn-primary" href="<?= base_url('admin/export_karyawan') ?>">Export</a>
                    </div>
                    <div class="card mb-4 shadow" style="background-color:#fff">
                        <table class="table table-light table-hover">

                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kegiatan</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Pulang</th>
                                    <th>Keterangan Izin</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                    foreach ($absensi as $row):
                                        $no++ ?>
                                <tr>
                                    <td>
                                        <?php echo $no ?>
                                    </td>
                                    <td>
                                        <?php echo tampil_full_nama_byid($row->id_karyawan) ?>
                                    </td>
                                    <td>
                                        <?php echo $row->kegiatan ?>
                                    </td>
                                    <td>
                                        <?php echo $row->jam_masuk ?>
                                    </td>
                                    <td>
                                        <?php echo $row->jam_pulang ?>
                                    </td>
                                    <td><?php echo $row->keterangan_izin ?></td>
                                    <td>
                                        <?php echo $row->status?>
                                    </td>
                                    <td class="text-center">
                                        <button onClick="hapus(<?php echo $row->id; ?>)" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>

                                </tr>
                                <?php endforeach ?>

                        </table>
                        </tbody>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    function hapus(id) {
        Swal.fire({
            title: 'Yakin DI Hapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('admin/hapus_karyawan/') ?>" + id;
            }
        });
    }
    </script>
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

    function showSweetAlert(message) {
        Swal.fire({
            icon: 'info',
            text: message,
            showConfirmButton: false,
            timer: 2000
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