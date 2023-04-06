<?php

namespace repository;

use PDO;
use PDOException;

class baseRepository
{
    protected $connection;

    public function __construct()
    {
        try {
            require('../config.php');
            $this->connection = new PDO("mysql:host=$db_host; dbname=$db_name", $db_username, $db_password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


}