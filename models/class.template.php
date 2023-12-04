<?php
class Template
{
    private $documentRoot;
    private $module;
    private $titles = array(
        'guest' => 'Guest',
        'member' => 'Member',
        'staff' => 'Staff',
        'admin' => 'Admin'
    );

    public function __construct(string $modeuleName)
    {
        $this->module = $modeuleName;
        $this->documentRoot = $_SERVER['DOCUMENT_ROOT'];
    }

    public function header()
    {
        $title = $this->titles[$this->module];
        include $this->documentRoot . "/template/header.php";
    }

    public function footer()
    {
        $file = '';
        if (isset($_SESSION['level'])) {
            if ($_SESSION['level'] == 'member') {
                // include $this->documentRoot . '/template/sidebar.member.php';
                $file = 'member.js';
            } else if ($_SESSION['level'] == 'staff') {
                // include $this->documentRoot . '/template/sidebar.staff.php';
                $file = 'staff.js';
            } else if ($_SESSION['level'] == 'admin') {
                // include $this->documentRoot . '/template/sidebar.admin.php';
                $file = 'admin.js';
            }
        }
        include $this->documentRoot . "/template/footer.php";
    }
    public function sidebar()
    {
        if (isset($_SESSION['level'])) {
            if ($_SESSION['level'] == 'member') {
                include $this->documentRoot . '/template/sidebar.member.php';
            } else if ($_SESSION['level'] == 'staff') {
                include $this->documentRoot . '/template/sidebar.staff.php';
            } else if ($_SESSION['level'] == 'admin') {
                include $this->documentRoot . '/template/sidebar.admin.php';
            }
        }
    }
}
