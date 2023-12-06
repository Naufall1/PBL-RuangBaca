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
        $countWaiting = Database::query("SELECT count(*) FROM borrowing WHERE status = 'waiting for confirmation'")->fetch_column();
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
                $query = $query . " WHERE b.status = 'borrowed'";
                break;

            case 'done':
                $query = $query . " WHERE b.status = 'done'";
                break;

            case 'rejected':
                $query = $query . " WHERE b.status = 'rejected'";
                break;
        }
        $query = $query . " GROUP by b.BORROWING_ID";
        $res = Database::query($query);
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    function view(IManage $object, int $page = 1, string $search = ''): array
    {
        $results = $object->view($page, $search);
        return $results;
    }
    function viewThesis(): array
    {
        return [];
    }
    function viewMember(): array
    {
        return [];
    }
}
