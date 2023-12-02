<?php
require_once 'config/config.php';

class Database {
    private static $host = DB_HOST;
    private static $user = DB_USER;
    private static $password = DB_PASSWORD;
    private static $database = DB_NAME;
    private static $conn;

    private function __construct() {
        // Private constructor to prevent instantiation
    }

    public static function getConnection() {
        if (!isset(self::$conn)) {
            self::$conn = new mysqli(self::$host, self::$user, self::$password, self::$database);
            if (self::$conn->connect_error) {
                die("Koneksi Gagal: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }

    public static function query($query): mysqli_result{
        $conn = self::getConnection();
        $result = $conn->query($query);

        if (!$result) {
            die("Query Error: " . $conn->error);
        }
        return $result;
    }
}
?>