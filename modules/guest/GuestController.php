<?php
    require_once 'core/Database.php';
    require_once 'modules/guest/GuestRepository.php';

    class GuestController {
        private $db;

        public function __construct() {
            $this->db = new GuestRepository();
        }

        public function index() {

            // $books = $this->db->getBooks();
            // $lenBooks = $this->db->getCurLenBook();
            // $lenAllBooks = $this->db->getCountAllBooks();
            $locations = 

            include 'template/header.php';
            include 'modules/guest/guest_views/catalog.php';
            include 'template/footer.php';
        }

        public function bookDescription() {
            if (isset($_POST['book_id'])) {
                $book = $this->db->getBookDetails($_POST['book_id']);
                echo json_encode($book);
            }
        }

        public function getItems(){
            if (isset($_POST['filter'])) {

            }
        }
    }
?>