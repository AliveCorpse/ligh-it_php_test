<?php

namespace App\Models;

use App\Core\Db;
use App\Core\Model;

class Message extends Model
{
    const TABLE = 'messages';

    public $id;
    public $text;
    public $user_id;
    public $created_at;

    public static function findAll()
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE
            . ' ORDER BY created_at DESC',
            [],
            static::class
        );
    }
}
