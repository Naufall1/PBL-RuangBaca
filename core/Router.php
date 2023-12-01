<?php
include 'modules/auth/AuthController.php';
include 'modules/catalog/CatalogController.php';
include 'modules/guest/GuestController.php';
include 'modules/admin/AdminController.php';
// include 'models/Catalog.php';
// include 'modules/admin/MemberController.php';
// include 'modules/admin/StaffController.php';
// include 'models/User.php';

    class Router {
        public function route() {
            $user = new User();
            $member = new Member();
            $auth = new AuthController($user);
            $catalog = new CatalogController();
            $guestController = new GuestController();
            // $catalog = new Catalog(20);
            // var_dump($catalog->getContent(1));

            // $AdminController = new AdminController();
            // $MemberController = new MemberController();
            // $StaffController = new StaffController();
            // $user->login('admin', 'admin');

            $page = isset($_GET['page']) ? $_GET['page'] : 'index';
            $function = isset($_GET['function']) ? $_GET['function'] : null;

            if ($function == null) {
                # code...
                switch ($page) {
                    case 'index':
                        $guestController->index();
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
                        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['nama']) && isset($_POST['nim'])) {
                            $auth->processRegisterMember();
                        } else {
                            $auth->register();
                        }

                    default:
                        echo "404 Not Found";
                        break;
                }
            } else {
                switch ($function) {
                    case 'filter':

                        break;

                    case 'getDesc':
                        $catalog->getDesc();
                        // $guestController->bookDescription();
                        break;
                    case 'books':
                        $catalog->getContent();
                        break;

                    default:
                        # code...
                        break;
                }
            }
        }
    }
?>