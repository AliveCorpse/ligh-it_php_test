<?php

namespace App\Core;

abstract class Model
{
    const TABLE = '';

    public $id;

    public static function findAll()
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            [],
            static::class
        );
    }

    public static function findById(int $id)
    {
        $db = Db::instance();
        $result = $db->query(
            'SELECT * FROM ' . static::TABLE
            . ' WHERE id=:id',
            ['id:' => $id],
            static::TABLE
        );

        if(!empty($result)) {
            return $result[0];
        }
        return false;
    }
}