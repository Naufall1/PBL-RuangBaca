<?php
    // include 'Readable.php';
    include 'IFilter.php';
    include 'ISearch.php';
    include 'Book.php';
    include 'Thesis.php';

    // include 'Thesis.php';
    class Catalog implements IFilter, ISearch {
        private $readable;
        private int $max;

        function __construct(int $max){
            $this->readable = array(
                'book' => new Book(),
                'thesis' => new Thesis(),
            );
            $this->max = $max;
        }

        public function filter(){

        }
        public function search($query){

        }
        public function getContent(int $page, string $sort){
            $content = array();
            $book = new Book();
            $thesis = new Thesis();
            $start = ($page * $this->max) - $this->max;

            $content = array_merge($book->getBooks([$start, $this->max / 2]), $thesis->getThesis([$start, $this->max / 2]));
            if ($sort == 'title') {
                $content = $this->sortByTitle($content);
            } else if ($sort == 'year') {
                $content = $this->sortByYear($content);
            }
            return $content;
        }
        public function bookDesc($id): Readable{
            return $this->readable['book']->getDetails($id);
        }
        public function thesisDesc($id): Readable{
            return $this->readable['thesis']->getDetails($id);
        }

        private function sortByTitle(array $readable){
            usort($readable, fn($a, $b) => strcmp($a->getTitle(), $b->getTitle()));
            return $readable;
        }

        private function sortByYear(array $readable){
            // usort($readable, ['Catalog', 'compareYears']);
            usort($readable, fn($a, $b) => ($b->getYear() - $a->getYear()) );
            return $readable;
        }
    }
?>