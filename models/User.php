<?php
require_once 'core/Database.php';
class User
{
    private $id;
    private $username;
    private $password;
    private $salt;
    private $level;

    function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            # code...
        }
    }

    function registerUser($username, $password, $level): int | string | bool {
        $salt = bin2hex(random_bytes(16));
        $combined_password = $salt . $password;
        $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);
        $query = "INSERT INTO user (username, password, salt, level) VALUES (?, ?, ?, ?)";
        $stm = Database::prepare($query);
        $stm->bind_param('ssss', $username, $hashed_password, $salt, $level);
        if ($stm->execute()) {
            return $stm->insert_id;
        } else {
            return false;
        }

    }


    function login($username, $password): bool {
        $result = Database::query("SELECT user_id, username, level, salt, password as hashed_password FROM user WHERE username = '$username'");
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
                $_SESSION['user_id'] = $row['user_id'];
                $this->id = $row['user_id'];
                $this->username = $row['username'];
                $this->password = $row['hashed_password'];
                $this->salt = $row['salt'];
                $this->level = $row['level'];
                if ($this->isMember()) {
                    $member = Database::query("SELECT member_id, member_name FROM member WHERE user_id = $this->id")->fetch_assoc();
                    $_SESSION['member_id'] = $member['member_id'];
                    $_SESSION['member_name'] = $member['member_name'];
                }
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

    function isMember(): bool {
        if (isset($_SESSION['level']) && $_SESSION['level'] == 'member') {
            return true;
        } else {
            return false;
        }
    }

    function isStaff(): bool {
        if (isset($_SESSION['level']) && $_SESSION['level'] == 'staff') {
            return true;
        } else {
            return false;
        }
    }

    function isAdmin(): bool {
        if (isset($_SESSION['level']) && $_SESSION['level'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function getId()
        {
                return $this->id;
        }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
}
