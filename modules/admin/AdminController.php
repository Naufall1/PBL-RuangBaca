<?php
include 'models/Admin.php';
class AdminController
{
    private Admin $admin;
    public function __construct()
    {
        $this->admin = new Admin();
    }

    public function index()
    {
        $template = new Template('admin');
        $template->header();
        include 'modules/admin/admin_views/index.php';
        $template->footer();
    }
    public function search($path)
    {
        $arg = explode('/', $path)[1];
        if (isset($_POST['q'])) {
            # code...
            switch ($arg) {
                case 'book':
                    $data = ($this->admin->view(new Book(), search: $_POST['q']));
                    $data['numPages'] = (round(count($data['data']) / LIMIT_ROWS_PER_PAGE) >= 1) ? round(count($data['data']) / LIMIT_ROWS_PER_PAGE) : 1;
                    $this->book(data: $data);
                    break;
                case 'author':
                    $data = ($this->admin->view(new Author(), search: $_POST['q']));
                    $data['numPages'] = (round(count($data['data']) / LIMIT_ROWS_PER_PAGE) >= 1) ? round(count($data['data']) / LIMIT_ROWS_PER_PAGE) : 1;
                    $this->author(data: $data);
                    break;
                case 'publisher':
                    $data = ($this->admin->view(new Publisher(), search: $_POST['q']));
                    $data['numPages'] = (round(count($data['data']) / LIMIT_ROWS_PER_PAGE) >= 1) ? round(count($data['data']) / LIMIT_ROWS_PER_PAGE) : 1;
                    $this->publisher(data: $data);
                    break;
                case 'category':
                    $data = ($this->admin->view(new Category(), search: $_POST['q']));
                    $data['numPages'] = (round(count($data['data']) / LIMIT_ROWS_PER_PAGE) >= 1) ? round(count($data['data']) / LIMIT_ROWS_PER_PAGE) : 1;
                    $this->category(data: $data);
                    break;

                default:
                    # code...
                    break;
            }
        } else {
            echo 'Failed';
        }
    }
    public function book($data = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                # EDIT BOOK HERE

            } else {
                if ($this->addBook()) {
                    echo 'success';
                } else {
                    echo 'failure';
                }
            }
        } else {
            if ($data !== null) {
                $books = $data;
            } else {
                $books = $this->admin->view(new Book());
            }
            $numPage = $books['numPages'];
            include 'modules/admin/admin_views/book.php';
        }
    }
    public function uploadCover(): bool | string
    {
        $errors = array();
        $file_name = $_FILES['cover']['name'];
        $file_size = $_FILES['cover']['size'];
        $file_tmp = $_FILES['cover']['tmp_name'];
        $file_type = $_FILES['cover']['type'];
        $tmp = explode(".", $file_name);
        $file_ext = strtolower(end($tmp));
        $extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "File : <i>$file_name</i>, Ekstensi file yang diizinkan adalah jpg, jpeg, png, gif";
        }
        if ($file_size > 2097152) {
            $errors[] = "FIle : <i>$file_name</i>, Ukuran file tidak boleh lebih dari 2 MB.";
        }
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, COVER_DIR . $file_name);
            // echo "File <i>$file_name</i> berhasil diunggah";
            // echo "<br>";
            return true;
        } else {
            return implode("<br>", $errors);
        }
    }
    public function addBook()
    {
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['cover']) && $this->uploadCover() == true) {
            $title = $_POST['title'];
            $synopsis = $_POST['synopsis'];
            if (isset($_POST['author'])) {
                $author = new Author($_POST['author']);
            } else {
                $author = new Author();
                $author->setAuthorName($_POST['add-author']);
                if ($author->add() != true) {
                    echo 'Error adding author';
                    return;
                }
            }
            if (isset($_POST['publisher'])) {
                $publisher = new Publisher($_POST['publisher']);
            } else {
                $publisher = new Publisher();
                $publisher->setPublisherName($_POST['add-publisher']);
                if ($publisher->add() != true) {
                    echo 'Error adding publisher';
                    return;
                }
            }
            if (isset($_POST['category'])) {
                $category = new Category($_POST['category']);
            } else {
                $category = new Category();
                $category->setCategoryName($_POST['add-category']);
                if ($category->add() != true) {
                    echo 'Error adding category';
                    return;
                }
            }

            $year = $_POST['year'];
            $stock = $_POST['stock'];
            $isbn = $_POST['isbn'];
            $ddc_code = $_POST['ddc_code'];
            $shelf_id = $_POST['shelf'];
            $book = new Book();
            $book->setTitle($title);
            $book->setsynopsis($synopsis);
            $book->setCategory($category);
            $book->setAuthor($author);
            $book->setPublisher($publisher);
            $book->setShelf($shelf_id);
            $book->setYear($year);
            $book->setStock($stock);
            $book->setIsbn($isbn);
            $book->setDdcCode($ddc_code);
            $book->setCover($_FILES['cover']['name']);
            return $book->add();
        } else {
            return false;
        }
    }
    public function author($data = null)
    {
        if ($data !== null) {
            $authors = $data;
        } else {
            $authors = $this->admin->view(new Author());
        }
        $numPage = $authors['numPages'];
        include 'modules/admin/admin_views/author.php';
    }
    public function publisher($data = null)
    {
        if ($data !== null) {
            # code...
        } else {
            # code...
        }

        $publishers = $this->admin->view(new Publisher());
        $numPage = (round($publishers['countAll'] / LIMIT_ROWS_PER_PAGE) >= 1) ? round($publishers['countAll'] / LIMIT_ROWS_PER_PAGE) : 1;
        include 'modules/admin/admin_views/publisher.php';
    }
    public function category($data = null)
    {
        if ($data !== null) {
            # code...
        } else {
            # code...
        }

        $category = $this->admin->view(new Category());
        $numPage = (round($category['countAll'] / LIMIT_ROWS_PER_PAGE) >= 1) ? round($category['countAll'] / LIMIT_ROWS_PER_PAGE) : 1;
        include 'modules/admin/admin_views/category.php';
    }
    public function thesis($data = null)
    {
        if ($data !== null) {
            # code...
        } else {
            # code...
        }

        $thesis = $this->admin->view(new Thesis());
        $numPage = (round($thesis['countAll'] / LIMIT_ROWS_PER_PAGE) >= 1) ? round($thesis['countAll'] / LIMIT_ROWS_PER_PAGE) : 1;
        include 'modules/admin/admin_views/thesis.php';
    }
    public function lecturer($data = null)
    {
        if ($data !== null) {
            # code...
        } else {
            # code...
        }

        $lecturer = $this->admin->view(new Lecturer());
        $numPage = (round($lecturer['countAll'] / LIMIT_ROWS_PER_PAGE) >= 1) ? round($lecturer['countAll'] / LIMIT_ROWS_PER_PAGE) : 1;
        include 'modules/admin/admin_views/lecturer.php';
    }
    public function member($data = null)
    {
        if ($data !== null) {
            # code...
        } else {
            # code...
        }

        $members = $this->admin->view(new Member());
        $numPage = (round($members['countAll'] / LIMIT_ROWS_PER_PAGE) >= 1) ? round($members['countAll'] / LIMIT_ROWS_PER_PAGE) : 1;
        include 'modules/admin/admin_views/member.php';
    }
    public function borrowing($data = null)
    {
        if ($data !== null) {
            # code...
        } else {
            # code...
        }

        $borrowing = $this->admin->viewBorrowing();
        $numPage = (round($borrowing['countAll'] / LIMIT_ROWS_PER_PAGE) >= 1) ? round($borrowing['countAll'] / LIMIT_ROWS_PER_PAGE) : 1;
        include 'modules/admin/admin_views/borrowing.php';
    }
    public function shelf($data = null)
    {
        if ($data !== null) {
            # code...
        } else {
            # code...
        }

        $shelf = $this->admin->view(new shelf());
        $numPage = (round($shelf['countAll'] / LIMIT_ROWS_PER_PAGE) >= 1) ? round($shelf['countAll'] / LIMIT_ROWS_PER_PAGE) : 1;
        include 'modules/admin/admin_views/shelf.php';
    }
}
