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

        public function cart($path) {
            $arg = explode('/', $path)[1];
            $id = $_POST['id'];
            // var_dump($id);
            if (str_starts_with($id, 'BK')) {
                $item = new Book($id);
            } else {
                $item = new Thesis($id);
            }
            if ($arg == 'add') {
                $this->member->addToCart($item);
            } else if ($arg == 'remove') {
                $this->member->removeFromCart($item);
            }

        }
    }
?>