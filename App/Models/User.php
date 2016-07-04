<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    const TABLE = 'users';

    public static function isGuest()
    {
        return !isset($_COOKIE['fbsr_286994848357270']);
    }
}