<?php
    include 'models/Admin.php';
    class AdminController {
        private Admin $admin;
        public function __construct() {
            $this->admin = new Admin();
        }

        public function index() {
            $template = new Template('admin');
            $template->header();
            include 'modules/admin/admin_views/index.php';
            $template->footer();
        }
        public function book(){
            // $books = $this->admin->viewBooks();
            $books = $this->admin->viewBooks();
            $numPage = (round($books['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($books['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/book.php';
        }
        public function author(){
            $authors = $this->admin->viewAuthors();
            $numPage = (round($authors['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($authors['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/author.php';
        }
        public function publisher(){
            $publishers = $this->admin->viewPublishers();
            $numPage = (round($publishers['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($publishers['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/publisher.php';
        }
        public function category(){
            $category = $this->admin->viewCategories();
            $numPage = (round($category['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($category['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/category.php';
        }
        public function thesis(){
            $thesis = $this->admin->viewThesis();
            $numPage = (round($thesis['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($thesis['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/thesis.php';
        }
        public function lecturer(){
            $lecturer = $this->admin->viewLecturer();
            $numPage = (round($lecturer['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($lecturer['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/lecturer.php';
        }
        public function member(){
            $members = $this->admin->viewMembers();
            $numPage = (round($members['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($members['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/member.php';
        }
        public function borrowing(){
            $borrowing = $this->admin->viewBorrowing();
            $numPage = (round($borrowing['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($borrowing['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/borrowing.php';
        }
        public function shelf(){
            $shelf = $this->admin->viewShelf();
            $numPage = (round($shelf['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($shelf['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/shelf.php';
        }
    }
?>