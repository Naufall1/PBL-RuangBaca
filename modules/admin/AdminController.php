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
        public function search($path) {
            $arg = explode('/', $path)[1];
            if (isset($_POST['q'])) {
                # code...
                switch ($arg) {
                    case 'book':
                        $data = ($this->admin->view(new Book(), search: $_POST['q']));
                        $this->book(data:$data);
                        break;
                    case 'author':
                        $data = ($this->admin->view(new Author(), search: $_POST['q']));
                        $this->author(data:$data);
                        break;

                    default:
                        # code...
                        break;
                }
            } else {
                echo 'Failed';
            }

        }
        public function book($data = null){
            if ($data !== null) {
                $books = $data;
            } else {
                $books = $this->admin->view(new Book());
            }

            $numPage = $books['numPages'];
            include 'modules/admin/admin_views/book.php';
        }
        public function author($data = null){
            if ($data !== null) {
                $authors = $data;
            } else {
                $authors = $this->admin->view(new Author());
            }
            $numPage = $authors['numPages'];
            include 'modules/admin/admin_views/author.php';
        }
        public function publisher(){
            $publishers = $this->admin->view(new Publisher());
            $numPage = (round($publishers['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($publishers['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/publisher.php';
        }
        public function category(){
            $category = $this->admin->view(new Category());
            $numPage = (round($category['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($category['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/category.php';
        }
        public function thesis(){
            $thesis = $this->admin->view(new Thesis());
            $numPage = (round($thesis['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($thesis['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/thesis.php';
        }
        public function lecturer(){
            $lecturer = $this->admin->view(new Lecturer());
            $numPage = (round($lecturer['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($lecturer['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/lecturer.php';
        }
        public function member(){
            $members = $this->admin->view(new Member());
            $numPage = (round($members['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($members['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/member.php';
        }
        public function borrowing(){
            $borrowing = $this->admin->viewBorrowing();
            $numPage = (round($borrowing['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($borrowing['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/borrowing.php';
        }
        public function shelf(){
            $shelf = $this->admin->view(new shelf());
            $numPage = (round($shelf['countAll']/LIMIT_ROWS_PER_PAGE) >= 1) ? round($shelf['countAll']/LIMIT_ROWS_PER_PAGE) : 1;
            include 'modules/admin/admin_views/shelf.php';
        }
    }
?>