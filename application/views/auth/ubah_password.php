<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
    body {
        top: 0;
        left: 0;
        margin: 0;
        padding: 0;
        font-family: 'Montserrat', sans-serif;
    }


    .field-icon {
        position: absolute;
        top: 60%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        user-select: none;
    }

    .full-bg {
        background-color: #1450A3;
        background-position: center center;
        background-size: cover;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        z-index: -99;
        transition: all 0.3s ease-in;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .card {
        width: 350px;
        background-color: rgba(255, 255, 255, 0.3);
        border-radius: 15px;
        padding: 40px;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    h2 {
        color: #111;
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        color: #111;
        margin-bottom: 5px;
    }

    input,
    select,
    option {
        padding: 10px;
        margin-bottom: 10px;
        border: none;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.8);
    }

    button {
        padding: 10px;
        background-color: #fff;
        color: #498ffc;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #70c1ff;
    }

    @media (max-width: 480px) {
        .card {
            width: 100%;
            max-width: 350px;
        }
    }

    a {
        color: #498ffc;
        /* Warna teks tautan */
        text-decoration: none;
        /* Menghilangkan garis bawah tautan */
        font-weight: bold;
        /* Ketebalan teks tautan */
    }

    a:hover {
        color: #70c1ff;
        /* Warna teks tautan saat dihover */
    }

    .login-link a {
        color: #498ffc;
        text-decoration: none;
        font-weight: bold;
    }

    .login-link a:hover {
        color: #70c1ff;
    }
    </style>
</head>

<body class="body d-flex align-items-center justify-content-center">
    <div class="full-bg">
        <div class="container">
            <div class="card">
                <h2 class="card-header text-center mb-4" style="color:yellow">Ubah Password</h2>
                <div class="card-body">
                    <form action="<?php echo base_url('auth/edit_password'); ?>" enctype="multipart/form-data"
                        method="post">
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
            <script>
            function togglePassword() {
                var passwordField = document.getElementById("password");
                var icon = document.querySelector(".toggle-password");

                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                } else {
                    passwordField.type = "password";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                }
            }
            </script>

            <script>
            $(document).ready(function() {
                $("#rekapDropdown").click(function() {
                    $(this).next(".dropdown-menu").toggleClass("show");
                });
            });
            </script>

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
</body>

</html>