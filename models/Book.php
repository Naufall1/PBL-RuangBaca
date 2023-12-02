<?php
include 'Readable.php';
include 'Publisher.php';
include 'Category.php';
include 'Author.php';
include 'Shelf.php';
// include 'core/Database.php';
class Book extends Readable
{
        private $isbn;
        private Publisher $publisher;
        private Category $category;
        private Author $author;
        private $stock;
        private $ddc_code;
        private $synopsis;

        function getDetails($id): Book
        {
                $result = Database::query("SELECT * FROM book WHERE book_id='$id'")->fetch_assoc();
                $book = new Book();
                $book->id = $result['book_id'];
                $book->title = $result['book_title'];
                $book->year = $result['year_published'];
                $book->avail = $result['avail'];
                $book->cover = $result['cover'];
                $book->setShelf($result['shelf_id']);

                $book->isbn = $result['isbn'];
                $book->publisher = new Publisher($result['publisher_id']);
                $book->category = new Category($result['category_id']);
                $book->author = new Author($result['author_id']);
                $book->stock = $result['stock'];
                $book->ddc_code = $result['ddc_code'];
                $book->synopsis = $result['synopsis'];
                return $book;
        }
        public function getBooks(array $range, $sort='default'): array
        {
                $filter=$_SESSION['filters'];
                $query = 'SELECT book_id FROM book ';
                $sort_query = array(
                        'default' => '',
                        'title' => ' ORDER BY book.book_title ',
                        'year' => ' ORDER BY book.year_published DESC '
                );
                if (count($filter) > 0) {
                        $query = $query . ' WHERE ';
                }

                $i = 0;
                // var_dump($filter);
                foreach ($filter as $key => $value) {
                        if ($key != 'jenis') {
                                # code...
                                $query = $query . $value;
                                if (count($filter) > 1 && $i != count($filter)-1) {
                                        $query = $query . ' AND';
                                }
                                $i++;
                        } else {
                                $query = str_replace('WHERE', '', $query);
                        }
                }

                $query = $query . $sort_query[$sort];

                $query = $query . " LIMIT $range[1] OFFSET $range[0]";

                // var_dump($query);

                $books = array();
                $res = Database::query($query);
                while ($row = $res->fetch_assoc()) {
                        $books[] = $this->getDetails($row['book_id']);
                }
                if ($books != null) {
                        return $books;
                    } else {
                        return [];
                    }
        }

        public function getAllYearPublished(): array{
                $years = array();
                $res = Database::query("SELECT DISTINCT year_published FROM book ORDER BY year_published DESC");
                while ($row = $res->fetch_assoc()) {
                        $years[] = $row["year_published"];
                }
                // var_dump($years);

                return $years;
        }

        public function toJSON()
        {

                $jsonArray = [
                        'id' => $this->id,
                        'title' => $this->title,
                        'year' => $this->year,
                        'avail' => $this->avail,
                        'cover' => $this->cover,
                        'shelf' => $this->shelf->getShelfId(),
                        'isbn' => $this->isbn,
                        'publisher' => $this->publisher->getPublisherName(),
                        'category' => $this->category->getCategoryName(),
                        'author' => $this->author->getAuthorName(),
                        'stock' => $this->stock,
                        'ddc_code' => $this->ddc_code,
                        'synopsis' => $this->synopsis,
                ];

                return json_encode($jsonArray);
        }

        /**
         * Get the value of isbn
         */
        public function getIsbn()
        {
                return $this->isbn;
        }

        /**
         * Get the value of publisher
         */
        public function getPublisher(): Publisher
        {
                return $this->publisher;
        }

        /**
         * Get the value of category
         */
        public function getCategory(): Category
        {
                return $this->category;
        }

        /**
         * Get the value of author
         */
        public function getAuthor(): Author
        {
                return $this->author;
        }

        /**
         * Get the value of stock
         */
        public function getStock()
        {
                return $this->stock;
        }

        /**
         * Get the value of ddc_code
         */
        public function getDdcCode()
        {
                return $this->ddc_code;
        }

        /**
         * Get the value of synopsis
         */
        public function getSynopsis()
        {
                return $this->synopsis;
        }
}
