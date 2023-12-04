<?php
    require_once 'core/Database.php';

    class MemberController {
        private $member;
        public function __construct() {
            $this->member = new Member();
        }

        public function index() {
            include 'modules/member/member_views/index.php';
        }

        public function book() {
            // echo 'Book';
            include 'modules/member/member_views/book.php';
        }

        public function history() {
            // echo 'History';
            include 'modules/member/member_views/history.php';
        }
    }
?>