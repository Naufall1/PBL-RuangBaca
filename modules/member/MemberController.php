<?php
    require_once 'core/Database.php';
    require_once 'models/class.template.php';

    class MemberController {
        private $member;
        private $template;
        public function __construct() {
            $this->member = new Member();
            $this->template = new Template('member');
        }

        public function index() {
            $this->template->header();
            $template = $this->template;
            include 'modules/member/member_views/index.php';
            $this->template->footer();
        }

        public function book() {
            // echo 'Book';
            include 'modules/member/member_views/book.php';
        }

        public function history() {
            if (isset($_POST['status'])) {
                $this->borrowingCards();
            } else {
                include 'modules/member/member_views/history.php';
            }
        }
        private function borrowingCards() {
            $borrowingLatest = $this->member->getHistory('latest');
            $borrowingData = $this->member->getHistory(status:$_POST['status']);
            $response = array(
                'latest' => $this->template->renderCards(['borrowingData' => $borrowingLatest]),
                'data' => $this->template->renderCards(['borrowingData' => $borrowingData])
            );
            echo base64_encode(json_encode($response));
        }

        public function cart($path) {
            $arg = explode('/', $path)[1];
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                if (str_starts_with($id, 'BK')) {
                    $item = new Book($id);
                } else {
                    $item = new Thesis($id);
                }
            }

            // var_dump($id);
            if ($arg == 'add') {
                $this->member->addToCart($item);
            } else if ($arg == 'remove') {
                $this->member->removeFromCart($item);
            } else if ($arg == 'checkout') {
                var_dump($this->member->getMemberId());
                $this->member->borrow($_POST['date']);
            }
        }
    }
?>