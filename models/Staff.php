<?php
require_once 'IManage.php';
class Staff extends User
{
    function getSummarizes(): array
    {
        $countBook = Database::query("SELECT count(book_id) FROM book")->fetch_column();
        $countThesis = Database::query("SELECT count(thesis_id) FROM thesis")->fetch_column();
        $countMember = Database::query("SELECT count(*) FROM member")->fetch_column();
        $countBorrowing = Database::query("SELECT count(*) FROM borrowing")->fetch_column();
        $countWaiting = Database::query("SELECT count(*) FROM borrowing WHERE status = 'menunggu'")->fetch_column();
        $summarizes = array(
            'book' => (int) $countBook,
            'thesis' => (int) $countThesis,
            'member' => (int) $countMember,
            'borrowing' => (int) $countBorrowing,
            'waiting' => (int) $countWaiting
        );
        return $summarizes;
    }
    function getBorrowing($status = 'all'): array
    {
        $query = 'SELECT b.BORROWING_ID as id,b.status, b.reserve_date, COUNT(bb.book_id) AS book, COUNT(bt.thesis_id) AS thesis
            FROM borrowing AS b
            LEFT JOIN borrowing_book AS bb ON b.BORROWING_ID=bb.borrowing_id
            LEFT JOIN borrowing_thesis AS bt ON b.BORROWING_ID=bt.borrowing_id
        ';
        $data = array();
        switch ($status) {
            case 'all':
                break;

            case 'waiting':
                $query = $query . " WHERE b.status = 'menunggu'";
                break;

            case 'borrowed':
                $query = $query . " WHERE b.status = 'dipinjam'";
                break;

            case 'done':
                $query = $query . " WHERE b.status = 'selesai'";
                break;

            case 'rejected':
                $query = $query . " WHERE b.status = 'ditolak'";
                break;
        }
        $query = $query . " GROUP by b.BORROWING_ID";
        $res = Database::query($query);
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getBorrowingDetails($id){
        $borrowing = new Borrowing($id);
        return $borrowing->toJSON();
    }
    public function confirmBorrowing($id){
        $borrowing = new Borrowing(id:$id);
        if ($borrowing->getStatus() == 'menunggu') {
            $borrowing->setStatus('dipinjam');
            $borrowing->save();
            return true;
        } else {
            return false;
        }

    }
    public function rejectBorrowing($id){
        $borrowing = new Borrowing(id:$id);
        if ($borrowing->getStatus() == 'menunggu') {
            $borrowing->setStatus('ditolak');
            $borrowing->save();
            return true;
        } else {
            return false;
        }
    }
    function view(IManage $object, int $page = 1, string $search = ''): array
    {
        $results = $object->view($page, $search);
        return $results;
    }
}
