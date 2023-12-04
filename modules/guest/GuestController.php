<?php

    class GuestController {

        public function index() {
            $template = new Template('guest');
            $template->header();
            // include 'template/header.php';
            include 'modules/guest/guest_views/guest.catalog.php';
            // include 'template/footer.php';
            $template->footer();
        }
    }
?>