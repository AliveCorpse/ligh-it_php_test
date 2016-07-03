<?php

namespace App\Core;

class Db
{
    use Singletone;

    private $dbh;

    protected function __construct()
    {
        try {
            $this->dbh = new \PDO('mysql:host=localhost;dbname=lightit', 'root', '');
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    
}
