<?php
require_once 'core/Database.php';
class User
{
    private $id;
    private $username;
    private $user_password;
    private $salt;
    private $level;

    function __construct() {
        session_start();
    }


    function login($username, $password): bool {
        $result = Database::query("SELECT username, level, salt, password as hashed_password FROM user WHERE username = '$username'");
        $row = $result->fetch_assoc();
        if (isset($row['salt']) && isset($row['hashed_password'])) {
            $salt = $row['salt'];
            $hashed_password = $row['hashed_password'];
        } else {
            $salt = null;
            $hashed_password = null;
        }


        if ($salt !== null && $hashed_password !== null) {
            $combined_password = $salt . $password;
            if (password_verify($combined_password, $hashed_password)) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['level'] = $row['level'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function logout() {
        if (isset($_SESSION['username'])) {
            session_destroy();
            return true;
        } else {
            return false;
        }
    }

    function isLogin(): bool{
        if (isset($_SESSION['username'])) {
            return true;
        } else {
            return false;
        }
    }
}
