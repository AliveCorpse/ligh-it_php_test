<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

class IndexController extends Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function actionIndex()
    {
        $this->view->title = 'IndexACtion';
        $this->view->test = 'Some test variable';
        $this->view->display('index.tpl.php');
    }
}