<?php
    require_once 'core/Database.php';

    class GuestRepository {

        private $curLenBook;

        public function getBooks() {
            $books = Database::query("SELECT book_title, a.author_name, year_published, avail, cover, book_id, stock FROM `book` as b INNER JOIN author as a ON b.author_id = a.author_id;");
            $this->curLenBook = $books->num_rows;
            return $books;
        }

        public function getCountAllBooks() {
            $count = Database::query("SELECT count(*) FROM `book`");
            return $count->fetch_array()[0];
        }

        /**
         * Get the value of curLenBook
         */
        public function getCurLenBook()
        {
            return $this->curLenBook;
        }

        public function getBookDetails($book_id) {
            $book = Database::query("SELECT * FROM `book` as b INNER JOIN author as a ON b.author_id = a.author_id WHERE b.book_id = '$book_id';");
            return $book->fetch_assoc();
        }
    }
?>