<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ruang Baca</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
</head>

<body>
    <section class="login d-flex">
        <div class="login-left w-50 h-150">
            <div class="row justify-content-center" style="margin-top: 150px;">

                <div class="col-6">
                    <div class="header">
                        <form action="index.php?page=login" method="post">
                            <img src="assets/logo.svg" class="img-fluid">
                            <h1>Selamat Datang Kembali!👋🏼</h1>
                            <p>Masuk dan Pinjam buku yang kamu butuhkan</p>
                            <div class="login-form nds-input-layout-control">
                                <label for="floatingInput">Nama Pengguna</label>
                                <input type="text" class="form-control btn-light primary py-3 mb-4" name="username" placeholder="Masukkan Nama Pengguna" required>
                            </div>
                            <div class="login-form nds-input-layout-control mb-4">
                                <label for="floatingInput">Kata Sandi</label>
                                <input type="password" class="eye form-control btn-light primary py-3" name="password" placeholder="Masukkan Kata Sandi" required>
                            </div>
                            <div class="login-form">
                                <button class="btn btn-primary w-100" type="submit">Masuk</button>
                            </div>
                        </form>

                        <div class="text-center">
                            <span class="d-inline">Belum punya akun? <a href="/index.php?page=register" class="signup d-inline text-decoration-none">Daftar</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="login-right w-50 h-100">
            <img src="assets/login.svg" class="img-fluid" style="margin-top: 150px;">
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>