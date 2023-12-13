<?php
include 'modules/auth/AuthController.php';
include 'modules/catalog/CatalogController.php';
include 'modules/guest/GuestController.php';
include 'modules/admin/AdminController.php';
include 'modules/member/MemberController.php';
include 'modules/staff/StaffController.php';
// include 'models/Catalog.php';
// include 'models/User.php';

    class Router {
        public function route() {
            $user = new User();
            $member = new Member();
            $auth = new AuthController($user);
            $catalog = new CatalogController();
            $guestController = new GuestController();
            $MemberController = new MemberController();
            $StaffController = new StaffController();
            $adminController = new AdminController();

            $page = isset($_GET['page']) ? $_GET['page'] : 'index';
            $function = isset($_GET['function']) ? $_GET['function'] : null;

            if ($function == null) {
                # code...
                switch ($page) {

                    case 'index':
                        if (isset($_SESSION['level'])) {
                            if ($user->isMember()) {
                                $MemberController->index();
                            } else if ($user->isStaff()) {
                                $StaffController->index();
                            } else if ($user->isAdmin()) {
                                $adminController->index();
                            }
                        } else {
                            $guestController->index();
                        }
                        break;

                    case 'dashboard':
                        if ($user->isStaff()) {
                            $StaffController->dashboard();
                        } else {
                            echo "404 Not Found";
                        }
                        break;

                    case 'login':
                        if (isset($_POST['username']) && isset($_POST['password'])) {
                            $auth->processLogin();
                        } else {
                            $auth->login();
                        }
                        break;

                    case 'logout':
                        $auth->logout();
                        break;

                    case 'register':
                        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['full-name']) && isset($_POST['nim'])) {
                            $auth->processRegisterMember();
                        } else {
                            $auth->register();
                        }
                        break;

                    case 'book':
                        if ($user->isMember()) {
                            $MemberController->book();
                        } else if ($user->isStaff()) {
                            $StaffController->book();
                        } else if ($user->isAdmin()){
                            $adminController->book();
                        }
                        else {
                            echo "404 Not Found";
                        }
                        break;

                    case 'history':
                        if ($user->isMember()) {
                            $MemberController->history('');
                        } else {
                            echo "404 Not Found";
                        }
                        break;

                    case 'thesis':
                        if ($user->isStaff()) {
                            $StaffController->thesis();
                        } else if ($user->isAdmin()){
                            $adminController->thesis();
                        } else {
                            echo "404 Not Found";
                        }
                        break;

                    case 'author':
                        if ($user->isAdmin()) {
                            $adminController->author();
                        } else {
                            echo "404 Not Found";
                        }
                        break;

                    case 'publisher':
                        if ($user->isAdmin()) {
                            $adminController->publisher();
                        } else {
                            echo "404 Not Found";
                        }
                        break;

                    case 'category':
                        if ($user->isAdmin()) {
                            $adminController->category();
                        } else {
                            echo "404 Not Found";
                        }
                        break;

                    case 'lecture':
                        if ($user->isAdmin()) {
                            $adminController->lecture();
                        } else {
                            echo "404 Not Found";
                        }
                        break;

                    case 'borrowing':
                        if ($user->isAdmin()) {
                            $adminController->borrowing();
                        } else {
                            echo "404 Not Found";
                        }
                        break;

                    case 'shelf':
                        if ($user->isAdmin()) {
                            $adminController->shelf();
                        } else {
                            echo "404 Not Found";
                        }
                        break;

                    case 'member':
                        if ($user->isStaff()) {
                            $StaffController->member();
                        } else if ($user->isAdmin()){
                            $adminController->member();
                        } else {
                            echo "404 Not Found";
                        }
                        break;

                    default:
                        echo "404 Not Found";
                        break;
                }
            } else {
                switch (explode('/', $function)[0]) {

                    // CATALOG
                    case 'getFilters':
                        $catalog->getFilters();
                        break;
                    case 'filter':
                        $catalog->filter();
                        break;
                    case 'getDesc':
                        $catalog->getDesc();
                        break;
                    case 'books':
                        $catalog->getContent();
                        break;
                    case 'search':
                        if (isset(explode('/', $function)[1])) {
                            $adminController->search($function);
                        } else {
                            $catalog->search();
                        }
                        break;

                    // MEMBER
                    case 'cart':
                        $MemberController->cart($function);
                        break;
                    case 'history':
                        $MemberController->history($function);
                        break;

                    // STAFF
                    case 'borrowing':
                        $StaffController->borrowing($function);
                        break;

                    // ADMIN

                    default:
                        # code...
                        break;
                }
            }
        }
    }
?>