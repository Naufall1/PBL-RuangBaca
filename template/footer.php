<!-- <script src="assets/js/filter.js"></script> -->
<script src="assets/js/modal.js"></script>
<script src="assets/js/sidebar.js"></script>
<script src="assets/js/<?= $file ?>"></script>
<?php
    if (isset($file2)) {
        echo "<script src='assets/js/". $file2 ."'></script>";
    }
?>
<!-- <script src="assets/js/member.js"></script> -->
<!-- <script src="assets/js/staff.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js">
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->