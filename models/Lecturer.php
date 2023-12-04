<?php
    class Lecturer {
        private string $nidn;
        private string $name;

        function __construct($id =  null){
            if (!is_null($id)) {
                $res = Database::query("SELECT * FROM lecturer WHERE NIDN='$id'")->fetch_assoc();
                $this->nidn = $res['NIDN'];
                $this->name = $res['lecturer_name'];
            }
        }

        public function getAllLecturer($page){
            $lecturer = array();
            $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
            $limit = LIMIT_ROWS_PER_PAGE;
            $query = "SELECT NIDN FROM lecturer ORDER BY lecturer_name LIMIT $limit OFFSET $start";
            $result = Database::query($query);
            while ($id = $result->fetch_column()) {
                $lecturer[] = new Lecturer($id);
            }
            return [$lecturer, $start, $start+count($lecturer)];
        }

        public function count(){
            return (int) Database::query("SELECT count(NIDN) FROM lecturer")->fetch_column();
        }

        /**
         * Get the value of nidn
         */
        public function getNidn(): string
        {
                return $this->nidn;
        }

        /**
         * Get the value of name
         */
        public function getName(): string
        {
                return $this->name;
        }
    }
?>