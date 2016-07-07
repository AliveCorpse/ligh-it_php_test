<?php

namespace App\Core;

class Db
{
    use Traits\Singleton;

    const DB_NAME = 'database.sqlite3';
    const DB_PATH = __DIR__ . '/../../database/';

    private $dbh;

    protected function __construct()
    {
        try {
            if(!is_file(self::DB_PATH . self::DB_NAME)) {
                $db = new \SQLite3(self::DB_PATH . self::DB_NAME);

                $sql = "CREATE TABLE users(
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        name VARCHAR,
                        social_id INTEGER,
                        social_name VARCHAR
                    )";
                $db->exec($sql) or $db->lastErrorMsg();

                $sql = "CREATE TABLE messages(
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        text TEXT,
                        user_id INTEGER,
                        created_at TIMESTAMP,
                        updated_at TIMESTAMP
                    )";
                $db->exec($sql) or $db->lastErrorMsg();

                $sql = "CREATE TABLE comments(
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        text TEXT,
                        user_id INTEGER,
                        message_id INTEGER,
                        parent_id INTEGER,
                        created_at TIMESTAMP,
                        updated_at TIMESTAMP
                    )";
                $db->exec($sql) or $db->lastErrorMsg();

            }
            // $this->dbh = new \PDO('mysql:host=localhost;dbname=lightit', 'root', '');
            
            $this->dbh = new \PDO('sqlite:' . self::DB_PATH . self::DB_NAME);
            
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
            return $stmt->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    public function execute($sql, $params=[])
    {
        $stmt = $this->dbh->prepare($sql);
        return $stmt->execute($params);
    }

    public function insertedId()
    {
        return $this->dbh->lastInsertId();
    }
}
