<?php
class Borrowing
{

    private $id;
    private Member $member;
    private $reserve_date;
    private $due_date;
    private $return_date;
    private $status;
    private $penalty;
    private array $readable;

    function __construct($id = null)
    {
        $this->readable = array();
        // var_dump($id);
        if (isset($id)) {
            $res = Database::query("SELECT * FROM borrowing WHERE BORROWING_ID='$id'")->fetch_assoc();
            $this->id = $res['BORROWING_ID'];
            $this->member = new Member($res['member_id']);
            $this->reserve_date = $res['reserve_date'];
            $this->due_date = $res['due_date'];
            $this->return_date = $res['return_date'];
            $this->status = $res['status'];
            // $this->penalty = $res['penalty'];

            $res = Database::query(
                "SELECT id FROM (
                    SELECT book_id AS id FROM borrowing_book WHERE borrowing_id = '$id'
                    UNION
                    SELECT thesis_id AS id FROM borrowing_thesis WHERE borrowing_id = '$id'
                    ) as D"
            );
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_column()) {
                    if (str_starts_with($row, 'BK')) {
                        $this->readable[] = new Book($row);
                    } else {
                        $this->readable[] = new Thesis($row);
                    }
                }
            }
        }
    }
    public function getAllBorrowing($page)
    {
        $borrowing = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT BORROWING_ID FROM borrowing ORDER BY BORROWING_ID LIMIT $limit OFFSET $start";
        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $borrowing[] = new Borrowing($id);
        }
        return [$borrowing, $start, $start + count($borrowing)];
    }
    function view(int $page, string $search)
    {
        $borrowing = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT BORROWING_ID FROM borrowing AS b LEFT JOIN member AS m ON b.member_id=m.member_id";

        if ($search != '') {
            $query = $query . " WHERE m.member_name LIKE '%" . $search . "%'";
        }

        $query = $query . " ORDER BY BORROWING_ID LIMIT $limit OFFSET $start";

        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $borrowing[] = new Borrowing($id);
        }
        $result = array(
            'page' => $page,
            'countAll' => $this->count(),
            'start' => $start,
            'end' => $start + count($borrowing),
            'numPages' => ceil($this->count() / LIMIT_ROWS_PER_PAGE),
            'data' => $borrowing
        );
        return $result;
    }

    public function count()
    {
        return (int) Database::query("SELECT count(BORROWING_ID) FROM borrowing")->fetch_column();
    }
    public function countBooks(): int
    {
        $n = 0;
        foreach ($this->readable as $item) {
            if ($item instanceof Book) {
                $n++;
            }
        }
        return $n;
    }
    public function countThesis(): int
    {
        $n = 0;
        foreach ($this->readable as $item) {
            if ($item instanceof Thesis) {
                $n++;
            }
        }
        return $n;
    }

    public function add(Member $member, $reserve_date, array $readable)
    {
        // $prefix = 'B';
        // $len = 5;
        // $res = Database::query("SELECT BORROWING_ID FROM borrowing ORDER BY BORROWING_ID DESC LIMIT 1")->fetch_array();
        // $prevId = intval(substr($res[0], 3, 5));
        // $id = $prefix . str_pad($prevId + 1, $len - strlen($prefix), "0", STR_PAD_LEFT);
        $member_id = $member->getMemberId();
        $due_date = date('Y-m-d', strtotime($reserve_date . ' + 7 days'));
        $query = "INSERT INTO borrowing (member_id, reserve_date, due_date, return_date, status) VALUES ('$member_id', '$reserve_date', '$due_date','0000-00-00', 'menunggu')";

        Database::insert($query);
        $id = Database::query("SELECT MAX(borrowing_id) FROM borrowing;")->fetch_column();
        foreach ($readable as $item) {
            $item_id = $item->getId();
            if (str_starts_with($item_id, 'BK')) {
                $query = "INSERT INTO borrowing_book (borrowing_id, book_id) VALUES ('$id', '$item_id')";
                // var_dump($query);
                Database::insert(query:$query);
            } else if (str_starts_with($item_id, 'TH')) {
                Database::insert("INSERT INTO borrowing_thesis (borrowing_id, thesis_id) VALUES ('$id', '$item_id')");
            }
        }
    }
    public function save()
    {
        try {
            $query = "
                UPDATE borrowing
                SET
                    member_id = ?,
                    reserve_date = ?,
                    due_date = ?,
                    return_date = ?,
                    status = ?
                WHERE BORROWING_ID = ?
            ";

            $parameters = [
                $this->member->getMemberId(),
                $this->reserve_date,
                $this->due_date,
                $this->return_date,
                $this->status,
                $this->id,
            ];

            $statement = Database::prepare($query);

            // Dynamically bind parameters
            $types = 'ssssss';
            $statement->bind_param($types, ...$parameters);

            if ($statement->execute() == true) {
                return array(
                    'status' => 'success',
                    'message' => 'Berhasil'
                );
            }
        } catch (Exception $e) {
            return array(
                'status' => 'failed',
                'message' => 'Gagal Merubah Data Peminjaman',
                'error' => $e->getMessage(),
            );
        }
    }
    public function toJSON()
    {
        $jsonArray = [
            'id' => $this->id,
            'member' => $this->member->toJSON(),
            'reserve_date' => date_format(date_create($this->reserve_date), "d F Y"),
            'due_date' => date_format(date_create($this->due_date), "d F Y"),
            'return_date' => date_format(date_create($this->return_date), "d F Y"),
            'status' => $this->status,
            // 'penalty' => $this->penalty,
            'readable' => []
        ];
        foreach ($this->readable as $item) {
            $jsonArray['readable'][] = $item->toJSON();
        }
        return json_encode($jsonArray);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    public function getMember(): Member
    {
        return $this->member;
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

    /**
     * Set the value of status
     */
    public function setStatus($status): self
    {
        $this->status = $status;
        $this->member->getId();
        return $this;
    }

    /**
     * Get the value of readable
     */
    public function getReadable(): array
    {
        return $this->readable;
    }
}
