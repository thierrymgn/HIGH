<?php

namespace App\Framework;

use PDO;

class Database
{
    private PDO $_connection;
    private static ?Database $_instance = null;

    protected function __construct()
    {
        define('DB_NAME', getenv('DB_NAME'));
        define('DB_USER', getenv('DB_USER'));
        define('DB_PASSWORD', getenv('DB_PASSWORD'));
        define('DB_HOST', getenv('DB_HOST'));

        $this->_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    }

    public function getConnection(): PDO
    {
        return $this->_connection;
    }

    public static function getInstance(): Database
    {
        if (self::$_instance == null) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }
}
