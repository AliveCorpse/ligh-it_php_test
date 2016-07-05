<?php

namespace App\Core;

abstract class Controller
{
    public function action($action)
    {
        $methodName = 'action' . ucfirst($action);
        $this->beforeAction();
        return $this->$methodName();
    }

    protected function beforeAction()
    {}
}
