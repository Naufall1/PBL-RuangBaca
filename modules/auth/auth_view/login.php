<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once 'core/Flasher.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Ruang Baca</title>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/favicon.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="assets/css/login.css"> -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <script src="assets/js/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="assets/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script>
        function flashMessage(status, message, action = {}) {
            type = {
                'success': 'success',
                'failed': 'danger'
            };
            obj = $('#inner-message.hide[message="' + type[status] + '"]');
            $(obj).removeAttr('style');
            $(obj).removeClass('hide');
            $(obj).addClass('show');
            $(obj).find('h4').html(action[status]);
            $(obj).find('p.content-message').html(message);
            setTimeout(() => {
                $(obj).removeClass('show');
                $(obj).addClass('hide');
                setTimeout(() => {
                    $(obj).css('display', 'none');
                }, 1000);
            }, 5000);
        }
    </script>
</head>

<body>
     <!-- Start: Flash Message -->
     <div id="message">
        <!-- Success -->
        <div id="inner-message" message="success" class="alert alert-custom alert-success-custom hide" style="display: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex" style="gap: 12px; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none">
                        <rect width="48" height="48" fill="#14AE5C" rx="24"/>
                        <path fill="#fff" d="M24 11.167c-7.347 0-13.334 5.986-13.334 13.333S16.654 37.833 24 37.833c7.346 0 13.333-5.986 13.333-13.333S31.347 11.167 24 11.167Zm6.373 10.266-7.56 7.56a.999.999 0 0 1-1.413 0l-3.773-3.773a1.006 1.006 0 0 1 0-1.413 1.006 1.006 0 0 1 1.413 0l3.067 3.066 6.853-6.853a1.006 1.006 0 0 1 1.413 0 1.006 1.006 0 0 1 0 1.413Z"/>
                    </svg>
                    <div class="d-flex flex-column" style="justify-content: center; gap: 2px;">
                        <h4 class="heading-message">Success</h4>
                        <p class="content-message">Pesan</p>
                    </div>
                </div>
                <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                      <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                  </svg>
                </a>
            </div>
        </div>
        <!-- Success -->

        <!-- Warning -->
        <div id="inner-message" message="warning" class="alert alert-custom alert-warning-custom hide" style="display: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex" style="gap: 12px; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none">
                        <rect width="48" height="48" fill="#F1CB01" rx="24"/>
                        <path fill="#fff" d="M24 11.167c-7.347 0-13.334 5.986-13.334 13.333S16.654 37.833 24 37.833c7.346 0 13.333-5.986 13.333-13.333S31.347 11.167 24 11.167Zm-1 8c0-.547.453-1 1-1 .547 0 1 .453 1 1v6.666c0 .547-.453 1-1 1-.547 0-1-.453-1-1v-6.666Zm2.227 11.173c-.067.173-.16.307-.28.44a1.54 1.54 0 0 1-.44.28c-.16.067-.334.107-.507.107a1.32 1.32 0 0 1-.507-.107 1.54 1.54 0 0 1-.44-.28 1.376 1.376 0 0 1-.28-.44 1.327 1.327 0 0 1-.107-.507c0-.173.04-.346.107-.506.067-.16.16-.307.28-.44.133-.12.28-.214.44-.28a1.33 1.33 0 0 1 1.014 0c.16.066.306.16.44.28.12.133.213.28.28.44.066.16.106.333.106.506 0 .174-.04.347-.106.507Z"/>
                    </svg>

                    <div class="d-flex flex-column" style="justify-content: center; gap: 2px;">
                        <h4 class="heading-message">Warning</h4>
                        <p class="content-message">Pesan</p>
                    </div>
                </div>
                <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                      <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                  </svg>
                </a>
            </div>
        </div>
        <!-- Warning -->

        <!-- Danger -->
        <div id="inner-message" message="danger" class="alert alert-custom alert-danger-custom hide" style="display: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex" style="gap: 12px; align-items: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none">
                    <rect width="48" height="48" fill="#E20000" rx="24"/>
                    <path fill="#fff" d="M24 10.667c-7.347 0-13.334 5.986-13.334 13.333S16.654 37.333 24 37.333c7.346 0 13.333-5.986 13.333-13.333S31.347 10.667 24 10.667Zm4.48 16.4a1.006 1.006 0 0 1 0 1.413.99.99 0 0 1-.707.293.989.989 0 0 1-.706-.293L24 25.413l-3.067 3.067a.99.99 0 0 1-.706.293.99.99 0 0 1-.707-.293 1.006 1.006 0 0 1 0-1.413L22.587 24l-3.067-3.067a1.006 1.006 0 0 1 0-1.413 1.006 1.006 0 0 1 1.413 0L24 22.587l3.067-3.067a1.006 1.006 0 0 1 1.413 0 1.006 1.006 0 0 1 0 1.413L25.413 24l3.067 3.067Z"/>
                </svg>
                    <div class="d-flex flex-column" style="justify-content: center; gap: 2px;">
                        <h4 class="heading-message">Danger</h4>
                        <p class="content-message">Pesan</p>
                    </div>
                </div>
                <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                      <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                  </svg>
                </a>
            </div>
        </div>
        <!-- Danger -->

    </div>
    <!-- End: Flash Message -->
    <?php
    if (isset($_SESSION["_flashdata"]) && $_SESSION["_flashdata"] != "") {
        echo "<script type='text/javascript'>flashMessage('". $_SESSION['_flashdata']['type'] ."', '". $_SESSION['_flashdata']['message'] ."', {'success': '". $_SESSION['_flashdata']['action']['success'] ."','failed': '". $_SESSION['_flashdata']['action']['failed'] ."'});</script>";
        $_SESSION["_flashdata"] = '';
    }
    ?>
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