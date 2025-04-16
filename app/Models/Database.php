<?php

class Database
{
    private static $instance = null;
    private $connection;
    private $host = "localhost";   // Change if needed
    private $username = "root";    // Change if needed
    private $password = "";        // Change if needed
    private $database = "gradtrack_db"; // Change to your database name

    // Private constructor to prevent multiple instances
    private function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Get the database instance
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Get the connection
    public function getConnection()
    {
        return $this->connection;
    }
}
?>