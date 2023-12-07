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
    <!-- <link rel="stylesheet" href="assets/css/login.css"> -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
</head>

<body>
    <section class="login d-flex">
        <div class="login-form-container d-flex">
            <div class="login-register-area d-flex flex-column">
                <img src="assets/logo.svg" class="logo">

                <div class="login-register-form-and-title d-flex flex-column">
                    <div>
                        <h1 class="login-heading">Selamat Datang Kembali!👋🏼</h1>
                        <p class="login-subtitle">Masuk dan Pinjam buku yang kamu butuhkan</p>
                    </div>
                    <form action="index.php?page=login" method="post" class="d-flex flex-column" style="gap: 12px;">
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="username">Nama Pengguna</label>
                            <input type="text" id="username" name="username" placeholder="Masukkan Nama Pengguna" required>
                        </div>
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi" required>
                        </div>
                        <div class="login-submit d-flex flex-column">
                            <button class="enabled full-width" type="submit">Masuk</button>
                            <p class="d-inline">Belum punya akun? <a href="/index.php?page=register" class="signup d-inline text-decoration-none">Daftar</a></p>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>

        <div class="login-illustration-container d-flex">
            <img src="assets/login.svg" class="img-fluid">
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>