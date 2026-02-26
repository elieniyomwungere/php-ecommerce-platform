<?php

namespace Core;\n\nclass Database {
    private static $instance = null;
    private \$pdo;

    private function __construct() {
        // Database connection parameters
        \$host = 'localhost';
        \$db = 'your_database'; // Change this to your database name
        \$user = 'your_user'; // Change this to your database username
        \$pass = 'your_password'; // Change this to your database password
        \$charset = 'utf8mb4';

        // Data Source Name
        \$dsn = "mysql:host=\$host;dbname=\$db;charset=\$charset";
        \$options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            // Create a PDO instance
            \$this->pdo = new PDO(\$dsn, \$user, \$pass, \$options);
        } catch (PDOException \$e) {
            throw new \$e;
        }
    }

    public static function getInstance() {
        if (\$instance === null) {
            \$instance = new Database();
        }
        return \$instance->pdo;
    }
}