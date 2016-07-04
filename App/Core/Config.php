<?php

namespace App\Core;

class Config
{
    use Traits\Singleton;
    
    public $config;
    
    protected function __construct(){
       $this->config = parse_ini_file(__DIR__ . '/../config/db.cfg');
    }
    
}
