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
                    $data['numPages'] = ceil(count($data['data']) / LIMIT_ROWS_PER_PAGE);
                    $this->book(data: $data);
                    break;
                case 'author':
                    $data = ($this->admin->view(new Author(), search: $_POST['q']));
                    $data['numPages'] = ceil(count($data['data']) / LIMIT_ROWS_PER_PAGE);
                    $this->author(data: $data);
                    break;
                case 'publisher':
                    $data = ($this->admin->view(new Publisher(), search: $_POST['q']));
                    $data['numPages'] = ceil(count($data['data']) / LIMIT_ROWS_PER_PAGE);
                    $this->publisher(data: $data);
                    break;
                case 'category':
                    $data = ($this->admin->view(new Category(), search: $_POST['q']));
                    $data['numPages'] = ceil(count($data['data']) / LIMIT_ROWS_PER_PAGE);
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
                if (isset($_POST['delete'])) {
                    /**
                     * Delete Book
                     */
                    $id = $_POST['id'];
                    $book = new Book($id);
                    echo ($book->delete()) ? 'success' : 'failed';
                } else {
                    # EDIT BOOK HERE
                    $res = $this->editBook();
                    if ($res['status'] == true) {
                        echo 'success';
                    } else {
                        echo 'failed: ' . implode($res['errors']);
                    }
                }
            } else {
                #ADD BOOK HERE
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
    private function addBook()
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
    private function editBook()
    {
        $errors = array();
        $book = new Book($_POST['id']);
        $title = $_POST['title'];
        $synopsis = $_POST['synopsis'];
        if (isset($_POST['author'])) {
            $author = new Author($_POST['author']);
            $book->setAuthor($author);
        }
        if (isset($_POST['publisher'])) {
            $publisher = new Publisher($_POST['publisher']);
            $book->setPublisher($publisher);
        }
        if (isset($_POST['category'])) {
            $category = new Category($_POST['category']);
            $book->setCategory($category);
        }
        $year = $_POST['year'];
        $stock = $_POST['stock'];
        $isbn = $_POST['isbn'];
        $ddc_code = $_POST['ddc_code'];
        $shelf_id = $_POST['shelf'];
        $book->setTitle($title);
        $book->setsynopsis($synopsis);
        $book->setShelf($shelf_id);
        $book->setYear($year);
        $book->setStock($stock);
        $book->setIsbn($isbn);
        $book->setDdcCode($ddc_code);
        if (!empty($_FILES['cover']['name'])) {
            if ($this->uploadCover() == true) {
                $book->setCover($_FILES['cover']['name']);
            } else {
                $errors[] = 'error uploading cover';
            }
        }
        if (count($errors) == 0) {
            if (!$book->save()) {
                $errors[] = $book->getErrorMessage();
            } else {
                return array(
                    'status' => true,
                );
            }
        } else {
            return array(
                'status' => false,
                'errors' => $errors
            );
        }
    }
    public function author($data = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                if (isset($_POST['delete'])) {
                    /**
                     * Delete author here
                     */
                    $id = $_POST['id'];
                    $author = new Author($id);
                    echo ($author->delete()) ? 'success' : 'failed';
                } else {
                    # EDIT AUTHOR HERE
                    $author_id = $_POST['id'];
                    $author_name = $_POST['author_name'];
                    $author = new Author($author_id);
                    $author->setAuthorName($author_name);
                    $author->save();
                }
            } else {
                $author = new Author();
                $author_name = $_POST['author_name'];
                $author->setAuthorName(author_name: $author_name);
                if ($this->admin->add($author)) {
                    echo 'success';
                } else {
                    echo 'failure';
                }
            }
        } else {
            if ($data !== null) {
                $authors = $data;
            } else {
                $authors = $this->admin->view(new Author());
            }
            $numPage = $authors['numPages'];
            include 'modules/admin/admin_views/author.php';
        }
    }
    public function publisher($data = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                if (isset($_POST['delete'])) {
                    /**
                     * Delete published here
                     */
                    $id = $_POST['id'];
                    $publisher = new Publisher($id);
                    echo ($publisher->delete()) ? 'success' : 'failed';
                } else {
                    # EDIT PUBLISHER HERE
                    $publisher_id = $_POST['id'];
                    $publisher_name = $_POST['publisher_name'];
                    $publisher = new Publisher($publisher_id);
                    $publisher->setPublisherName($publisher_name);
                    $publisher->save();
                }
            } else {
                $publisher = new Publisher();
                $publisher_name = $_POST['publisher_name'];
                $publisher->setPublisherName(publisher_name: $publisher_name);
                if ($this->admin->add($publisher)) {
                    echo 'success';
                } else {
                    echo 'failure';
                }
            }
        } else {
            if ($data !== null) {
                # code...
            } else {
                # code...
            }
            $publishers = $this->admin->view(new Publisher());
            $numPage = $publishers['numPages'];
            include 'modules/admin/admin_views/publisher.php';
        }
    }
    public function category($data = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                if (isset($_POST['delete'])) {
                    /**
                     * Delete Category Here
                     */
                    $id = $_POST['id'];
                    $category = new Category($id);
                    echo ($category->delete()) ? 'success' : 'failed';
                } else {
                    # EDIT CATEGORY HERE
                    $category_id = $_POST['id'];
                    $category_name = $_POST['category_name'];
                    $category = new Category($category_id);
                    $category->setCategoryName($category_name);
                    $category->save();
                }
            } else {
                $category = new Category();
                $category_name = $_POST['category_name'];
                $category->setCategoryName(category_name: $category_name);
                if ($this->admin->add($category)) {
                    echo 'success';
                } else {
                    echo 'failure';
                }
            }
        } else {
            if ($data !== null) {
                # code...
            } else {
                # code...
            }
            $category = $this->admin->view(new Category());
            $numPage = $category['numPages'];
            include 'modules/admin/admin_views/category.php';
        }
    }
    public function thesis($data = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                if (isset($_POST['delete'])) {
                    /**
                     * Delete Thesis Here
                     */
                    $id = $_POST['id'];
                    $thesis = new Thesis($id);
                    echo ($thesis->delete()) ? 'success' : 'failed';
                } else {
                    # EDIT THESIS HERE
                    $thesis = new Thesis($_POST['id']);
                    $thesis_title = $_POST['thesis_title'];
                    $writer_name = $_POST['writer_name'];
                    $writer_nim = $_POST['writer_NIM'];
                    $year = $_POST['year_published'];
                    $lecturer_1 = $_POST['lecturer_id1'];
                    $lecturer_2 = $_POST['lecturer_id2'];
                    $shelf = $_POST['shelf'];
                    $thesis->setTitle($thesis_title);
                    $thesis->setWriterName($writer_name);
                    $thesis->setWriterNim($writer_nim);
                    $thesis->setYear((int)$year);
                    $thesis->addDospem($lecturer_1);
                    $thesis->addDospem($lecturer_2);
                    $thesis->setShelf($shelf);
                    $res = $thesis->save();
                    echo  json_encode($res);
                }
            } else {
                $thesis_title = $_POST['thesis_title'];
                $writer_name = $_POST['writer_name'];
                $writer_nim = $_POST['writer_name'];
                $year = $_POST['year_published'];
                $lecturer_1 = $_POST['lecturer_id1'];
                $lecturer_2 = $_POST['lecturer_id2'];
                $shelf = $_POST['shelf'];
                $thesis = new Thesis();
                $thesis->setTitle($thesis_title);
                $thesis->setWriterName($writer_name);
                $thesis->setWriterNim($writer_nim);
                $thesis->setYear((int)$year);
                $thesis->setAvail(1);
                $thesis->addDospem($lecturer_1);
                $thesis->addDospem($lecturer_2);
                $thesis->setCover('default.png');
                $thesis->setShelf($shelf);
                // var_dump($this->admin->add($thesis));
                if ($this->admin->add($thesis) == true) {
                    echo 'success';
                } else {
                    echo 'failure';
                }
            }
        } else {
            if ($data !== null) {
                # code...
            } else {
                # code...
            }
            $thesis = $this->admin->view(new Thesis());
            $numPage = $thesis['numPages'];
            include 'modules/admin/admin_views/thesis.php';
        }
    }
    public function lecturer($data = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                if (isset($_POST['delete'])) {
                    # DELETE LECTURER HERE
                    $id = $_POST['id'];
                    $lecturer = new Lecturer($id);
                    echo ($lecturer->delete()) ? 'success' : 'failed';
                } else {
                    # EDIT LECTURER HERE
                    $lecturer_id = $_POST['id'];
                    $lecturer_name = $_POST['lecturer_name'];
                    $lecturer = new Lecturer($lecturer_id);
                    $lecturer->setName($lecturer_name);
                    $lecturer->save();
                }
            } else {
                $nidn = $_POST['NIDN'];
                $lecturer_name = $_POST['lecturer_name'];
                $lecturer = new Lecturer();
                $lecturer->setNidn($nidn);
                $lecturer->setName($lecturer_name);
                if ($lecturer->add()) {
                    echo 'success';
                } else {
                    echo 'failure';
                }
            }
        } else {
            if ($data !== null) {
                # code...
            } else {
                # code...
            }
            $lecturer = $this->admin->view(new Lecturer());
            $numPage = $lecturer['numPages'];
            include 'modules/admin/admin_views/lecturer.php';
        }
    }
    public function member($data = null)
    {
        if ($data !== null) {
            # code...
        } else {
            # code...
        }

        $members = $this->admin->view(new Member());
        $numPage = $members['numPages'];
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
        $numPage = $borrowing['numPages'];
        include 'modules/admin/admin_views/borrowing.php';
    }
    public function shelf($data = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['nextId'])) {
                $shelf = new Shelf();
                echo $shelf->getNext();
            } else if (isset($_POST['id'])) {
                $shelf = new Shelf();
                if ($shelf->getNext() == $_POST['id']) {
                    /**
                     * Add Shelf
                     */
                    $id = $_POST['id'];
                    $keterangan = $_POST['keterangan'];
                    $shelf->setShelfId($id);
                    $shelf->setCategories($keterangan);
                    if ($shelf->add() != false) {
                        echo 'success';
                    } else {
                        echo 'failure';
                    }
                } else if (isset($_POST['delete'])) {
                    /**
                     * Delete Shelf
                     */
                    $id = $_POST['id'];
                    $shelf = new Shelf($id);
                    echo ($shelf->delete()) ? 'success' : 'failed';
                } else {
                    /**
                     * Edit Shelf
                     */
                    $id = $_POST['id'];
                    $keterangan = $_POST['keterangan'];
                    $shelf->setShelfId($id);
                    $shelf->setCategories($keterangan);
                    if ($shelf->save() != false) {
                        echo 'success';
                    } else {
                        echo 'failure';
                    }
                }
            }
        } else {
            /**
             * View Shelf
             */
            if ($data !== null) {
                # code...
            } else {
                # code...
            }
            $shelf = $this->admin->view(new shelf());
            $numPage = $shelf['numPages'];
            include 'modules/admin/admin_views/shelf.php';
        }
    }
}
