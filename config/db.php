<?php
/**
 * TailorEase - Database Connection Manager
 * Handles PDO MySQL connection with graceful mock fallback if MySQL is not available.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tailorease_db');

class Database {
    private static $instance = null;
    private $pdo = null;
    private $is_mock = false;

    private function __construct() {
        try {
            // First try MySQL PDO connection
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // MySQL unavailable, activate local mock database state for seamless offline testing
            $this->is_mock = true;
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function isMock() {
        return $this->is_mock;
    }
}

// Global DB instance helper
function getDB() {
    return Database::getInstance();
}
