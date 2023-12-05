<?php
    require_once 'models/Lecturer.php';
    require_once 'models/Borrowing.php';
    class Admin extends User {

        function __construct(){
            if (!$this->isAdmin()){
                // die('Error Permission denied');
            }
        }

        // Manage Book
        function viewBooks($page = 1): array{
            // $book = new Book();
            // return $book->getAllBook(); //get all books, return array Book object

            $book = new Book();
            $results = $book->getAllBook($page);
            $result = array(
                'page' => $page,
                'countAll' => $book->count(),
                'start' => $results[1],
                'end' => $results[2],
                'data' => $results[0]
            );
            return $result;
        }
        function editBook() {

        }
        function deleteBook() {

        }

        //Manage Author
        function viewAuthors($page = 1): array{
            $author = new Author();
            $results = $author->getAllAuthor($page);
            $result = array(
                'page' => $page,
                'countAll' => count(Author::getAll()->fetch_all()),
                'start' => $results[1],
                'end' => $results[2],
                'data' => $results[0]
            );
            return $result;
        }
        function editAuthor() {

        }
        function deleteAuthor() {

        }

        // Manage Publisher
        function viewPublishers($page = 1): array{
            $author = new Publisher();
            $results = $author->getAllPublisher($page);
            $result = array(
                'page' => $page,
                'countAll' => count(Publisher::getAll()->fetch_all()),
                'start' => $results[1],
                'end' => $results[2],
                'data' => $results[0]
            );
            return $result;
        }
        function editPublisher() {

        }
        function deletePublisher() {

        }
        function viewCategories($page = 1): array{
            $category = new Category();
            $results = $category->getAllCategory($page);
            $result = array(
                'page' => $page,
                'countAll' => count(Category::getAll()->fetch_all()),
                'start' => $results[1],
                'end' => $results[2],
                'data' => $results[0]
            );
            return $result;
        }
        function editCategory() {

        }
        function deleteCategory() {

        }

        function viewThesis($page = 1): array{
            $thesis = new Thesis();
            $results = $thesis->getAllThesis($page);
            $result = array(
                'page' => $page,
                'countAll' => $thesis->count(),
                'start' => $results[1],
                'end' => $results[2],
                'data' => $results[0]
            );
            return $result;
        }
        function editThesis() {

        }
        function deleteThesis() {

        }

        function viewLecturer($page = 1): array{
            $lecturer = new Lecturer();
            $results = $lecturer->getAllLecturer($page);
            $result = array(
                'page' => $page,
                'countAll' => $lecturer->count(),
                'start' => $results[1],
                'end' => $results[2],
                'data' => $results[0]
            );
            return $result;
        }
        function editLecturer() {

        }
        function deleteLecturer() {

        }

        function viewMembers($page = 1): array{
            $member = new Member();
            $results = $member->getAllMembers($page);
            $result = array(
                'page' => $page,
                'countAll' => $member->count(),
                'start' => $results[1],
                'end' => $results[2],
                'data' => $results[0]
            );
            return $result;
        }
        function editMember() {

        }
        function deleteMember() {

        }

        function viewBorrowing($page = 1): array{
            $borrowing = new Borrowing();
            $results = $borrowing->getAllBorrowing($page);
            $result = array(
                'page' => $page,
                'countAll' => $borrowing->count(),
                'start' => $results[1],
                'end' => $results[2],
                'data' => $results[0]
            );
            return $result;
        }
        function editBorrowing() {

        }
        function deleteBorrowing() {

        }

        function viewShelf($page = 1): array{
            $shelf = new Shelf();
            $results = $shelf->getAllShelf($page);
            $result = array(
                'page' => $page,
                'countAll' => $shelf->count(),
                'start' => $results[1],
                'end' => $results[2],
                'data' => $results[0]
            );
            return $result;
        }
        function editShelf() {

        }
        function deleteShelf() {

        }


    }
?>