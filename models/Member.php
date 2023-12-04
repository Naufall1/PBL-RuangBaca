<?php
    class Member extends User {
        private $id;
        private $nim;
        private $name;

        function __construct($id = null){
            if (!is_null($id)) {
                $res = Database::query("SELECT * FROM member WHERE member_id='$id'")->fetch_assoc();
                $this->id = $res['member_id'];
                $this->nim = $res['nim'];
                $this->name = $res['member_name'];
            }
        }

        public function register($username, $password, $level, $name, $nim) {

        }

        public function getAllMembers($page){
            $members = array();
            $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
            $limit = LIMIT_ROWS_PER_PAGE;
            $query = "SELECT member_id FROM member ORDER BY member_id LIMIT $limit OFFSET $start";
            $result = Database::query($query);
            while ($id = $result->fetch_column()) {
                $members[] = new Member($id);
            }
            return [$members, $start, $start+count($members)];
        }

        public function count(){
            return (int) Database::query("SELECT count(member_id) FROM member")->fetch_column();
        }


        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Get the value of nim
         */
        public function getNim()
        {
                return $this->nim;
        }

        /**
         * Get the value of name
         */
        public function getName()
        {
                return $this->name;
        }
    };
?>