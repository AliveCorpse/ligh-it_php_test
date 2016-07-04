<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\User;

class IndexController extends Controller
{
    protected $view;
    protected $fb;

    public function __construct()
    {
        $this->view = new View();

        $this->fb = new \Facebook\Facebook([
            'app_id'                => '286994848357270',
            'app_secret'            => '892ad1dc9e9d20668d605319312ac77c',
            'default_graph_version' => 'v2.5',
        ]);
    }

    public function actionIndex()
    {
        $this->sendHtml();
    }

    public function actionLogin()
    { 
        $user   = new User();
        $user->login($this->fb);

        if(!User::isGuest()) {
            $user->getUserData($this->fb);
            if(!$user->isRegistered()) {
                $user->save();
            }
        }
    }

    protected function sendHtml()
    {
        if (User::isGuest()) {
            $this->view->header = 'Some Header for Guest';
            $this->view->content = 'Content for Guest';
            $this->view->footer = 'Footer for Guest';

            $this->view->display('index.tpl.php');
        } else {
            $this->view->header = $this->view->render('_form_message.tpl');
            $this->view->content = $this->view->render('messages.tpl');
            $this->view->footer = "Footer for Logined Users";
            
            $this->view->display('index.tpl.php');
        }
    }
}
