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

                        <h1>Profile</h1>
                    </div>
                </div>

                <?php foreach($akun as $users) : ?>
                <div class="col-xl-4">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Foto Profil</div>
                        <div class="card-body text-center">
                            <img class="img-account-profile rounded-circle mb-2"
                                src="<?php echo base_url('images/user/' .$users->image) ?>" alt="">
                            <div class="small font-italic text-muted">Harus berbentuk jpg/jpeg/png.</div>
                            <p class="small font-italic text-muted mb-4">Disarankan berukuran 1:1</p>
                            <form action="<?php echo base_url('karyawan/edit_foto'); ?>" method="post"
                                enctype="multipart/form-data">
                                <label for="image_upload" class="btn btn-primary">
                                    Edit Foto
                                    <input type="file" id="image_upload" name="userfile" style="display: none;">
                                </label>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Informasi Data</div>
                        <div class="card-body">
                            <form action="<?php echo base_url('karyawan/edit_profile'); ?>"
                                enctype="multipart/form-data" method="post">
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" type="email" placeholder="Masukan email"
                                        value="<?php echo $users->email ?>" name="email">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="username">Username</label>
                                    <input class="form-control" id="username" type="text" placeholder="Masukan username"
                                        value="<?php echo $users->username ?>" name="username">
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="nama_depan">Nama Depan</label>
                                        <input class="form-control" id="nama_depan" type="text"
                                            placeholder="Masukan nama depan" value="<?php echo $users->nama_depan ?>"
                                            name="nama_depan">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="nama_belakang">Nama Belakang</label>
                                        <input class="form-control" id="nama_belakang" type="text"
                                            placeholder="Masukan nama belakang"
                                            value="<?php echo $users->nama_belakang ?>" name="nama_belakang">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="password">Password Baru</label>
                                        <div class="input-group">
                                            <input class="form-control" id="password_baru" type="password"
                                                placeholder="Masukan password baru" name="password_baru">
                                            <span class="input-group-text" onclick="togglePassword('password')"><i
                                                    id="icon-password" class="fas fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="password">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <input class="form-control" id="konfirmasi_password" type="password"
                                                placeholder="Konfirmasi password" name="konfirmasi_password">
                                            <span class="input-group-text"
                                                onclick="togglePassword('konfirmasi_password')"><i id="icon-konfirmasi"
                                                    class="fas fa-eye"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    </div>
</body>

<script>
function togglePassword(inputId) {
    var x = document.getElementById(inputId);
    var icon = document.getElementById("icon-" + inputId);

    if (x.type === "password") {
        x.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        x.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

<?php if($this->session->flashdata('kesalahan_password')){ ?>
<script>
Swal.fire({
    title: "Error!",
    text: "<?php echo $this->session->flashdata('kesalahan_password'); ?>",
    icon: "warning",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('gagal_update')){ ?>
<script>
Swal.fire({
    title: "Error!",
    text: "<?php echo $this->session->flashdata('gagal_update'); ?>",
    icon: "error",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('error_profile')){ ?>
<script>
Swal.fire({
    title: "Error!",
    text: "<?php echo $this->session->flashdata('error_profile'); ?>",
    icon: "error",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('berhasil_ubah_foto')){ ?>
<script>
Swal.fire({
    title: "Berhasil",
    text: "<?php echo $this->session->flashdata('berhasil_ubah_foto'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('ubah_password')){ ?>
<script>
Swal.fire({
    title: "Success!",
    text: "<?php echo $this->session->flashdata('ubah_password'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('update_user')){ ?>
<script>
Swal.fire({
    title: "Success!",
    text: "<?php echo $this->session->flashdata('update_user'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

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