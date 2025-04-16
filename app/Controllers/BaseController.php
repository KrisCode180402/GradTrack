<?php
// app/Controllers/BaseController.php

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/db.php';

class BaseController
{
    // $db now holds a PDO connection
    protected $db;

    public function __construct()
    {
        // Get the singleton instance of the Database and then its PDO connection.
        $database = Database::getInstance();
        $this->db = $database->getConnection();

        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
