<?php
    include 'models/Catalog.php';
    class CatalogController {
        private Catalog $catalog;

        function __construct(){
            $this->catalog = new Catalog(MAX_NUMS_ITEM);
        }

        function getContent(){
            $page = 1;
            if (isset($_POST['sort'])) {
                $books = $this->catalog->getContent($page, $_POST['sort']);
            } else {
                $books = $this->catalog->getContent($page, '');
            }
            include 'modules/catalog/catalog_view/book.template.php';
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


    }
?>