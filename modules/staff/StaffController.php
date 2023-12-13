<?php
require_once 'models/class.template.php';
require_once 'models/Staff.php';
class StaffController
{
    private Staff $staff;
    private Template $template;
    public function __construct()
    {
        $this->template = new Template('staff');
        $this->staff = new Staff();
    }

    public function index()
    {
        $this->template->header();
        $template = $this->template;
        include 'modules/staff/staff_views/index.php';
        $this->template->footer();
    }

    private function dashboardCards()
    {
        $borrowingData = $this->staff->getBorrowing($_POST['status']);
        echo $this->template->renderCards(['borrowingData' => $borrowingData]);
    }

    public function dashboard()
    {
        if (!isset($_POST['status'])) {
            $summarizes = $this->staff->getSummarizes();
            include 'modules/staff/staff_views/dashboard.php';
        } else {
            $this->dashboardCards();
        }
    }
    public function borrowing($path)
    {
        $arg = explode('/', $path)[1];
        $id = $_POST['id'];
        // var_dump($arg);
        switch ($arg) {
            case 'details':
                echo $this->staff->getBorrowingDetails(id: $id);
                break;
            case 'confirm':
                echo $this->staff->confirmBorrowing(id: $id);
                break;
            case 'reject':
                echo $this->staff->rejectBorrowing(id: $id);
                break;
            case 'pickUp':
                echo $this->staff->pickUpBorrowing(id: $id);
                break;
            case 'finish':
                echo $this->staff->finishBorrowing(id: $id);
                break;
            default:
                echo 'denied';
                break;
        }
    }
    public function search($path)
    {
        $arg = explode('/', $path)[1];

        $classMap = [
            'book'      => 'Book',
            'thesis'    => 'Thesis',
            'member'    => 'Member',
        ];

        if (isset($_GET['q']) && isset($classMap[$arg])) {
            $className = $classMap[$arg];
            $data = $this->staff->view(new $className(), page: (isset($_GET['num'])) ? $_GET['num'] : 1, search: $_GET['q']);
            $data['numPages'] = ceil(count($data['data']) / LIMIT_ROWS_PER_PAGE);
            // var_dump(count($data['data']));
            $methodName = $arg;
            $this->$methodName(data: $data);
        } else {
            echo 'failed';
        }
    }
    public function book($data = null)
    {
        if (!is_null($data)) {
            $books = $data;
        } else {
            if (isset($_GET['num'])) {
                $_SESSION['bk-page'] = $_GET['num'];
            }
            $page = (isset($_SESSION['bk-page'])) ? $_SESSION['bk-page'] : 1;
            $books = $this->staff->view(object: new Book(), page:$page);
        }
        $numPage = $books['numPages'];
        include 'modules/staff/staff_views/book.php';
    }
    public function thesis($data = null)
    {
        if (!is_null($data)) {
            $thesis = $data;
        } else {
            if (isset($_GET['num'])) {
                $_SESSION['th-page'] = $_GET['num'];
            }
            $page = (isset($_SESSION['th-page'])) ? $_SESSION['th-page'] : 1;
            $thesis = $this->staff->view(object: new Thesis(), page:$page);
        }
        $numPage = $thesis['numPages'];
        include 'modules/staff/staff_views/thesis.php';
    }
    public function member($data = null)
    {
        if (!is_null($data)) {
            $members = $data;
        } else {
            if (isset($_GET['num'])) {
                $_SESSION['m-page'] = $_GET['num'];
            }
            $page = (isset($_SESSION['m-page'])) ? $_SESSION['m-page'] : 1;
            $members = $this->staff->view(object: new Member(), page:$page);
        }
        $numPage = $members['numPages'];
        include 'modules/staff/staff_views/member.php';
    }
}
