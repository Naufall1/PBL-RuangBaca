<?php
    // include '../core/Database.php';
    class Author {
        private $author_id;
        private $author_name;

        function __construct($author_id=null) {
            if (!is_null($author_id)) {
                $res = Database::query("SELECT * FROM author WHERE author_id='$author_id'")->fetch_assoc();
                $this->author_id = $res['author_id'];
                $this->author_name = $res['author_name'];
            }
        }
        function add($author_name) {
            $prefix = 'PUB';
            $len = 6;
            $res = Database::query("SELECT author_id FROM author ORDER BY author_id DESC LIMIT 1")->fetch_array();
            $prevId = intval(substr($res[0], 3, 5));
            $id = $prefix . str_pad($prevId+1, $len - strlen($prefix), "0", STR_PAD_LEFT);
            Database::query("INSERT INTO author (author_id, author_name) VALUES ('$id', '$author_name')");
            return $id;
        }

        public function getAuthorId()
        {
            return $this->author_id;
        }

        public function getAuthorName()
        {
            return $this->author_name;
        }
    }
?>