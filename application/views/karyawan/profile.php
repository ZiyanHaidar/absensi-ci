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

    /* CSS untuk gambar profil dan tombol edit */
    .profile-image {
        position: relative;
        display: inline-block;
    }

    .profile-image img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 2px solid #6699ff;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .edit-button {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background-color: #6699ff;
        color: #fff;
        border: none;
        border-radius: 50%;
        padding: 5px 10px;
        cursor: pointer;
        font-size: 16px;
    }

    /* CSS untuk judul card (username) dan informasi tambahan */
    .card h5,
    .card p {
        margin: 0;
        font-size: 1em;
        color: #555;
    }

    .profile-form {
        margin-top: 20px;
        text-align: left;
        max-width: 400px;
        /* Sesuaikan dengan kebutuhan Anda */
        margin-left: auto;
        margin-right: auto;
    }

    .form-group {
        position: relative;
        display: flex;
        flex-direction: column;
        /* Menampilkan label di atas input */
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-right: 40px;
    }

    .form-group .input-group-text {
        position: relative;
        top: 0;
        transform: none;
        cursor: pointer;
    }

    .form-group button {
        font-weight: bold;
        background-color: #343a40;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        display: inline-block;
        align-self: flex-start;
    }


    .form-group.position-relative {
        position: relative;
    }

    .form-group.position-relative input {
        padding-right: 40px;
        /* Biarkan ruang untuk ikon */
    }

    .form-group.position-relative .input-group-text {
        position: absolute;
        right: 10px;
        /* Sesuaikan posisi ikon */
        top: 70%;
        transform: translateY(-50%);
        cursor: pointer;
    }


    @media (max-width: 767px) {
        .profile-form {
            max-width: 100%;
        }

        .form-group label {
            font-size: 14px;
        }

        .form-group input {
            padding: 8px;
        }

        .form-group button {
            font-size: 14px;
        }

        /* Opsi tambahan: menyesuaikan teks tombol */
        button[type="submit"] span {
            margin-left: 3px;
        }
    }

    button[type="submit"]:hover {
        background-color: #343a40;
    }

    button[type="submit"]:focus {
        outline: none;
    }

    /* Opsi tambahan: menyesuaikan teks tombol */
    button[type="submit"] span {
        vertical-align: middle;
        margin-left: 5px;
    }

    /* Style untuk modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 3;
    }

    .modal-content {
        background-color: #fff;
        margin: 15%;
        padding: 20px;
        border-radius: 5px;
        width: 50%;
        position: relative;
    }

    .close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 10px;
        cursor: pointer;
    }

    .close:hover {
        color: #f00;
    }

    /* Memperbaiki tampilan input file */
    input[type="file"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        margin-bottom: 10px;
    }

    /* Memperbaiki tampilan tombol Simpan dan menambahkan ikon */
    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        display: inline-flex;
        align-items: center;
        transition: background-color 0.3s;
    }

    button[type="submit"] i {
        margin-right: 5px;
    }

    /* Tambahkan CSS untuk modal */
    .modalimg {
        display: none;
        position: fixed;
        z-index: 1;
        left: 20%;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.9);
        padding-top: 60px;
    }

    .modalimg-content {
        margin: 5% auto;
        display: block;
        max-width: 700px;
    }

    .closes {
        color: #fff;
        font-size: 35px;
        font-weight: bold;
        position: absolute;
        top: 15px;
        right: 35px;
    }

    .modal-image {
        max-width: 100%;
        max-height: 100%;
        display: block;
        margin: auto;
    }

    .profile-image img {
        cursor: pointer;
    }

    .logout-button a {
        margin-top: 160%;
        text-align: left;
        /* Posisi teks pada tengah */
    }
    </style>
</head>

<body>
    <?php foreach ($akun as $users): ?>

    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-md-3 col-lg-2 d-md-block">
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
                <div class="logout-button mt-auto">
                    <a type="button" onclick="confirmLogout()">
                        <i class="fas fa-sign-out-alt text-danger">LogOut</i>
                    </a>
                </div>
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
                            <div class="profile-image">
                                <img src="<?php echo base_url('images/user/' . $users->image) ?>" alt="profileImg"
                                    class="rounded-circle">

                                <input name="id" type="hidden" value="<?php echo $users->id ?>">
                                <button for="image_upload" class="edit-button" data-bs-toggle="modal"
                                    data-bs-target="#editImageModal"><i class="fa-solid fa-pen"></i></button>
                                <input type="file" id="image" name="image" accept="image/*" style="display:none;">
                            </div>
                            <h5 class="card-title">
                                <?php echo $this->session->userdata('username'); ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $this->session->userdata('email'); ?>
                            </p>
                        </div>
                    </div>
                    <br>
                    <div class="col-xl-15">
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
                                        <input class="form-control" id="username" type="text"
                                            placeholder="Masukan username" value="<?php echo $users->username ?>"
                                            name="username">
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="nama_depan">Nama Depan</label>
                                            <input class="form-control" id="nama_depan" type="text"
                                                placeholder="Masukan nama depan"
                                                value="<?php echo $users->nama_depan ?>" name="nama_depan">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="nama_belakang">Nama Belakang</label>
                                            <input class="form-control" id="nama_belakang" type="text"
                                                placeholder="Masukan nama belakang"
                                                value="<?php echo $users->nama_belakang ?>" name="nama_belakang">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="password_lama">Password Lama</label>
                                        <div class="input-group">
                                            <input class="form-control" id="password_lama" type="password"
                                                placeholder="Masukan Password Lama" name="password_lama">
                                            <span class="input-group-text"
                                                onclick="togglePassword('password_lama', 'icon-password_lama')">
                                                <i id="icon-password_lama" class="fas fa-eye-slash"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="password_baru">Password Baru</label>
                                            <div class="input-group">
                                                <input class="form-control" id="password_baru" type="password"
                                                    placeholder="Password baru" name="password_baru">
                                                <span class="input-group-text"
                                                    onclick="togglePassword('password_baru', 'icon-password_baru')">
                                                    <i id="icon-password_baru" class="fas fa-eye-slash"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="konfirmasi_password">Konfirmasi
                                                Password</label>
                                            <div class="input-group">
                                                <input class="form-control" id="konfirmasi_password" type="password"
                                                    placeholder="Konfirmasi password" name="konfirmasi_password">
                                                <span class="input-group-text"
                                                    onclick="togglePassword('konfirmasi_password', 'icon-konfirmasi_password')">
                                                    <i id="icon-konfirmasi_password" class="fas fa-eye-slash"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-success" type="submit">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>

                    <!-- Modal -->
                    <div class="modal" id="imageModal">
                        <div class="modal-content">
                            <span class="close" id="closeModal">&times;</span>
                            <form action="<?php echo base_url('karyawan/edit_image'); ?>" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $users->id; ?>">
                                <label for="image">Pilih gambar:</label>
                                <input type="file" id="image" name="image" accept="image/*">
                                <button type="submit">Simpan</button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Image-->
                    <div class="modalimg" id="imageModall">
                        <div class="modal-content">
                            <span class="closes" id="closeModall">&times;</span>
                            <img src="<?php echo base_url('images/karyawan/' . $users->image) ?>" alt="profileImg"
                                class="modal-image">
                        </div>
                    </div>

                </section>
                <script>
                $(document).ready(function() {
                    // Ketika input file berubah
                    $('#image_upload').on('change', function(e) {
                        var fileInput = $(this)[0];
                        var file = fileInput.files[0];
                        var reader = new FileReader();

                        // Jika ada file yang dipilih
                        if (file) {
                            reader.onload = function(e) {
                                // Menampilkan pratinjau gambar
                                $('#preview-image').attr('src', e.target.result);
                                $('#preview-container').show();
                            }
                            // Membaca data gambar sebagai URL
                            reader.readAsDataURL(file);
                        } else {
                            // Jika tidak ada file yang dipilih, sembunyikan pratinjau
                            $('#preview-container').hide();
                        }
                    });
                });


                function togglePassword(inputId, iconId) {
                    var x = document.getElementById(inputId);
                    var icon = document.getElementById(iconId);

                    if (x.type === "password") {
                        x.type = "text";
                        icon.classList.remove("fa-eye-slash");
                        icon.classList.add("fa-eye");
                    } else {
                        x.type = "password";
                        icon.classList.remove("fa-eye");
                        icon.classList.add("fa-eye-slash");
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

                <?php if($this->session->flashdata('kesalahan_password_lama')){ ?>
                <script>
                Swal.fire({
                    title: "Error!",
                    text: "<?php echo $this->session->flashdata('kesalahan_password_lama'); ?>",
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
                <script>
                // Membuka modal saat tombol edit diklik
                document.querySelector('.edit-button').addEventListener('click', () => {
                    document.querySelector('.modal').style.display = 'block';
                });

                // Menutup modal saat tombol close pada modal diklik
                document.querySelector('#closeModal').addEventListener('click', () => {
                    document.querySelector('.modal').style.display = 'none';
                });

                // Menutup modal jika area luar modal diklik
                window.addEventListener('click', (e) => {
                    if (e.target == document.querySelector('.modal')) {
                        document.querySelector('.modal').style.display = 'none';
                    }
                });
                </script>
                <script>
                // Script untuk membuka modal ketika gambar diklik
                document.querySelectorAll('.trigger-modall').forEach(item => {
                    item.addEventListener('click', event => {
                        document.getElementById('imageModall').style.display = "block";
                    });
                });

                // Script untuk menutup modal
                document.getElementById('closeModall').addEventListener('click', function() {
                    document.getElementById('imageModall').style.display = "none";
                });
                </script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                    crossorigin="anonymous"></script>

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
                            window.location.href = "<?php echo base_url('home') ?>";
                        }
                    });
                }
                </script>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                    crossorigin="anonymous">
                </script>
</body>

</html>