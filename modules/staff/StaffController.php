<?php
    require_once 'models/class.template.php';
    require_once 'models/Staff.php';
    class StaffController {
        private Staff $staff;
        public function __construct() {
            $this->staff = new Staff();
        }

        public function index() {
            $template = new Template('staff');
            $template->header();
            include 'modules/staff/staff_views/index.php';
            $template->footer();
        }

        private function dashboardCards() {
            $borrowingData = $this->staff->getBorrowing($_POST['status']);
            include 'modules/staff/staff_views/template.BorrowingCard.php';
        }

        public function dashboard() {
            if (!isset($_POST['status'])) {
                $summarizes = $this->staff->getSummarizes();
                include 'modules/staff/staff_views/dashboard.php';
            } else {
                $this->dashboardCards();
            }
        }
        public function borrowing($path){
            $arg = explode('/', $path)[1];
            // var_dump($arg);
            switch ($arg) {
                case 'details':
                    echo $this->staff->getBorrowingDetails($_POST['id']);
                    break;
                default:
                    # code...
                    break;
            }
        }
        private function borrowingDetails($id) {

        }
        public function book() {
            $books = $this->staff->view(object: new Book());
            $numPage = (round($books['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($books['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/staff/staff_views/book.php';
        }
        public function thesis() {
            $thesis = $this->staff->view(object: new Thesis());
            $numPage = (round($thesis['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($thesis['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/staff/staff_views/thesis.php';
        }
        public function member() {
            $members = $this->staff->view(object: new Member());
            $numPage = (round($members['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($members['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/staff/staff_views/member.php';
        }
    }
?>