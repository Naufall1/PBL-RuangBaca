<?php
    include 'models/Catalog.php';
    class CatalogController {
        private Catalog $catalog;

        function __construct(){
            $this->catalog = new Catalog(MAX_NUMS_ITEM);
        }

        function getContent(){
            $page = 1;
            $books = $this->catalog->getContent($page);
            include 'modules/catalog/catalog_view/book.template.php';
        }


    }
?>