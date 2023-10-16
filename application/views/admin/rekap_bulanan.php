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
                <h3> <i class="fas fa-chart-line mr-2"></i> Dashboard</h3>
                <a href="<?php echo base_url('admin') ?>"><i class="fas fa-chart-line mr-2"></i>
                    Dashboard
                </a>
                <a href="<?php echo base_url('admin/karyawan') ?>"><i class="fas fa-user-check mr-2"></i>
                    Karyawan
                </a>
                <a href="<?php echo base_url('admin/rekap_harian') ?>"><i class="fas fa-file mr-2"></i>
                    Rekap Harian
                </a>
                <a href="<?php echo base_url('admin/rekap_mingguan') ?>"><i class="fas fa-file mr-2"></i>
                    Rekap Mingguan
                </a>
                <a href="<?php echo base_url('admin/rekap_bulanan') ?>"><i class="fas fa-file mr-2"></i>
                    Rekap Bulanan
                </a>

                <a type="button" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt text-danger">LogOut</i>
                </a>
            </div>

            <div id="content" role="main">
                <div class="card mb-4 shadow">
                    <div class="card-body d-flex text-white justify-content-between align-items-center"
                        style="background-color:#1D267D">
                        <h1>Rekap Bulanan</h1>
                    </div>
                </div>

                <!-- Role Karyawan - History Absen -->
                <div class="card mb-4 shadow" style="background-color:#fff">
                    <!-- Filter Bulan -->
                    <form action="<?= base_url('admin/rekap_bulanan'); ?>" method="get">
                        <div class="form-group">
                            <h5 class="text-center">Pilih Bulan</h5>
                            <select class="form-control" id="bulan" name="bulan">
                                <option>Pilih</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark my-2">Filter</button>
                    </form>
                    <table class="table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Total Absensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rekap_bulanan as $data): ?>
                                <tr>
                                    <td><?= date("F", mktime(0, 0, 0, $data['bulan'], 1)); ?></td>
                                    <td><?= $data['total_absensi']; ?></td>
                                </tr>
                                <tr class="detail-row" data-month="<?= $data['bulan'] ?>">
                                    <td colspan="2">
                                        <div class="scrollspy">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal</th>
                                                        <th>Kegiatan</th>
                                                        <th>Masuk</th>
                                                        <th>Pulang</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($rekap_harian as $rekap_harian): ?>
                                                    <?php if (date('n', strtotime($rekap_harian['tanggal'])) == $data['bulan']): ?>
                                                    <tr>
                                                        <td><?= $rekap_harian['id']; ?></td>
                                                        <td><?= tampil_full_nama_byid($rekap_harian['id_karyawan']) ?>
                                                        </td>
                                                        <td><?= $rekap_harian['tanggal']; ?></td>
                                                        <td><?= $rekap_harian['kegiatan']; ?></td>
                                                        <td><?= $rekap_harian['jam_masuk']; ?></td>
                                                        <td><?= $rekap_harian['jam_pulang']; ?></td>
                                                        <td><?= $rekap_harian['status']; ?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js">
                </script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>