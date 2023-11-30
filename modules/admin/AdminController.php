<?php
    require_once 'core/Database.php';
    require_once 'modules/admin/AdminRepository.php';

    class AdminController {
        private $db;

        public function __construct() {
            $this->db = new AdminRepository();
        }

        public function index() {

        }
    }
?>