<?php
include 'Readable.php';
include 'Publisher.php';
include 'Category.php';
include 'Author.php';
include 'Shelf.php';
require_once 'IManage.php';
// include 'core/Database.php';
class Book extends Readable implements IManage
{
        private $isbn;
        private Publisher $publisher;
        private Category $category;
        private Author $author;
        private $stock;
        private $ddc_code;
        private $synopsis;

        function __construct($id = null)
        {
                if (!$id == null) {
                        $result = Database::query("SELECT * FROM book WHERE book_id='$id'")->fetch_assoc();
                        // $book = new Book();
                        $this->id = $result['book_id'];
                        $this->title = $result['book_title'];
                        $this->year = $result['year_published'];
                        $this->avail = $result['avail'];
                        $this->cover = $result['cover'];
                        $this->setShelf($result['shelf_id']);

                        $this->isbn = $result['isbn'];
                        $this->publisher = new Publisher($result['publisher_id']);
                        $this->category = new Category($result['category_id']);
                        $this->author = new Author($result['author_id']);
                        $this->stock = $result['stock'];
                        $this->ddc_code = $result['ddc_code'];
                        $this->synopsis = $result['synopsis'];
                }
        }

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
        public function getBooks(array $range, $sort = 'default'): array
        {
                $filter = $_SESSION['filters'];
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
                                if (count($filter) > 1 && $i != count($filter) - 1) {
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
        public function getAllBook($page): array
        {
                $book = array();
                $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
                $limit = LIMIT_ROWS_PER_PAGE;
                $query = "SELECT book_id FROM book ORDER BY book_id LIMIT $limit OFFSET $start";
                $result = Database::query($query);
                while ($id = $result->fetch_column()) {
                        $book[] = $this->getDetails($id);
                }
                return [$book, $start, $start + count($book)];
        }

        public function count()
        {
                return (int) Database::query("SELECT count(book_id) FROM book")->fetch_column();
        }

        public function getAllYearPublished(): array
        {
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

        public function add($arg)
        {
        }
        public function view(int $page, string $search)
        {
                $book = array();
                $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
                $limit = LIMIT_ROWS_PER_PAGE;
                $query = "SELECT book_id FROM book ORDER BY book_id LIMIT $limit OFFSET $start";
                $result = Database::query($query);
                while ($id = $result->fetch_column()) {
                        $book[] = $this->getDetails($id);
                }
                $result = array(
                        'page' => $page,
                        'countAll' => $this->count(),
                        'start' => $start,
                        'end' => $start + count($book),
                        'data' => $book
                );
                return $result;
        }
        public function save()
        {
        $query = "
            UPDATE book
            SET
                book_title = ?,
                year_published = ?,
                avail = ?,
                cover = ?,
                shelf_id = ?,
                isbn = ?,
                publisher_id = ?,
                category_id = ?,
                author_id = ?,
                stock = ?,
                ddc_code = ?,
                synopsis = ?
            WHERE book_id = ?
        ";

                $parameters = [
                        $this->title,
                        $this->year,
                        $this->avail,
                        $this->cover,
                        $this->shelf->getShelfId(),
                        $this->isbn,
                        $this->publisher->getId(),
                        $this->category->getId(),
                        $this->author->getId(),
                        $this->stock,
                        $this->ddc_code,
                        $this->synopsis,
                        $this->id,
                ];

                $statement = Database::prepare($query);

                // Dynamically bind parameters
                $types = 'ssissssssisss';
                $statement->bind_param($types, ...$parameters);

                $statement->execute();
        }
        public function delete()
        {
                $query = "DELETE FROM book WHERE book_id = ?";
                $parameters = [
                        $this->id
                ];
                $statement = Database::prepare($query);
                $type = 's';
                $statement->bind_param($type, ...$parameters);

                $statement->execute();
        }

        /**
         * Get the value of author
         */
        public function getAuthor()
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
}
