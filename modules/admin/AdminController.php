<?php
include 'models/Admin.php';
class AdminController
{
    private Admin $admin;
    private $errors = array();
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

        $classMap = [
            'book'      => 'Book',
            'author'    => 'Author',
            'publisher' => 'Publisher',
            'category'  => 'Category',
            'thesis'    => 'Thesis',
            'lecture'   => 'Lecturer',
            'member'    => 'Member',
            'shelf'     => 'Shelf',
        ];

        if (isset($_GET['q']) && isset($classMap[$arg])) {
            $className = $classMap[$arg];
            $q = Database::sanitizeInput($_GET['q']);
            $data = $this->admin->view(new $className(), page: (isset($_GET['num'])) ? $_GET['num'] : 1, search: $q);
            $data['numPages'] = ceil(count($data['data']) / LIMIT_ROWS_PER_PAGE);
            // var_dump(count($data['data']));

            $methodName = $arg;
            $this->$methodName(data: $data);
        } else if (isset($_GET['q']) && $arg == 'borrowing') {
            $q = Database::sanitizeInput($_GET['q']);
            $data = $this->admin->viewBorrowing(page: (isset($_GET['num'])) ? $_GET['num'] : 1, search: $q);
            $data['numPages'] = ceil(count($data['data']) / LIMIT_ROWS_PER_PAGE);
            // var_dump(count($data['data']));
            $this->borrowing($data);
        } else {
            echo 'failed';
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
                    // echo ($book->delete()) ? 'success' : 'failed';
                    echo json_encode($this->admin->delete($book));
                } else {
                    # EDIT BOOK HERE
                    echo json_encode($this->editBook());

                }
            } else {
                #ADD BOOK HERE
                // var_dump('2213123');
                echo json_encode($this->addBook());
            }
        } else {
            if ($data !== null) {
                $books = $data;
            } else {
                $temp = $this->admin->view(new Book());
                if (isset($_GET['num'])) {
                    $_SESSION['bk-page'] = $_GET['num'];
                }
                $page = (isset($_SESSION['bk-page'])) ? (($_SESSION['bk-page'] > $temp['numPages']) ? $temp['numPages']  : $_SESSION['bk-page']) : 1;
                // $page = (isset($_SESSION['bk-page'])) ? $_SESSION['bk-page'] : 1;
                $books = $this->admin->view(new Book(), $page);
            }
            $numPage = $books['numPages'];
            include 'modules/admin/admin_views/book.php';
        }
    }
    public function uploadCover(): bool | string
    {
        $file_name = $_FILES['cover']['name'];
        $file_size = $_FILES['cover']['size'];
        $file_tmp = $_FILES['cover']['tmp_name'];
        $file_type = $_FILES['cover']['type'];
        $tmp = explode(".", $file_name);
        $file_ext = strtolower(end($tmp));
        $extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($file_ext, $extensions) === false) {
            $this->errors[] = "File : <i>$file_name</i>, Ekstensi file yang diizinkan adalah jpg, jpeg, png, gif";
        }
        if ($file_size > 2097152) {
            $this->errors[] = "FIle : <i>$file_name</i>, Ukuran file tidak boleh lebih dari 2 MB.";
        }
        if (empty($this->errors) == true) {
            move_uploaded_file($file_tmp, COVER_DIR . $file_name);
            return true;
        } else {
            return false;
        }
    }
    private function addBook()
    {
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['cover']) && $this->uploadCover() == true) {
            $title = $_POST['title'];
            $synopsis = $_POST['synopsis'];
            if (isset($_POST['author']) && $_POST['author'] != 'add') {
                $author = new Author($_POST['author']);
            } else {
                $author = new Author();
                $author->setAuthorName($_POST['add-author']);
                if ($author->add() != true) {
                    echo 'Error adding author';
                    return;
                }
            }
            if (isset($_POST['publisher']) && $_POST['publisher']  != 'add' ) {
                $publisher = new Publisher($_POST['publisher']);
            } else {
                $publisher = new Publisher();
                $publisher->setPublisherName($_POST['add-publisher']);
                if ($publisher->add() != true) {
                    echo 'Error adding publisher';
                    return;
                }
            }
            if (isset($_POST['category']) && $_POST['category'] != 'add') {
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
            return $this->admin->add($book);
            // var_dump($this->admin->add($book));
            // return $book->add();
        } else {
            return array(
                'status' => 'failed',
                'message' => 'Gagal Menambahkan Buku',
                'error' => $this->errors,
        );
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
                $errors = $this->errors;
            }
        }
        if (count($errors) == 0) {
            return $this->admin->save($book);
            // return $book->save();
        } else {
            return array(
                'status' => 'failed',
                'message' => 'Gagal Upload Cover',
                'error' => $errors
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
                    // echo ($author->delete() == true) ? 'success' : 'failed';
                    echo json_encode($this->admin->delete($author));
                } else {
                    # EDIT AUTHOR HERE
                    $author_id = $_POST['id'];
                    $author_name = $_POST['author_name'];
                    $author = new Author($author_id);
                    $author->setAuthorName($author_name);
                    echo json_encode($this->admin->save($author));
                }
            } else {
                /**
                 * Add author here
                 */
                $author = new Author();
                $author_name = $_POST['author_name'];
                $author->setAuthorName(author_name: $author_name);
                echo json_encode($this->admin->add($author));
            }
        } else {
            if ($data !== null) {
                $authors = $data;
            } else {
                $temp = $this->admin->view(new Author());
                /**
                 * save Pagination to session
                 */
                if (isset($_GET['num'])) {
                    $_SESSION['aut-page'] = $_GET['num'];
                }
                // $page = (isset($_SESSION['aut-page'])) ? $_SESSION['aut-page'] : 1;
                $page = (isset($_SESSION['aut-page'])) ? (($_SESSION['aut-page'] > $temp['numPages']) ? $temp['numPages']  : $_SESSION['aut-page']) : 1;
                $authors = $this->admin->view(new Author(), page: $page);
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
                    echo json_encode($this->admin->delete($publisher));
                } else {
                    # EDIT PUBLISHER HERE
                    $publisher_id = $_POST['id'];
                    $publisher_name = $_POST['publisher_name'];
                    $publisher = new Publisher($publisher_id);
                    $publisher->setPublisherName($publisher_name);
                    $publisher->save();
                    echo json_encode($this->admin->save($publisher));
                }
            } else {
                $publisher = new Publisher();
                $publisher_name = $_POST['publisher_name'];
                $publisher->setPublisherName(publisher_name: $publisher_name);
                echo json_encode($this->admin->add($publisher));
            }
        } else {
            if ($data !== null) {
                $publishers = $data;
            } else {
                $temp = $this->admin->view(new Publisher());
                if (isset($_GET['num'])) {
                    $_SESSION['pub-page'] = $_GET['num'];
                }
                $page = (isset($_SESSION['pub-page'])) ? (($_SESSION['pub-page'] > $temp['numPages']) ? $temp['numPages']  : $_SESSION['pub-page']) : 1;
                $publishers = $this->admin->view(new Publisher(), page: $page);
            }
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
                    echo json_encode($this->admin->delete($category));
                } else {
                    # EDIT CATEGORY HERE
                    $category_id = $_POST['id'];
                    $category_name = $_POST['category_name'];
                    $category = new Category($category_id);
                    $category->setCategoryName($category_name);
                    echo json_encode($this->admin->save($category));
                }
            } else {
                /**
                 * Tambah Category
                 */
                $category = new Category();
                $category_name = $_POST['category_name'];
                $category->setCategoryName(category_name: $category_name);
                echo json_encode($this->admin->add($category));
            }
        } else {
            if ($data !== null) {
                $category = $data;
            } else {
                $temp = $this->admin->view(new Category());
                if (isset($_GET['num'])) {
                    $_SESSION['cat-page'] = $_GET['num'];
                }
                $page = (isset($_SESSION['cat-page'])) ? (($_SESSION['cat-page'] > $temp['numPages']) ? $temp['numPages']  : $_SESSION['cat-page']) : 1;
                // $page = (isset($_SESSION['cat-page'])) ? $_SESSION['cat-page'] : 1;
                $category = $this->admin->view(new Category(), page: $page);
            }
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
                    echo json_encode($this->admin->delete($thesis));
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
                    if (!is_null($lecturer_2) && $lecturer_2 != '-') {
                        $thesis->addDospem($lecturer_2);
                    }
                    $thesis->setShelf($shelf);
                    echo json_encode($this->admin->save($thesis));
                }
            } else {
                /**
                 * Add Thesis
                 */
                $thesis_title = $_POST['thesis_title'];
                $writer_name = $_POST['writer_name'];
                $writer_nim = $_POST['writer_NIM'];
                $year = $_POST['year_published'];
                $lecturer_1 = $_POST['lecturer_id1'];
                $lecturer_2 = (isset($_POST['lecturer_id2'])) ? $_POST['lecturer_id2'] : '-';
                $shelf = $_POST['shelf'];
                $prodi = $_POST['prodi'];
                $thesis = new Thesis();
                $thesis->setTitle($thesis_title);
                $thesis->setWriterName($writer_name);
                $thesis->setWriterNim($writer_nim);
                $thesis->setYear((int)$year);
                $thesis->setAvail(1);
                $thesis->addDospem($lecturer_1);
                if (!is_null($lecturer_2) && $lecturer_2 != '-') {
                    $thesis->addDospem($lecturer_2);
                }
                $thesis->setProdi($prodi);
                $thesis->setCover('default.png');
                $thesis->setShelf($shelf);
                echo json_encode($this->admin->add($thesis));
            }
        } else {
            if ($data !== null) {
                $thesis = $data;
            } else {
                if (isset($_GET['num'])) {
                    $_SESSION['th-page'] = $_GET['num'];
                }
                $temp = $this->admin->view(new Thesis());
                $page = (isset($_SESSION['th-page'])) ? (($_SESSION['th-page'] > $temp['numPages']) ? $temp['numPages']  : $_SESSION['th-page']) : 1;
                // $page = (isset($_SESSION['th-page'])) ? $_SESSION['th-page'] : 1;
                $thesis = $this->admin->view(new Thesis(), page: $page);
            }
            $numPage = $thesis['numPages'];
            include 'modules/admin/admin_views/thesis.php';
        }
    }
    public function lecture($data = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                if (isset($_POST['delete'])) {
                    # DELETE LECTURER HERE
                    $id = $_POST['id'];
                    $lecturer = new Lecturer($id);
                    echo json_encode($this->admin->delete($lecturer));
                } else {
                    # EDIT LECTURER HERE
                    $lecturer_id = $_POST['id'];
                    $lecturer_name = $_POST['lecturer_name'];
                    $lecturer = new Lecturer($lecturer_id);
                    $lecturer->setName($lecturer_name);
                    echo json_encode($this->admin->save($lecturer));
                }
            } else {
                /**
                 * ADD LECTURER
                 */
                $nidn = $_POST['NIDN'];
                $lecturer_name = $_POST['lecturer_name'];
                $lecturer = new Lecturer();
                $lecturer->setNidn($nidn);
                $lecturer->setName($lecturer_name);
                echo json_encode($this->admin->add($lecturer));
            }
        } else {
            if ($data !== null) {
                $lecturer = $data;
            } else {
                if (isset($_GET['num'])) {
                    $_SESSION['lt-page'] = $_GET['num'];
                }
                $temp = $this->admin->view(new Lecturer());
                $page = (isset($_SESSION['lt-page'])) ? (($_SESSION['lt-page'] > $temp['numPages']) ? $temp['numPages']  : $_SESSION['lt-page']) : 1;
                // $page = (isset($_SESSION['lt-page'])) ? $_SESSION['lt-page'] : 1;
                $lecturer = $this->admin->view(new Lecturer(), page: $page);
            }
            $numPage = $lecturer['numPages'];
            include 'modules/admin/admin_views/lecturer.php';
        }
    }
    public function member($data = null)
    {
        if ($data !== null) {
            $members = $data;
        } else {
            if (isset($_GET['num'])) {
                $_SESSION['m-page'] = $_GET['num'];
            }
            $page = (isset($_SESSION['m-page'])) ? $_SESSION['m-page'] : 1;
            $members = $this->admin->view(new Member(), page: $page);
        }
        $numPage = $members['numPages'];
        include 'modules/admin/admin_views/member.php';
    }
    public function borrowing($data = null)
    {
        if ($data !== null) {
            $borrowing = $data;
        } else {
            if (isset($_GET['num'])) {
                $_SESSION['br-page'] = $_GET['num'];
            }
            $page = (isset($_SESSION['br-page'])) ? $_SESSION['br-page'] : 1;
            $borrowing = $this->admin->viewBorrowing(page: $page);
        }
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
                    echo json_encode($this->admin->add($shelf));
                } else if (isset($_POST['delete'])) {
                    /**
                     * Delete Shelf
                     */
                    $id = $_POST['id'];
                    $shelf = new Shelf($id);
                    echo json_encode($this->admin->delete($shelf));
                } else {
                    /**
                     * Edit Shelf
                     */
                    $id = $_POST['id'];
                    $keterangan = $_POST['keterangan'];
                    $shelf->setShelfId($id);
                    $shelf->setCategories($keterangan);
                    echo json_encode($this->admin->save($shelf));
                }
            }
        } else {
            /**
             * View Shelf
             */
            if ($data !== null) {
                $shelf = $data;
            } else {
                $temp = $this->admin->view(new Shelf());
                if (isset($_GET['num'])) {
                    $_SESSION['shelf-page'] = $_GET['num'];
                }
                $page = (isset($_SESSION['shelf-page'])) ? (($_SESSION['shelf-page'] > $temp['numPages']) ? $temp['numPages']  : $_SESSION['shelf-page']) : 1;
                // $page = (isset($_SESSION['shelf-page'])) ? $_SESSION['shelf-page'] : 1;
                $shelf = $this->admin->view(new shelf(), page: $page);
            }
            $numPage = $shelf['numPages'];
            include 'modules/admin/admin_views/shelf.php';
        }
    }
}
