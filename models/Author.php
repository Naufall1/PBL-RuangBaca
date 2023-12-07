<?php
require_once 'IManage.php';
class Author implements IManage
{
    private $author_id;
    private $author_name;

    function __construct($author_id = null)
    {
        if (!is_null($author_id)) {
            $res = Database::query("SELECT * FROM author WHERE author_id='$author_id'")->fetch_assoc();
            $this->author_id = $res['author_id'];
            $this->author_name = $res['author_name'];
        }
    }

    public function count()
    {
        return (int) Database::query("SELECT count(author_id) FROM author")->fetch_column();
    }

    function view(int $page, string $search)
    {
        $author = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT author_id FROM author ORDER BY author_id LIMIT $limit OFFSET $start";
        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $author[] = new Author($id);
        }
        $result = array(
            'page' => $page,
            'countAll' => $this->count(),
            'start' => $start,
            'end' => $start + count($author),
            'data' => $author
        );
        return $result;
    }
    function save()
    {
        $query = "
            UPDATE author
            SET
                author_name = ?,
            WHERE author_id = ?
        ";

                $parameters = [
                        $this->author_id,
                        $this->author_name,
                ];

                $statement = Database::prepare($query);

                // Dynamically bind parameters
                $types = 'ss';
                $statement->bind_param($types, ...$parameters);

                $statement->execute();
        }
    function delete()
    {
        $query = "DELETE FROM author WHERE author_id = ?";
                $parameters = [
                        $this->author_id
                ];
                $statement = Database::prepare($query);
                $type = 's';
                $statement->bind_param($type, ...$parameters);

                $statement->execute();
    }
    function add($arg)
    {
        $prefix = 'PUB';
        $len = 6;
        $res = Database::query("SELECT author_id FROM author ORDER BY author_id DESC LIMIT 1")->fetch_array();
        $prevId = intval(substr($res[0], 3, 5));
        $id = $prefix . str_pad($prevId + 1, $len - strlen($prefix), "0", STR_PAD_LEFT);
        Database::query("INSERT INTO author (author_id, author_name) VALUES ('$id', '$arg')");
        return $id;
    }

    public function getAllAuthor($page): array
    {
        $authors = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT author_id FROM author ORDER BY author_id LIMIT $limit OFFSET $start";
        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $authors[] = new Author($id);
        }
        return [$authors, $start, $start + count($authors)];
    }

    public function getId()
    {
        return $this->author_id;
    }

    public function getAuthorName()
    {
        return $this->author_name;
    }

    /**
     * Set the value of author_name
     */
    public function setAuthorName($author_name): self
    {
        $this->author_name = $author_name;
        return $this;
    }

    /**
     * Set the value of author_id
     */
    public function setAuthorId($author_id): self
    {
        $this->author_id = $author_id;
        return $this;
    }

    public static function getAll(): mysqli_result
    {
        $res = Database::query("SELECT * FROM author");
        return $res;
    }
}
