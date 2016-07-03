<?php

namespace App\Core;

abstract class Controller
{
    public function action($action)
    {
        $methodName = 'action' . ucfirst($action);
        return $this->$methodName();
    }
}
