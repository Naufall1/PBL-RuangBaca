<?php
require_once 'config/config.php';

class Database
{
    private static $host = DB_HOST;
    private static $user = DB_USER;
    private static $password = DB_PASSWORD;
    private static $database = DB_NAME;
    private static $conn;

    private function __construct()
    {
        // Private constructor to prevent instantiation
    }

    public static function getConnection(): mysqli
    {
        if (!isset(self::$conn)) {
            self::$conn = new mysqli(self::$host, self::$user, self::$password, self::$database);
            if (self::$conn->connect_error) {
                die("Koneksi Gagal: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }

    public static function query($query): mysqli_result | bool
    {
        $conn = self::getConnection();
        $result = $conn->query($query);

        if (!$result) {
            die("Query Error: " . $conn->error);
        }
        return $result;
    }

    public static function insert($query): bool
    {
        $conn = self::getConnection();
        $result = $conn->query($query);

        if (!$result) {
            die("Query Error: " . $conn->error);
        }
        return $result;
    }

    public static function prepare($query)
    {
        $conn = self::getConnection();
        return $conn->prepare($query);
    }

    // Fungsi untuk memulai transaksi
    public static function beginTransaction()
    {
        self::$conn->begin_transaction();
    }

    // Fungsi untuk menyelesaikan transaksi dengan mengonfirmasi perubahan
    public static function commit()
    {
        self::$conn->commit();
    }

    // Fungsi untuk melakukan rollback pada transaksi
    public static function rollback()
    {
        self::$conn->rollback();
    }
}
