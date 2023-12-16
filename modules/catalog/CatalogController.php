<?php
    include 'models/Catalog.php';
    // include 'models/Shelf.php';
    class CatalogController {
        private Catalog $catalog;

        function __construct(){
            $this->catalog = new Catalog(MAX_NUMS_ITEM);
        }

        function getContent(){
            if (isset($_POST['page'])) {
                $page1 = $_POST['page'];
                if ($page1 > ceil($_SESSION['countResult'] / MAX_NUMS_ITEM)) {
                    $page1 = ceil($_SESSION['countResult'] / MAX_NUMS_ITEM);
                } else if ($page1 < 1) {
                    $page1 = 1;
                }
                $_SESSION['page'] = $page1;
            } else if(isset($_SESSION['page'])) {
                $page1 = $_SESSION['page'];
            } else {
                $page1 = 1;
                $_SESSION['page'] = $page1;
            }

            if (isset($_POST['sort'])) {
                $_SESSION['sort'] = $_POST['sort'];
                $books = $this->catalog->getContent($page1, $_SESSION['sort']);
            } else {
                $books = $this->catalog->getContent($page1, $_SESSION['sort']);
            }
            include 'modules/catalog/catalog_view/book.template.php';
        }

        function getFilters() {
            include 'modules/catalog/catalog_view/filter.template.php';
        }

        function getDesc(){
            if (isset($_POST['book_id'])) {
                echo $this->catalog->bookDesc($_POST['book_id'])->toJSON();
            } else if (isset($_POST['thesis_id'])) {
                echo $this->catalog->thesisDesc($_POST['thesis_id'])->toJSON();
            } else {
                echo 'Not Found';
            }

        }

        function filter(){
            $this->catalog->filter(json_decode($_POST['filter'], true));
            $this->getContent();
        }

        function search(){
            if (isset($_POST['q'])) {
                // $books = $this->catalog->getContent($_COOKIE['page'], $_SESSION['sort'], $_POST['q']);
                $books = $this->catalog->search($_POST['q']);
                include 'modules/catalog/catalog_view/book.template.php';
            }
        }


    }
?>