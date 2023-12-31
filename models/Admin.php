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

    function add(IManage $object)
    {
        // var_dump($object->add());
        return $object->add();
    }

    function save(IManage $object)
    {
        return $object->save();
    }

    function delete(IManage $object)
    {
        return $object->delete();
    }

    function viewBorrowing($page = 1, $search = ''): array
    {
        $borrowing = new Borrowing();
        return $borrowing->view(page: $page, search: $search);
    }

    function editBorrowing()
    {
    }
    function deleteBorrowing()
    {
    }
}
