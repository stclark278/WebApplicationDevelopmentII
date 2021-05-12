<?php
class Database {
    private static $dsn = 'mysql:host=localhost;dbname=webdsuco_clark278';
    private static $username = 'webdsuco_clark278';
    private static $password = 'webdsuco_clark278';
    private static $db;

    private function __construct() {}

    public static function getDB() {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
                include 'view/header.php';
                echo '<h1>Database Error</h1>';
                echo '<p>' . $errorMessage . '</p>';
                include 'view/footer.php';
                exit();
            }
        }
        return self::$db;
    }
}