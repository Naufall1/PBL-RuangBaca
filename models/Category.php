<?php
    // include '../core/Database.php';
    class Category {
        private $category_id;
        private $category_name;
        function __construct($category_id=null) {
            if (!is_null($category_id)) {
                $res = Database::query("SELECT * FROM category WHERE category_id='$category_id'")->fetch_assoc();
                $this->category_id = $res['category_id'];
                $this->category_name = $res['category_name'];
            }
        }
        function add($category_name) {
            $prefix = 'PUB';
            $len = 6;
            $res = Database::query("SELECT category_id FROM category ORDER BY category_id DESC LIMIT 1")->fetch_array();
            $prevId = intval(substr($res[0], 3, 5));
            $id = $prefix . str_pad($prevId+1, $len - strlen($prefix), "0", STR_PAD_LEFT);
            Database::query("INSERT INTO category (category_id, category_name) VALUES ('$id', '$category_name')");
            return $id;
        }

        public function getCategoryId()
        {
            return $this->category_id;
        }

        public function getCategoryName()
        {
            return $this->category_name;
        }
    }
?>