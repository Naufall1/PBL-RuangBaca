<?php
// include '../core/Database.php';
class Category implements IManage
{
    private $category_id;
    private $category_name;
    function __construct($category_id = null)
    {
        if (!is_null($category_id)) {
            $res = Database::query("SELECT * FROM category WHERE category_id='$category_id'")->fetch_assoc();
            $this->category_id = $res['category_id'];
            $this->category_name = $res['category_name'];
        }
    }
    function add()
    {
        try {
            $prefix = 'CAT';
            $len = 6;
            $res = Database::query("SELECT category_id FROM category ORDER BY category_id DESC LIMIT 1")->fetch_array();
            $prevId = intval(substr($res[0], 3, 5));
            $id = $prefix . str_pad($prevId + 1, $len - strlen($prefix), "0", STR_PAD_LEFT);

            $query = "
                INSERT INTO category
                (
                    category_id,
                    category_name
                )
                VALUES
                (
                    ?,
                    ?
                )
            ";

            $parameters = [
                $id,
                $this->category_name,
            ];

            $statement = Database::prepare($query);

            // Dynamically bind parameters
            $types = 'ss';
            $statement->bind_param($types, ...$parameters);

            if (!$statement->execute()) {
                throw new Exception("Error executing statement: " . $statement->error);
            }
            $this->category_id = $id;
            return array(
                'status' => 'success',
                'message' => 'Berhasil Menambahkan Category.'
            );
        } catch (Exception $th) {
            return array(
                'status' => 'failed',
                'message' => 'Gagal Menambahkan Category.',
                'error' => $th->getMessage(),
            );
        }
    }

    public function count()
    {
        return (int) Database::query("SELECT count(category_id) FROM category")->fetch_column();
    }
    public function view(int $page, string $search)
    {
        $category = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT category_id FROM category";

        if ($search != '') {
            $query = $query . " WHERE category_name LIKE '%" . $search . "%'";
        }

        $query = $query . " ORDER BY category_id LIMIT $limit OFFSET $start";

        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $category[] = new Category($id);
        }
        $result = array(
            'page' => $page,
            'countAll' => $this->count(),
            'start' => $start,
            'end' => $start + count($category),
            'numPages' => ceil($this->count() / LIMIT_ROWS_PER_PAGE),
            'data' => $category
        );
        return $result;
    }
    public function save()
    {
        try {
            $query = "
                UPDATE category
                SET
                    category_name = ?
                WHERE category_id = ?
            ";

            $parameters = [
                $this->category_name,
                $this->category_id
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
                'message' => 'Berhasil Edit Category.'
            );
        } catch (Exception $th) {
            return array(
                'status' => 'failed',
                'message' => 'Gagal Edit Category.',
                'error' => $th->getMessage(),
            );
        }
    }
    public function delete()
    {
        try {
            $query = "DELETE FROM category WHERE category_id = ?";
            $parameters = [
                $this->category_id
            ];
            $statement = Database::prepare($query);
            $type = 's';
            $statement->bind_param($type, ...$parameters);

            if (!$statement->execute()) {
                throw new Exception("Error executing statement: " . $statement->error);
            }
            return array(
                'status' => 'success',
                'message' => 'Berhasil Hapus Category.'
            );
        } catch (Exception $th) {
            return array(
                'status' => 'failed',
                'message' => 'Gagal Hapus Category.',
                'error' => $th->getMessage(),
            );
        }
    }

    public function getId()
    {
        return $this->category_id;
    }

    public function getCategoryName()
    {
        return $this->category_name;
    }
    public static function getAll(): mysqli_result
    {
        $res = Database::query("SELECT * FROM category");
        return $res;
    }

    /**
     * Set the value of category_name
     */
    public function setCategoryName($category_name): self
    {
        $this->category_name = $category_name;

        return $this;
    }
}
