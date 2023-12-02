<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/fonts/css/satoshi.css">
    <link rel="stylesheet" href="assets/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="icon" href="assets/icon/logo.svg" type="image/x-icon">
    <script src="assets/js/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="assets/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function () {
        $(".filter-header button").click(function () {
          var display = $(this).next(".filter-box").css("display");
          if (display != "none") {
            $(this).next(".filter-box").fadeOut("fast");
          } else {
            $(this).next(".filter-box").fadeIn();
          }
        });
      });
    </script>
    <title>Guest</title>
</head>