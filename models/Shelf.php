<?php
// include '../core/Database.php';
class Shelf implements IManage
{
    private $shelf_id;
    private $categories;
    function __construct($shelf_id = null)
    {
        if (!is_null($shelf_id)) {
            $res = Database::query("SELECT * FROM shelf WHERE shelf_id='$shelf_id'")->fetch_assoc();
            $this->shelf_id = $res['shelf_id'];
            $this->categories = $res['categories'];
        }
    }
    function add($categories)
    {
        $prefix = 'R';
        $len = 3;
        $res = Database::query("SELECT shelf_id FROM shelf ORDER BY shelf_id DESC LIMIT 1")->fetch_array();
        $prevId = intval(substr($res[0], 3, 5));
        $id = $prefix . str_pad($prevId + 1, $len - strlen($prefix), "0", STR_PAD_LEFT);
        Database::query("INSERT INTO shelf (shelf_id, categories) VALUES ('$id', '$categories')");
        return $id;
    }
    public function view(int $page, string $search)
    {
        $shelf = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT shelf_id FROM shelf ORDER BY shelf_id LIMIT $limit OFFSET $start";
        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $shelf[] = new Shelf($id);
        }
        $result = array(
            'page' => $page,
            'countAll' => $this->count(),
            'start' => $start,
            'end' => $start + count($shelf),
            'data' => $shelf
        );
        return $result;
    }
    public function save()
    {
        $query = "
            UPDATE shelf
            SET
                categories = ?
            WHERE shelf_id = ?
        ";

                $parameters = [
                        $this->shelf_id,
                        $this->categories,
                ];

                $statement = Database::prepare($query);

                // Dynamically bind parameters
                $types = 'ss';
                $statement->bind_param($types, ...$parameters);

                $statement->execute();
        }
    public function delete()
    {
         $query = "DELETE FROM shelf WHERE shelf_id = ?";
                $parameters = [
                        $this->shelf_id
                ];
                $statement = Database::prepare($query);
                $type = 's';
                $statement->bind_param($type, ...$parameters);

                $statement->execute();
    }
    function addCategory($id, $category)
    {
        $prev = Database::query("SELECT categories FROM shelf WHERE shelf_id='$id'")->fetch_array();
        $new = $prev . ', ' . $category;
        Database::query("UPDATE shelf SET categories = '$new' WHERE shelf_id = '$id'");
    }

    public function getAllShelf($page)
    {
        $shelf = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT shelf_id FROM shelf ORDER BY shelf_id LIMIT $limit OFFSET $start";
        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $shelf[] = new Shelf($id);
        }
        return [$shelf, $start, $start + count($shelf)];
    }

    public function count()
    {
        return (int) Database::query("SELECT count(shelf_id) FROM shelf")->fetch_column();
    }

    public function getShelfId()
    {
        return $this->shelf_id;
    }

    public function getShelfCategories()
    {
        return $this->categories;
    }

    public static function getAll(): array
    {
        $res = Database::query("SELECT shelf_id FROM shelf ORDER BY shelf_id")->fetch_all();
        return $res;
    }
}
