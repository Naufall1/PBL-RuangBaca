<?php
require_once 'IManage.php';
class Member extends User implements IManage
{
    private $member_id;
    private $nim;
    private $name;
    private array $cart;
    function __construct($id = null)
    {
        if (isset($_SESSION['member_id'])) {
            $id = $_SESSION['member_id'];
        }
        $this->cart = array();
        if (!is_null($id)) {
            $res = Database::query("SELECT * FROM member WHERE member_id='$id'")->fetch_assoc();
            $this->member_id = $res['member_id'];
            $this->nim = $res['nim'];
            $this->name = $res['member_name'];
        }
        if (isset($_COOKIE['cart'])) {
            $this->cart = json_decode($_COOKIE['cart']);
        }
    }

    public function getHistory($status = 'all'): array{
         // array(
        //     (str) id,
        //     (str) status,
        //     (int) book,
        //     (int) thesis,
        //     (str date) reserve_date
        // );
        $borrowing_data = array();
        $query = "SELECT BORROWING_ID FROM borrowing WHERE member_id = ? ";

        switch ($status) {
            case 'all':
                break;
            case 'waiting':
                $query = $query . " AND status = 'menunggu'";
                break;

            case 'confirmed':
                $query = $query . " AND status = 'dikonfirmasi'";
                break;

            case 'borrowed':
                $query = $query . " AND status = 'dipinjam'";
                break;

            case 'done':
                $query = $query . " AND status = 'selesai'";
                break;

            case 'rejected':
                $query = $query . " AND status = 'ditolak'";
                break;

            case 'latest':
                $query = $query . " AND reserve_date >= CURDATE() - INTERVAL 7 DAY;";
                break;
        }

        $stm = Database::prepare($query);
        $stm->bind_param('s', $this->member_id);
        $stm->execute();
        $result = $stm->get_result();
        while ($id = $result->fetch_column()) {
            $tmp = new Borrowing($id);
            $borrowing_data[] = array(
                'id' => $tmp->getId(),
                'status' => $tmp->getStatus(),
                'book' => $tmp->countBooks(),
                'thesis' => $tmp->countThesis(),
                'reserve_date' => $tmp->getReserveDate(),
            );
        }
        return $borrowing_data;
    }
    public function getHistoryDetails($id)
    {
        $borrowing = new Borrowing($id);
        return $borrowing->toJSON();
    }

    public function register($username, $password, $name, $nim)
    {
        $user_id = $this->registerUser($username, $password,level:'member');
        $this->nim = $nim;
        $this->name = $name;
        parent::setId($user_id);
        return $this->add();
    }

    public function getAllMembers($page)
    {
        $members = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT member_id FROM member ORDER BY member_id LIMIT $limit OFFSET $start";
        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $members[] = new Member($id);
        }
        return [$members, $start, $start + count($members)];
    }

    public function count()
    {
        return (int) Database::query("SELECT count(member_id) FROM member")->fetch_column();
    }

    public function addToCart(Readable $item)
    {
        $this->cart[] = $item->getId();
        setcookie("cart", json_encode($this->cart), time() + (24 * 60 * 60));
    }

    public function removeFromCart(Readable $item)
    {
        $index = array_search($item->getId(), $this->cart);
        if ($index !== FALSE) {
            unset($this->cart[$index]);
        }
        $res = array();
        foreach ($this->cart as $val) {
            $res[] = $val;
        }
        $this->cart = $res;
        setcookie("cart", json_encode($res), time() + (24 * 60 * 60));
    }

    public function borrow($tanggal_ambil)
    {
        $readable = array();
        // var_dump($this->cart, $tanggal_ambil);
        foreach ($this->cart as $id) {
            if (str_starts_with($id, 'BK')) {
                $readable[] = new Book($id);
            } else if (str_starts_with($id, 'TH')) {
                $readable[] = new Thesis($id);
            }
        }
        $borrowing = new Borrowing();
        $borrowing->add($this, $tanggal_ambil, $readable);
        setcookie("cart", json_encode($this->cart), time() - (24 * 60 * 60));
    }

    public function view(int $page, string $search)
    {
        $member = array();
        $start = ($page * LIMIT_ROWS_PER_PAGE) - LIMIT_ROWS_PER_PAGE;
        $limit = LIMIT_ROWS_PER_PAGE;
        $query = "SELECT member_id FROM member ORDER BY member_id LIMIT $limit OFFSET $start";
        $result = Database::query($query);
        while ($id = $result->fetch_column()) {
            $member[] = new Member($id);
        }
        $result = array(
            'page' => $page,
            'countAll' => $this->count(),
            'start' => $start,
            'end' => $start + count($member),
            'numPages' => ceil($this->count() / LIMIT_ROWS_PER_PAGE),
            'data' => $member
        );
        return $result;
    }
    public function add()
    {
        $prefix = 'M';
        $len = 4;
        $res = Database::query("SELECT member_id FROM member ORDER BY member_id DESC LIMIT 1")->fetch_array();
        $prevId = intval(substr($res[0], 1, 5));
        $id = $prefix . str_pad($prevId + 1, $len - strlen($prefix), "0", STR_PAD_LEFT);

        $query = "INSERT INTO member (member_id, member_name, nim, user_id) VALUES ('$id', ?, ?, ?)";
        $params = [
            $this->name,
            $this->nim,
            $this->getId()
        ];

        $statement = Database::prepare($query);
        $types = 'ssi';
        $statement->bind_param($types, ...$params);
        $statement->execute();
        return $id;
    }
    public function save()
    {
        $query = "
            UPDATE member
            SET
                user_id = ?,
                nim = ?,
                member_name = ?
            WHERE member_id = ?
        ";

        $parameters = [
            $this->getId(),
            $this->nim,
            $this->name,
            $this->member_id,
        ];

        $statement = Database::prepare($query);

        // Dynamically bind parameters
        $types = 'isss';
        $statement->bind_param($types, ...$parameters);

        $statement->execute();
    }
    public function delete()
    {
        $query = "DELETE FROM member WHERE member_id = ?";
        $parameters = [
            $this->member_id
        ];
        $statement = Database::prepare($query);
        $type = 's';
        $statement->bind_param($type, ...$parameters);

        $statement->execute();
    }

    public function toJSON()
    {
        $jsonArray = [
            'id' => $this->member_id,
            'nim' => $this->nim,
            'name' => $this->name,
        ];
        return json_encode($jsonArray);
    }
    /**
     * Get the value of nim
     */
    public function getNim()
    {
        return $this->nim;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of member_id
     */
    public function getMemberId()
    {
        return $this->member_id;
    }
};
