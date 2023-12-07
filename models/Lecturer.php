<?php
    class Lecturer implements IManage {
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
        function view(int $page, string $search)
        {
            $lecturer = array();
            $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
            $limit = LIMIT_ROWS_PER_PAGE;
            $query = "SELECT NIDN FROM lecturer ORDER BY NIDN LIMIT $limit OFFSET $start";
            $result = Database::query($query);
            while ($id = $result->fetch_column()) {
                $lecturer[] = new Lecturer($id);
            }
            $result = array(
                'page' => $page,
                'countAll' => $this->count(),
                'start' => $start,
                'end' => $start + count($lecturer),
                'data' => $lecturer
            );
            return $result;
        }
        public function save()
        {
        $query = "
            UPDATE lecturer
            SET
                lecturer_name = ?
            WHERE NIDN = ?
        ";

                $parameters = [
                        $this->nidn,
                        $this->name,
                ];

                $statement = Database::prepare($query);

                // Dynamically bind parameters
                $types = 'ss';
                $statement->bind_param($types, ...$parameters);

                $statement->execute();
        }
        public function delete(){
        $query = "DELETE FROM lecturer WHERE nidn = ?";
                $parameters = [
                        $this->nidn
                ];
                $statement = Database::prepare($query);
                $type = 's';
                $statement->bind_param($type, ...$parameters);

                $statement->execute();
        }
        public function add($arg){
            
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
