<?php

include 'models/User.php';
include 'models/Member.php';
class AuthController
{
    private User $user;
    function __construct($user)
    {
        $this->user = $user;
    }

    function login()
    {
        include 'modules/auth/auth_view/login.php';
    }

    function logout()
    {
        $this->user->logout();
        header('Location: /');
    }

    function register()
    {
        include 'modules/auth/auth_view/register.php';
    }

    function processLogin()
    {
        if ($this->user->login($_POST['username'], $_POST['password'])) {
            header('Location: /index.php');
        } else {
            echo 'Login failed';
            header('Location: /index.php?page=login');
        }
    }
    function processRegisterMember()
    {
        $member = new Member();
        if ($member->register($_POST['username'], $_POST['password'], $_POST['full-name'], $_POST['nim'])) {
            header('Location: /index.php?page=login');
        } else {
            header('Location: /index.php?page=register');
        }
    }
}
