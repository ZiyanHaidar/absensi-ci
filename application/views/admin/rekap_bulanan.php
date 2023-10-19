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
                <a href="<?php echo base_url('admin/karyawan') ?>"><i class="fas fa-calendar mr-2"></i>
                    Rekap Keseluruhan
                </a>
                <a href="<?php echo base_url('admin/rekapPerHari') ?>"><i class="fas fa-file mr-2"></i>
                    Rekap Harian
                </a>
                <a href="<?php echo base_url('admin/rekapPerMinggu') ?>"><i class="fas fa-file mr-2"></i>
                    Rekap Mingguan
                </a>
                <a href="<?php echo base_url('admin/rekapPerBulan') ?>"><i class="fas fa-file mr-2"></i>
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
                        <h1>Rekap Bulanan</h1>
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

                <!-- Role Karyawan - History Absen -->
                <div class="card mb-4 shadow" style="background-color:#fff">
                    <!-- Filter Bulan -->
                    <form action="<?= base_url('admin/rekapPerBulan'); ?>" method="get">

                        <div class="d-flex justify-content-between">
                            <select class="form-control" id="bulan" name="bulan">
                                <option>Pilih Bulan</option>
                                <option value="1"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '1') echo 'selected'; ?>>
                                    Januari
                                </option>
                                <option value="2"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '2') echo 'selected'; ?>>
                                    Februari</option>
                                <option value="3"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '3') echo 'selected'; ?>>
                                    Maret
                                </option>
                                <option value="4"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '4') echo 'selected'; ?>>
                                    April
                                </option>
                                <option value="5"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '5') echo 'selected'; ?>>Mei
                                </option>
                                <option value="6"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '6') echo 'selected'; ?>>
                                    Juni
                                </option>
                                <option value="7"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '7') echo 'selected'; ?>>
                                    Juli
                                </option>
                                <option value="8"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '8') echo 'selected'; ?>>
                                    Agustus
                                </option>
                                <option value="9"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '9') echo 'selected'; ?>>
                                    September</option>
                                <option value="10"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '10') echo 'selected'; ?>>
                                    Oktober</option>
                                <option value="11"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '11') echo 'selected'; ?>>
                                    November</option>
                                <option value="12"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '12') echo 'selected'; ?>>
                                    Desember</option>
                            </select>
                            <button type="submit" class="btn btn-success">Filter</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"
                                formaction="<?php echo base_url('admin/export_bulanan')?>">Export</button>
                        </div>
                    </form>
                    <br>

                    <br>
                    <div class="table-responsive">
                        <?php if (empty($rekap_harian)): ?>
                        <h5 class="text-center">Tidak ada data dibulan ini.</h5>
                        <p class="text-center">Silahkan pilih Bulan lain.</p>
                        <?php else: ?>
                        <?php foreach ($rekap_bulanan as $data): ?>
                        <table class="table" data-month="<?= $data['bulan'] ?>">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Masuk</th>
                                    <th scope="col">Jam Pulang</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $data_found = false; ?>
                                <?php foreach ($rekap_harian as $rekap_harian): ?>
                                <?php if (date('n', strtotime($rekap_harian['date'])) == $data['bulan']): ?>
                                <?php $data_found = true; ?>
                                <tr>
                                    <td><?= $rekap_harian['id']; ?></td>
                                    <td><?= $rekap_harian['date']; ?></td>
                                    <td><?= $rekap_harian['kegiatan']; ?></td>
                                    <td><?= $rekap_harian['jam_masuk']; ?></td>
                                    <td><?= $rekap_harian['jam_pulang']; ?></td>
                                    <td><?= $rekap_harian['keterangan_izin']; ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if (!$data_found): ?>
                                <tr>
                                    <td colspan="7">Tidak ada data untuk bulan ini.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
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