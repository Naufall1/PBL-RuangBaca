<?php
    // include 'core/Database.php';
    class Publisher {
        private $publisher_id;
        private $publisher_name;
        function __construct($publisher_id=null) {
            if (!is_null($publisher_id)) {
                $res = Database::query("SELECT * FROM publisher WHERE publisher_id='$publisher_id'")->fetch_assoc();
                $this->publisher_id = $res['publisher_id'];
                $this->publisher_name = $res['publisher_name'];
            }
        }
        function add($publisher_name) {
            $prefix = 'PUB';
            $len = 6;
            $res = Database::query("SELECT publisher_id FROM publisher ORDER BY publisher_id DESC LIMIT 1")->fetch_array();
            $prevId = intval(substr($res[0], 3, 5));
            $id = $prefix . str_pad($prevId+1, $len - strlen($prefix), "0", STR_PAD_LEFT);
            Database::query("INSERT INTO publisher (publisher_id, publisher_name) VALUES ('$id', '$publisher_name')");
            return $id;
        }

        public function getAllPublisher($page) {
            $publisher = array();
            $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
            $limit = LIMIT_ROWS_PER_PAGE;
            $query = "SELECT publisher_id FROM publisher ORDER BY publisher_id LIMIT $limit OFFSET $start";
            $result = Database::query($query);
            while ($id = $result->fetch_column()) {
                $publisher[] = new Publisher($id);
            }
            return [$publisher, $start, $start+count($publisher)];
        }

        public function getId()
        {
            return $this->publisher_id;
        }

        public function getPublisherName()
        {
            return $this->publisher_name;
        }

        public static function getAll(): mysqli_result{
            $res = Database::query("SELECT * FROM publisher");
            return $res;
        }
    }

    // $p = new Publisher();
    // var_dump($p);
    // $p->add('testAdd');
?>