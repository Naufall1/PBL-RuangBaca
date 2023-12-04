<?php
    class Borrowing {

        private $id;
        private $member_id;
        private $reserve_date;
        private $due_date;
        private $return_date;
        private $status;
        private $penalty;

        function __construct($id=null) {
            // var_dump($id);
            if (isset($id)) {
                $res = Database::query("SELECT * FROM borrowing WHERE BORROWING_ID='$id'")->fetch_assoc();
                // var_dump($res['BORROWING_ID']);
                $this->id = $res['BORROWING_ID'];
                $this->member_id = $res['member_id'];
                $this->reserve_date = $res['reserve_date'];
                $this->due_date = $res['due_date'];
                $this->return_date = $res['return_date'];
                $this->status = $res['status'];
                $this->penalty = $res['penalty'];
            }
        }
        public function getAllBorrowing($page){
            $borrowing = array();
            $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
            $limit = LIMIT_ROWS_PER_PAGE;
            $query = "SELECT BORROWING_ID FROM borrowing ORDER BY BORROWING_ID LIMIT $limit OFFSET $start";
            $result = Database::query($query);
            while ($id = $result->fetch_column()) {
                $borrowing[] = new Borrowing($id);
            }
            return [$borrowing, $start, $start+count($borrowing)];
        }

        public function count(){
            return (int) Database::query("SELECT count(BORROWING_ID) FROM borrowing")->fetch_column();
        }

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        public function getMember(): Member{
            return new Member($this->member_id);
        }

        /**
         * Get the value of reserve_date
         */
        public function getReserveDate()
        {
                return $this->reserve_date;
        }

        /**
         * Get the value of status
         */
        public function getStatus()
        {
                return $this->status;
        }
    }
?>