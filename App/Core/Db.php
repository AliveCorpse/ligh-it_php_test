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

    public function query($sql, $params=[], $class='')
    {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($params);

        if(empty($class)) {
            return $stmt->fetchAll();
        } else {
            return $stmt->fetchAll(PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    public function execute($sql, $params=[])
    {
        $stmt->prepare($sql);
        return $stmt->execute($params);
    }

    public function insertedId()
    {
        return $this->dbh->lastInsertId();
    }
}
