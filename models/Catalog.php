<?php
    // include 'Readable.php';
    include 'IFilter.php';
    include 'ISearch.php';
    include 'Book.php';
    // include 'Thesis.php';
    class Catalog implements IFilter, ISearch {
        private $readable = array();
        private int $max;

        function __construct(int $max){
            $this->readable[] = new Book();
            // $this->readable[] = new Thesis();
            $this->max = $max;
        }

        public function filter(){

        }
        public function search($query){

        }
        public function getContent(int $page){
            $book = new Book();
            $start = ($page * $this->max) - $this->max;
            $end = $page * $this->max-10;
            return $book->getBooks([$start, $end]);
        }
    }
?>