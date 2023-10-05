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

<body>
    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-md-3 col-lg-2 d-md-block">
                <a href="<?php echo base_url('admin') ?>">
                    <i class="fas fa-chart-line mr-2"></i> Dashboard
                </a>
                <a href="<?php echo base_url('admin/siswa') ?>">
                    <i class="fas fa-user mr-2"></i> Siswa
                </a>
                <a href="<?php echo base_url('admin/akun') ?>">
                    <i class="fas fa-chalkboard mr-2"></i> Akun
                </a>

                <a type="button" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt text-danger">LogOut</i>
                </a>
            </div>

            <div id="content" role="main">
                <div class="card mb-4 shadow">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h1>Siswa</h1>

                    </div>
                </div>

                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <a href="<?php echo base_url('admin/export') ?>" class="btn btn-success m-2">Export</a>
                        <form action="<?= base_url('admin/import') ?>" method="POST" enctype="multipart/form-data">
                            <div class="my-4">
                                <input type="file" name="file" class="w-full py-2 px-3 border border-gray-300">

                                <button type="submit" name="import" class="btn btn-warning m-2">
                                    Import
                                </button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Daftar Siswa</h5>
                            <a href="<?php echo base_url('admin/tambah_siswa') ?>" class="btn btn-success m-2">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto Siswa</th>
                                        <th>Nama Siswa</th>
                                        <th>NISN</th>
                                        <th>Gender</th>
                                        <th>Kelas</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                            foreach ($siswa as $row):
                                $no++ ?>
                                    <!-- Data Siswa -->
                                    <tr>
                                        <td>
                                            <?php echo $no ?>
                                        </td>
                                        <td>
                                            <img src="<?php echo base_url('images/siswa/'.$row->foto) ?>" width="100"
                                                height="100" alt="Foto Siswa">
                                        </td>
                                        <td>
                                            <?php echo $row->nama_siswa ?>
                                        </td>
                                        <td>
                                            <?php echo $row->nisn ?>
                                        </td>
                                        <td>
                                            <?php echo $row->gender ?>
                                        </td>
                                        <td>
                                            <?php echo tampil_full_kelas_byid($row->id_kelas) ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('admin/ubah_siswa/') . $row->id_siswa ?>"
                                                class="btn btn-primary">
                                                Ubah
                                            </a>
                                            <button onClick="hapus(<?php echo $row->id_siswa; ?>)"
                                                class="btn btn-danger">
                                                Hapus
                                            </button>

                                        </td>


                                    </tr>
                                    <!-- Tambahkan baris data siswa lainnya sesuai kebutuhan -->
                                    <?php endforeach ?>
                                </tbody>
                            </table>
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
                window.location.href = "<?php echo base_url('admin/hapus_siswa/') ?>" + id;
            }
        });
    }
    </script>

    <?php if ($this->session->flashdata('success')): ?>
    <script>
    Swal.fire({
        icon: 'success',
        title: '<?= $this->session->flashdata('success') ?>',
        showConfirmButton: false,
        timer: 1500
    });
    </script>
    <?php endif; ?>

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
                window.location.href = "<?php echo base_url('/auth') ?>";
            }
        });
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>