<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Ruang Baca</title>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/favicon.svg" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet"> -->
</head>

<body>
    <section class="login d-flex">
        <div class="login-form-container d-flex">
            <div class="login-register-area d-flex flex-column">
                <img src="assets/logo.svg" class="logo">

                <div class="login-register-form-and-title d-flex flex-column">
                    <div>
                        <h1 class="login-heading">Selamat Datang!👋🏼</h1>
                        <p class="login-subtitle">Daftar sekarang dan pinjam buku yang kamu butuhkan</p>
                    </div>
                    <form action="index.php?page=register" method="post" class="d-flex flex-column" style="gap: 12px;">
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="full-name">Nama Lengkap</label>
                            <input type="text" id="full-name" name="full-name" placeholder="Masukkan Nama Lengkap" required>
                        </div>
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="nim">NIM</label>
                            <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required>
                        </div>
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="username">Nama Pengguna</label>
                            <input type="text" id="username" name="username" placeholder="Masukkan Nama Pengguna" required>
                        </div>
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi" required>
                        </div>
                        <div class="login-submit d-flex flex-column">
                            <button class="enabled full-width" type="submit">Daftar</button>
                            <p class="d-inline">Sudah punya akun? <a href="/index.php?page=login" class="signup d-inline text-decoration-none">Masuk</a></p>
                        </div>
                    </form>
                </div>

                        <!-- <form action="cek_login.php" method="post">
                            <img src="img/ruangbaca.svg" class="img-fluid">
                            <h1>Selamat Datang!👋🏼</h1>
                            <p>Daftar sekarang dan pinjam buku yang kamu butuhkan</p>
                            <div class="login-form nds-input-layout-control">
                                <label for="floatingInput">Nama Lengkap</label>
                                <input type="text" class="form-control btn-light primary py-3 mb-4" name="username" placeholder="Masukkan Nama Lengkap" required>
                            </div>
                            <div class="login-form nds-input-layout-control">
                                <label for="floatingInput">NIM</label>
                                <input type="text" class="form-control btn-light primary py-3 mb-4" name="username" placeholder="Masukkan NIM" required>
                            </div>
                            <div class="login-form nds-input-layout-control">
                                <label for="floatingInput">Nama Pengguna</label>
                                <input type="text" class="form-control btn-light primary py-3 mb-4" name="username" placeholder="Masukkan Nama Pengguna" required>
                            </div>
                            <div class="login-form nds-input-layout-control mb-4">
                                <label for="floatingInput">Kata Sandi</label>
                                <input type="password" class="eye form-control btn-light primary py-3" name="password" placeholder="Masukkan Kata Sandi" required>
                            </div>
                            <div class="login-form nds-input-layout-control mb-4">
                                <label for="floatingInput">Konfirmasi Kata Sandi</label>
                                <input type="password" class="eye form-control btn-light primary py-3" name="password" placeholder="Konfirmasi Kata Sandi" required>
                            </div>
                            <div class="login-form">
                                <button class="btn btn-primary w-100" type="submit">Daftar</button>
                            </div>

                            <div class="text-center">
                                <span class="d-inline">Sudah punya akun? <a href="login.php" class="signup d-inline text-decoration-none">Masuk</a></span>
                            </div> -->
                    <!-- </div>
                </div> -->
            </div>
        </div>

        <div class="login-illustration-container d-flex">
            <img src="assets/login.svg" class="img-fluid">
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>