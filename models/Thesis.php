<?php
// include 'Readable.php';
class Thesis extends Readable implements IManage
{
    private $writer_name;
    private $writer_nim;
    private $dospem;

    function __construct($id = null)
    {
        if (!$id == null) {
            $result = Database::query("SELECT t.*,GROUP_CONCAT(l.lecturer_name) as dospem
                from thesis as t
                join dospem as dp on t.thesis_id = dp.thesis_id
                JOIN lecturer as l ON dp.nidn=l.NIDN
                WHERE t.thesis_id  ='$id'
                GROUP BY t.thesis_id;
            ")->fetch_assoc();
            $this->id = $result['thesis_id'];
            $this->title = $result['thesis_title'];
            $this->year = $result['year_published'];
            $this->avail = $result['avail'];
            $this->cover = $result['cover'];
            $this->setShelf($result['shelf_id']);
            $this->writer_name = $result['writer_name'];
            $this->writer_nim = $result['writer_NIM'];
            $this->dospem = $result['dospem'];
        }
    }
    public function getDetails($id): Thesis
    {
        $result = Database::query("SELECT t.*,GROUP_CONCAT(l.lecturer_name) as dospem
            from thesis as t
            join dospem as dp on t.thesis_id = dp.thesis_id
            JOIN lecturer as l ON dp.nidn=l.NIDN
            WHERE t.thesis_id  ='$id'
            GROUP BY t.thesis_id;
        ")->fetch_assoc();

        $thesis = new Thesis();
        $thesis->id = $result['thesis_id'];
        $thesis->title = $result['thesis_title'];
        $thesis->year = $result['year_published'];
        $thesis->avail = $result['avail'];
        $thesis->cover = $result['cover'];
        $thesis->setShelf($result['shelf_id']);
        $thesis->writer_name = $result['writer_name'];
        $thesis->writer_nim = $result['writer_NIM'];
        $thesis->dospem = $result['dospem'];
        return $thesis;
    }

    public function getThesis(array $range, $sort = 'default'): array
    {
        $filter = $_SESSION['filters'];
        $query = 'SELECT thesis_id FROM thesis ';
        $sort_query = array(
            'default' => '',
            'title' => ' ORDER BY thesis.thesis_title ',
            'year' => ' ORDER BY thesis.year_published DESC '
        );

        if (count($filter) > 0) {
            $query = $query . ' WHERE ';
        }

        $i = 0;
        // var_dump($filter);
        foreach ($filter as $key => $value) {
            if ($key == 'category' || $key == 'author' || $key == 'publisher') {
                return [];
            }

            if ($key != 'jenis') {
                # code...
                $query = $query . $value;
                if (count($filter) > 1 && $i != count($filter) - 1) {
                    $query = $query . ' AND';
                }
                $i++;
            } else {
                $query = str_replace('WHERE', '', $query);
            }
        }

        $query = $query . $sort_query[$sort];


        $query = $query . " LIMIT $range[1] OFFSET $range[0]";

        // var_dump($query);
        $thesis = array();
        $res = Database::query($query);
        // var_dump($res->fetch_all());
        while ($row = $res->fetch_assoc()) {
            $thesis[] = $this->getDetails($row['thesis_id']);
        }
        if ($thesis != null) {
            return $thesis;
        } else {
            return [];
        }

        // var_dump($thesis);
    }

    /**
     * Get the value of writer_name
     */
    public function getAuthor(): Author
    {
        $author = new Author();
        $author->setAuthorId($this->writer_nim);
        $author->setAuthorName($this->writer_name);
        return $author;
    }

    /**
     * Get the value of writer_nim
     */
    public function getWriterNim()
    {
        return $this->writer_nim;
    }

    public function getAllYearPublished(): array
    {
        $years = array();
        $res = Database::query("SELECT DISTINCT year_published FROM thesis ORDER BY year_published DESC");

        while ($row = $res->fetch_assoc()) {
            $years[] = $row["year_published"];
        }

        return $years;
    }

    public function getAllThesis($page): array
    {
        $thesis = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT thesis_id FROM thesis ORDER BY thesis_id LIMIT $limit OFFSET $start";
        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $thesis[] = $this->getDetails($id);
        }
        return [$thesis, $start, $start + count($thesis)];
    }

    public function count()
    {
        return (int) Database::query("SELECT count(thesis_id) FROM thesis")->fetch_column();
    }

    public function view(int $page, string $search)
    {
        $thesis = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT thesis_id FROM thesis ORDER BY thesis_id LIMIT $limit OFFSET $start";
        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $thesis[] = $this->getDetails($id);
        }
        $result = array(
            'page' => $page,
            'countAll' => $this->count(),
            'start' => $start,
            'end' => $start + count($thesis),
            'data' => $thesis
        );
        return $result;
    }
    public function add($arg)
    {
    }
    public function save()
        {
        $query = "
            UPDATE thesis
            SET
                thesis_title = ?,
                year_published = ?,
                avail = ?,
                cover = ?,
                shelf_id = ?,
                writer_name = ?,
                writer_NIM = ?
            WHERE thesis_id = ?
        ";

                $parameters = [
                        $this->title,
                        $this->year,
                        $this->avail,
                        $this->cover,
                        $this->shelf->getShelfId(),
                        $this->writer_name,
                        $this->writer_NIM,
                        $this->id,
                ];

                $statement = Database::prepare($query);

                // Dynamically bind parameters
                $types = 'ssisssss';
                $statement->bind_param($types, ...$parameters);

                $statement->execute();
        }
    public function delete()
    {
    }

    public function toJSON()
    {
        $jsonArray = [
            'id' => $this->id,
            'title' => $this->title,
            'year' => $this->year,
            'avail' => $this->avail,
            'cover' => $this->cover,
            'shelf' => $this->shelf->getShelfId(), // Jika Shelf juga memiliki metode toJSON
            'writer_name' => $this->writer_name,
            'writer_nim' => $this->writer_nim,
            'dospem' => $this->dospem
        ];

        return json_encode($jsonArray);
    }
}
