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

        public function getAllCategory($page){
            $authors = array();
            $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
            $limit = LIMIT_ROWS_PER_PAGE;
            $query = "SELECT category_id FROM category ORDER BY category_id LIMIT $limit OFFSET $start";
            $result = Database::query($query);
            while ($id = $result->fetch_column()) {
                $authors[] = new Category($id);
            }
            return [$authors, $start, $start+count($authors)];
        }

        public function getId()
        {
            return $this->category_id;
        }

        public function getCategoryName()
        {
            return $this->category_name;
        }
        public static function getAll(): mysqli_result{
            $res = Database::query("SELECT * FROM category");
            return $res;
        }
    }
?>