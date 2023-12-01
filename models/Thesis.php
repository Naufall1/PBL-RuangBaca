<?php
// include 'Readable.php';
class Thesis extends Readable
{
    private $writer_name;
    private $writer_nim;
    private $dospem;
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

    public function getThesis(array $range): array
    {
        $res = Database::query("SELECT thesis_id FROM thesis LIMIT $range[1] OFFSET $range[0]");
        // var_dump($res->fetch_all());
        while ($row = $res->fetch_assoc()) {
            $thesis[] = $this->getDetails($row['thesis_id']);
        }
        return $thesis;
        // var_dump($thesis);
    }

    /**
     * Get the value of writer_name
     */
    public function getAuthor()
    {
        $author = new Author();
        $author->setAuthorId('1');
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

    public function toJSON(){
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
