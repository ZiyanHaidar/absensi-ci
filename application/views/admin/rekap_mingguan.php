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
                        <h1>Rekap Mingguan</h1>
                    </div>
                </div>

                <div class="card mb-4 shadow" style="background-color:#fff">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>NO</th>
                                    <th>KEGIATAN</th>
                                    <th>TANGGAL</th>
                                    <th>JAM MASUK</th>
                                    <th>JAM PULANG</th>
                                    <th>KETERANGAN IZIN</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-300">
                                <?php $no=0; foreach ($absensi as $absen): $no++ ?>
                                <tr class="whitespace-nowrap">
                                    <td class="px-3 py-4 text-sm text-gray-500"><?php echo $no ?></td>
                                    <td class="px-3 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?php echo $absen['kegiatan']; ?>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?php echo $absen['tanggal']; ?>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?php echo $absen['jam_masuk']; ?>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?php echo $absen['jam_pulang']; ?>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?php echo $absen['keterangan_izin']; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </main>
        </div>

    </div>
    </div>
    </div>


    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add an event listener for the "change" event on the select element
        var selectElement = document.getElementById('bulan');
        var formElement = selectElement.form; // Get the parent form

        selectElement.addEventListener('change', function() {
            formElement.submit(); // Submit the form when the select element changes
        });
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