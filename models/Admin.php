<?php
require_once 'models/Lecturer.php';
require_once 'models/Borrowing.php';
class Admin extends User
{

    function __construct()
    {
        if (!$this->isAdmin()) {
            // die('Error Permission denied');
        }
    }

    function view(IManage $object, int $page = 1, string $search = ''): array
    {
        $results = $object->view($page, $search);
        return $results;
    }


    function viewBorrowing($page = 1, $search = ''): array
    {
        $borrowing = new Borrowing();
        // $results = $borrowing->getAllBorrowing($page);
        // $result = array(
        //     'page' => $page,
        //     'countAll' => $borrowing->count(),
        //     'start' => $results[1],
        //     'end' => $results[2],
        //     'data' => $results[0]
        // );
        // return $result;
        return $borrowing->view(page:$page, search:$search);
    }
    function editBorrowing()
    {
    }
    function deleteBorrowing()
    {
    }
}
