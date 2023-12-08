<?php
    require_once 'models/class.template.php';
    require_once 'models/Staff.php';
    class StaffController {
        private Staff $staff;
        private Template $template;
        public function __construct() {
            $this->template = new Template('staff');
            $this->staff = new Staff();
        }

        public function index() {
            $this->template->header();
            $template = $this->template;
            include 'modules/staff/staff_views/index.php';
            $this->template->footer();
        }

        private function dashboardCards() {
            $borrowingData = $this->staff->getBorrowing($_POST['status']);
            echo $this->template->renderCards(['borrowingData' => $borrowingData]);
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
            $id = $_POST['id'];
            // var_dump($arg);
            switch ($arg) {
                case 'details':
                    echo $this->staff->getBorrowingDetails(id:$id);
                    break;
                case 'confirm':
                    echo $this->staff->confirmBorrowing(id:$id);
                    break;
                case 'reject':
                    echo $this->staff->rejectBorrowing(id:$id);
                    break;
                case 'pickUp':
                    echo $this->staff->pickUpBorrowing(id:$id);
                    break;
                case 'finish':
                    echo $this->staff->finishBorrowing(id:$id);
                    break;
                default:
                    echo 'denied';
                    break;
            }
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