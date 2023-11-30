<?php
    // include '../core/Database.php';
    class Shelf {
        private $shelf_id;
        private $categories;
        function __construct($shelf_id=null) {
            if (!is_null($shelf_id)) {
                $res = Database::query("SELECT * FROM shelf WHERE shelf_id='$shelf_id'")->fetch_assoc();
                $this->shelf_id = $res['shelf_id'];
                $this->categories = $res['categories'];
            }
        }
        function add($categories) {
            $prefix = 'R';
            $len = 3;
            $res = Database::query("SELECT shelf_id FROM shelf ORDER BY shelf_id DESC LIMIT 1")->fetch_array();
            $prevId = intval(substr($res[0], 3, 5));
            $id = $prefix . str_pad($prevId+1, $len - strlen($prefix), "0", STR_PAD_LEFT);
            Database::query("INSERT INTO shelf (shelf_id, categories) VALUES ('$id', '$categories')");
            return $id;
        }
        function addCategory($id, $category){
            $prev = Database::query("SELECT categories FROM shelf WHERE shelf_id='$id'")->fetch_array();
            $new = $prev . ', ' . $category;
            Database::query("UPDATE shelf SET categories = '$new' WHERE shelf_id = '$id'");
        }

        public function getShelfId()
        {
            return $this->shelf_id;
        }

        public function getShelfCategories()
        {
            return $this->categories;
        }
    }
?>