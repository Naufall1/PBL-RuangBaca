<?php
    require_once 'core/Database.php';

    class StaffController {
        private $db;
        public function __construct() {
            $this->db = new Database();
        }

        public function index() {
            // Tampilkan daftar pengguna
            // $users = $this->db->getAllUsers();
            include 'modules/user/user_views/index.php';
        }
    }
?>