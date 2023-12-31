<?php
// include 'Readable.php';
class Thesis extends Readable implements IManage
{
    private $writer_name;
    private $writer_nim;
    private $dospem;
    private $prodi;
    private array $dospem2;

    function __construct($id = null)
    {
        // var_dump($id);
        $this->dospem2 = array();
        if (!$id == null) {
            $result = Database::query("SELECT t.*,GROUP_CONCAT(l.lecturer_name) as dospem
                from thesis as t
                left join dospem as dp on t.thesis_id = dp.thesis_id
                left join lecturer as l ON dp.nidn=l.NIDN
                WHERE t.thesis_id  ='$id'
                GROUP BY t.thesis_id;
            ")->fetch_assoc();
            // var_dump($id);
            $this->id = $result['thesis_id'];
            $this->title = $result['thesis_title'];
            $this->year = $result['year_published'];
            $this->avail = $result['avail'];
            $this->cover = $result['cover'];
            $this->setShelf($result['shelf_id']);
            $this->writer_name = $result['writer_name'];
            $this->writer_nim = $result['writer_NIM'];
            $this->dospem = $result['dospem'];
            $this->prodi = $result['category'];
        }
    }
    public function getDetails($id): Thesis
    {
        $result = Database::query("SELECT t.*,GROUP_CONCAT(l.lecturer_name) as dospem
            from thesis as t
            left join dospem as dp on t.thesis_id = dp.thesis_id
            left JOIN lecturer as l ON dp.nidn=l.NIDN
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
        $thesis->prodi = $result['category'];
        return $thesis;
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

    public function count()
    {
        return (int) Database::query("SELECT count(thesis_id) FROM thesis")->fetch_column();
    }

    public function view(int $page, string $search)
    {
        $thesis = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT thesis_id FROM thesis";

        if (isset($_SESSION['prodi']) && $_SESSION['prodi'] != 'all') {
            $query = $query . " WHERE category = '" . $_SESSION['prodi'] . "'";
        }

        if ($search != '') {
            if (isset($_SESSION['prodi'])) {
                $query = $query . " AND thesis_title LIKE '%" . $search . "%'";
            } else {
                $query = $query . " WHERE thesis_title LIKE '%" . $search . "%'";
            }
        }

        $query = $query . " ORDER BY thesis_id LIMIT $limit OFFSET $start";
        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $thesis[] = new Thesis($id);
        }
        $result = array(
            'page' => $page,
            'countAll' => $this->count(),
            'start' => $start,
            'end' => $start + count($thesis),
            'numPages' => ceil($this->count() / LIMIT_ROWS_PER_PAGE),
            'data' => $thesis
        );
        return $result;
    }
    public function add()
    {
        Database::beginTransaction();

        try {
            // $prefix = 'TH';
            // $len = 5;
            // $res = Database::query("SELECT thesis_id FROM thesis ORDER BY thesis_id DESC LIMIT 1")->fetch_array();
            // $prevId = intval(substr($res[0], 2, 5));
            // $id = $prefix . str_pad($prevId + 1, $len - strlen($prefix), "0", STR_PAD_LEFT);
            $query = "INSERT INTO thesis
            (

                thesis_title,
                year_published,
                avail,
                cover,
                shelf_id,
                writer_name,
                writer_NIM,
                category
            ) VALUES (

                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            )";
            $parameters = [

                $this->title,
                $this->year,
                $this->avail,
                $this->cover,
                $this->shelf->getShelfId(),
                $this->writer_name,
                $this->writer_nim,
                $this->prodi
            ];
            $statement = Database::prepare($query);

            // Dynamically bind parameters
            $types = 'ssisssss';
            $statement->bind_param($types, ...$parameters);

            if (!$statement->execute()) {
                throw new Exception('Error add Thesis');
            }
            $id = Database::query("SELECT MAX(thesis_id) FROM thesis;")->fetch_column();

            foreach ($this->dospem2 as $lecturer) {
                $query = "INSERT INTO dospem (thesis_id, nidn) VALUES (?,?)";
                $params = [
                    $id,
                    $lecturer
                ];
                $stm = Database::prepare($query);
                $stm->bind_param('ss', ...$params);
                if (!$stm->execute()) {
                    throw new Exception('Error add Dospem');
                }
            }

            Database::commit();

            $this->id = $id;
            return array(
                'status' => 'success',
                'message' => 'Berhasil Menambahkan Skripsi'
            );
        } catch (Exception $e) {
            Database::rollback();
            return array(
                'status' => 'failed',
                'message' => 'Gagal Menambahkan Skripsi',
                'error' => $e->getMessage(),
            );
        }
    }
    public function save()
    {
        Database::beginTransaction();
        try {
            // Update data di tabel 'thesis'
            $query = "UPDATE thesis
                SET
                thesis_title = ?,
                year_published = ?,
                avail = ?,
                cover = ?,
                shelf_id = ?,
                writer_name = ?,
                writer_NIM = ?
                WHERE
                thesis_id = ?
            ";
            $parameters = [
                $this->title,
                $this->year,
                $this->avail,
                $this->cover,
                $this->shelf->getShelfId(),
                $this->writer_name,
                $this->writer_nim,
                $this->id,
            ];
            $statement = Database::prepare($query);
            $types = 'ssiissss';
            $statement->bind_param($types, ...$parameters);

            if (!$statement->execute()) {
                throw new Exception('Error updating Thesis');
            }

            // Update data di tabel 'dospem'
            $deleteDospemQuery = "DELETE FROM dospem WHERE thesis_id = ?";
            $deleteDospemStatement = Database::prepare($deleteDospemQuery);
            $deleteDospemStatement->bind_param('s', $this->id);

            if (!$deleteDospemStatement->execute()) {
                throw new Exception('Error deleting Dospem');
            }

            // Menambahkan kembali data dospem yang baru
            foreach ($this->dospem2 as $lecturer) {
                $insertDospemQuery = "INSERT INTO dospem (thesis_id, nidn) VALUES (?,?)";
                $insertDospemParams = [
                    $this->id,
                    $lecturer
                ];
                $insertDospemStatement = Database::prepare($insertDospemQuery);
                $insertDospemStatement->bind_param('ss', ...$insertDospemParams);

                if (!$insertDospemStatement->execute()) {
                    throw new Exception('Error adding Dospem');
                }
            }
            Database::commit();
            return array(
                'status' => 'success',
                'message' => 'Berhasil Edit Skripsi'
            );
        } catch (Exception $e) {
            Database::rollback();
            return array(
                'status' => 'failed',
                'message' => 'Gagal Edit Skripsi',
                'error' => $e->getMessage(),
            );
        }
    }
    public function delete()
    {
        Database::beginTransaction();
        try {
            $query = "DELETE FROM thesis WHERE thesis_id = ?";
            $queryDeleteDospem = "DELETE FROM dospem WHERE thesis_id = ?";
            $parameters = [
                $this->id
            ];

            $statement2 = Database::prepare($queryDeleteDospem);
            $type = 's';
            $statement2->bind_param($type, ...$parameters);

            if (!$statement2->execute()) {
                throw new Exception('Error updating Skripsi');
            }

            $statement1 = Database::prepare($query);
            $statement1->bind_param($type, ...$parameters);
            if (!$statement1->execute()) {
                throw new Exception('Error updating Skripsi');
            }

            Database::commit();
            return array(
                'status' => 'success',
                'message' => 'Berhasil Hapus Skripsi'
            );
        } catch (Exception $e) {
            Database::rollback();
            return array(
                'status' => 'failed',
                'message' => 'Gagal Hapus Skripsi',
                'error' => $e->getMessage(),
            );
        }
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
            'author' => $this->writer_name,
            'writer_nim' => $this->writer_nim,
            'dospem' => $this->dospem
        ];

        return json_encode($jsonArray);
    }

    public static function getAllCategories(){
        $res = Database::query("SELECT DISTINCT category FROM thesis");
        return $res;
    }

    public function addDospem($lecturer)
    {
        $this->dospem2[] = $lecturer;
    }

    /**
     * Set the value of writer_name
     */
    public function setWriterName($writer_name): self
    {
        $this->writer_name = $writer_name;

        return $this;
    }

    /**
     * Set the value of writer_nim
     */
    public function setWriterNim($writer_nim): self
    {
        $this->writer_nim = $writer_nim;

        return $this;
    }

    /**
     * Set the value of prodi
     */
    public function setProdi($prodi): self
    {
        $this->prodi = $prodi;

        return $this;
    }

    /**
     * Get the value of prodi
     */
    public function getProdi()
    {
        return $this->prodi;
    }
}
