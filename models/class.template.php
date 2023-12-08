<?php
class Template
{
    private $documentRoot;
    private $module;
    private $path;
    private $titles = array(
        'guest' => 'Guest',
        'member' => 'Member',
        'staff' => 'Staff',
        'admin' => 'Admin'
    );

    public function __construct(string $modeuleName)
    {
        $this->module = $modeuleName;
        $this->documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/template/';
    }

    public function header()
    {
        $title = $this->titles[$this->module];
        include $this->documentRoot . "header.php";
    }

    public function footer()
    {
        $file = '';
        if (isset($_SESSION['level'])) {
            if ($_SESSION['level'] == 'member') {
                $file = 'member.js';
                $file2 = 'catalog.js';
            } else if ($_SESSION['level'] == 'staff') {
                $file = 'staff.js';
            } else if ($_SESSION['level'] == 'admin') {
                $file = 'admin.js';
            }
        } else {
            $file = 'catalog.js';
            $file2 = 'guest.js';
        }
        include $this->documentRoot . "footer.php";
    }
    public function sidebar()
    {
        if (isset($_SESSION['level'])) {
            if ($_SESSION['level'] == 'member') {
                include $this->documentRoot . 'sidebar.member.php';
            } else if ($_SESSION['level'] == 'staff') {
                include $this->documentRoot . 'sidebar.staff.php';
            } else if ($_SESSION['level'] == 'admin') {
                include $this->documentRoot . 'sidebar.admin.php';
            }
        }
    }
    public function renderCards($data = []): string{
        // 'borrowingData' => array(
        //                          (str) id,
        //                          (str) status,
        //                          (int) book,
        //                          (int) thesis,
        //                          (str date) reserve_date
        // );
        extract($data);
        ob_start();
        include $this->documentRoot . $this->path . 'template.BorrowingCard.php';
        return ob_get_clean();
    }
}
