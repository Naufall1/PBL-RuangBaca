<?php
require_once 'IManage.php';
class Staff extends User
{
    function getSummarizes(): array
    {
        $queryExecSP = "CALL `getStaffSummarizes`(@p0, @p1, @p2, @p3, @p4);";
        $queryGetSPResult = "SELECT
            @p0 AS `totalBuku`,
            @p1 AS `totalSkripsi`,
            @p2 AS `totalAnggota`,
            @p3 AS `totalPeminjaman`,
            @p4 AS `totalPeminjamanMenunggu`
        ;";
        Database::query($queryExecSP);
        $data = Database::query($queryGetSPResult)->fetch_assoc();
        $summarizes = array(
            'book' => (int) $data['totalBuku'],
            'thesis' => (int) $data['totalSkripsi'],
            'member' => (int) $data['totalAnggota'],
            'borrowing' => (int) $data['totalPeminjaman'],
            'waiting' => (int) $data['totalPeminjamanMenunggu']
        );
        return $summarizes;
    }
    function getBorrowing($status = 'all'): array
    {
        $query = 'SELECT
            b.BORROWING_ID AS id,
            b.status,
            b.reserve_date,
            COUNT(DISTINCT bb.book_id) AS book,
            COUNT(DISTINCT bt.thesis_id) AS thesis
        FROM
            borrowing AS b
        LEFT JOIN
            borrowing_book AS bb ON b.BORROWING_ID = bb.borrowing_id
        LEFT JOIN
            borrowing_thesis AS bt ON b.BORROWING_ID = bt.borrowing_id
        ';
        $data = array();
        switch ($status) {
            case 'all':
                break;
            case 'waiting':
                $query = $query . " WHERE b.status = 'menunggu'";
                break;

            case 'confirmed':
                $query = $query . " WHERE b.status = 'dikonfirmasi'";
                break;

            case 'borrowed':
                $query = $query . " WHERE b.status = 'dipinjam'";
                break;

            case 'done':
                $query = $query . " WHERE b.status = 'selesai'";
                break;

            case 'late':
                $query = $query . " WHERE b.status = 'terlambat'";
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

    public function getBorrowingDetails($id)
    {
        $borrowing = new Borrowing($id);
        return $borrowing->toJSON();
    }
    public function confirmBorrowing($id)
    {
        $borrowing = new Borrowing(id: $id);
        if ($borrowing->getStatus() == 'Menunggu') {
            $borrowing->setStatus('Dikonfirmasi');
            if ($borrowing->save()['status'] == 'success') {
                return array(
                    'status' => 'success',
                    'message' => 'Berhasil Dikonfirmasi!',
                );
            } else {
                return array(
                    'status' => 'failed',
                    'message' => 'Gagal Merubah Status'
                );
            }
        } else {
            return array(
                'status' => 'failed',
                'message' => 'Status Tidak Sesuai'
            );
        }
    }
    public function rejectBorrowing($id)
    {
        $borrowing = new Borrowing(id: $id);
        if ($borrowing->getStatus() == 'Menunggu') {
            $borrowing->setStatus('Ditolak');
            if ($borrowing->save()['status'] == 'success') {
                return array(
                    'status' => 'success',
                    'message' => 'Berhasil Ditolak!',
                );
            } else {
                return array(
                    'status' => 'failed',
                    'message' => 'Gagal Merubah Status'
                );
            }
        } else {
            return array(
                'status' => 'failed',
                'message' => 'Status Tidak Sesuai'
            );
        }
    }
    public function pickUpBorrowing($id)
    {
        $borrowing = new Borrowing(id: $id);
        if ($borrowing->getStatus() == 'Dikonfirmasi') {
            $borrowing->setStatus('Dipinjam');
            if ($borrowing->save()['status'] == 'success') {
                return array(
                    'status' => 'success',
                    'message' => 'Proses Berhasil!',
                );
            } else {
                return array(
                    'status' => 'failed',
                    'message' => 'Gagal Merubah Status'
                );
            }
        } else {
            return array(
                'status' => 'failed',
                'message' => 'Status Tidak Sesuai'
            );
        }
    }
    public function finishBorrowing($id)
    {
        $borrowing = new Borrowing(id: $id);
        if ($borrowing->getStatus() == 'Dipinjam' || $borrowing->getStatus() == 'Terlambat') {
            $borrowing->setStatus('Selesai');
            $res = $borrowing->save();
            // var_dump($res);
            if ($res['status'] == 'success') {
                return array(
                    'status' => 'success',
                    'message' => 'Berhasil diubah!',
                );
            } else {
                return array(
                    'status' => 'failed',
                    'message' => 'Gagal Merubah Status',
                    'error' => $res['error']
                );
            }
        } else {
            return array(
                'status' => 'failed',
                'message' => 'Status Tidak Sesuai'
            );
        }
    }

    function view(IManage $object, int $page = 1, string $search = ''): array
    {
        $results = $object->view($page, $search);
        return $results;
    }
}
