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
        public function book() {
            include 'modules/staff/staff_views/book.php';
        }
        public function thesis() {
            include 'modules/staff/staff_views/thesis.php';
        }
        public function member() {
            include 'modules/staff/staff_views/member.php';
        }
    }
?>