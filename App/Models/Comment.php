<?php

namespace App\Models;

use App\Core\Db;
use App\Core\Model;
use App\Core\Traits\ArrayAccess;
use App\Core\Traits\Iterator;

class Comment extends Model implements \ArrayAccess, \Iterator
{
    use ArrayAccess;
    use Iterator;
    const TABLE = 'comments';

    public $id;
    public $text;
    public $user_id;
    public $message_id;
    public $parent_id;
    public $created_at;
    public $updated_at;

    public static function findAll()
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE
            . ' ORDER BY created_at ASC',
            [],
            static::class
        );
    }

}