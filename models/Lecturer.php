<?php
class Lecturer implements IManage
{
    private string $nidn;
    private string $name;

    function __construct($id =  null)
    {
        if (!is_null($id)) {
            $res = Database::query("SELECT * FROM lecturer WHERE NIDN='$id'")->fetch_assoc();
            $this->nidn = $res['NIDN'];
            $this->name = $res['lecturer_name'];
        }
    }

    public function count()
    {
        return (int) Database::query("SELECT count(NIDN) FROM lecturer")->fetch_column();
    }
    function view(int $page, string $search)
    {
        $lecturer = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT NIDN FROM lecturer";

        if ($search != '') {
            $query = $query . " WHERE lecturer_name LIKE '%" . $search . "%'";
        }

        $query = $query . " ORDER BY NIDN LIMIT $limit OFFSET $start";

        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $lecturer[] = new Lecturer($id);
        }
        $result = array(
            'page' => $page,
            'countAll' => $this->count(),
            'start' => $start,
            'end' => $start + count($lecturer),
            'numPages' => ceil($this->count() / LIMIT_ROWS_PER_PAGE),
            'data' => $lecturer
        );
        return $result;
    }
    public function save()
    {
        try {
            $query = "
                UPDATE lecturer
                SET
                    lecturer_name = ?
                WHERE NIDN = ?
            ";

            $parameters = [
                $this->name,
                $this->nidn,
            ];

            $statement = Database::prepare($query);

            // Dynamically bind parameters
            $types = 'ss';
            $statement->bind_param($types, ...$parameters);

            if (!$statement->execute()) {
                throw new Exception("Error executing statement: " . $statement->error);
            }
            return array(
                'status' => 'success',
                'message' => 'Berhasil Edit Dosen.'
            );
        } catch (Exception $th) {
            return array(
                'status' => 'failed',
                'message' => 'Gagal Edit Dosen.',
                'error' => $th->getMessage(),
            );
        }
    }
    public function delete()
    {
        try {
            $query = "DELETE FROM lecturer WHERE nidn = ?";
            $parameters = [
                $this->nidn
            ];
            $statement = Database::prepare($query);
            $type = 's';
            $statement->bind_param($type, ...$parameters);

            if (!$statement->execute()) {
                throw new Exception("Error executing statement: " . $statement->error);
            }
            return array(
                'status' => 'success',
                'message' => 'Berhasil Hapus Dosen.'
            );
        } catch (Exception $th) {
            return array(
                'status' => 'failed',
                'message' => 'Gagal Hapus Dosen.',
                'error' => $th->getMessage(),
            );
        }
    }
    public function add()
    {
        try {
            $query = "
                INSERT INTO lecturer
                (
                    NIDN,
                    lecturer_name
                )
                VALUES
                (
                    ?,
                    ?
                );
            ";

            $parameters = [
                $this->nidn,
                $this->name,
            ];

            $statement = Database::prepare($query);

            // Dynamically bind parameters
            $types = 'ss';
            $statement->bind_param($types, ...$parameters);

            if (!$statement->execute()) {
                throw new Exception("Error executing statement: " . $statement->error);
            }
            return array(
                'status' => 'success',
                'message' => 'Berhasil Menambahkan Dosen.'
            );
        } catch (Exception $th) {
            return array(
                'status' => 'failed',
                'message' => 'Gagal Menambahkan Dosen.',
                'error' => $th->getMessage(),
            );
        }
    }

    public static function getAll(): mysqli_result
    {
        $res = Database::query("SELECT * FROM lecturer ORDER BY lecturer_name");
        return $res;
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

    /**
     * Set the value of nidn
     */
    public function setNidn(string $nidn): self
    {
        $this->nidn = $nidn;

        return $this;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
