<?php

namespace App\Models;

use App\Core\Model;

class Message extends Model
{
    const TABLE = 'messages';

    public $id;
    public $text;
    public $user_id;
    public $created_at;
    
}