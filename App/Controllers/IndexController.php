<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\Message;
use App\Models\User;

class IndexController extends Controller
{
    protected $view;
    protected $fb;
    protected static $_user;

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
        $user = new User();
        $user->login($this->fb);

        if (!User::isGuest()) {
            $user->getUserData($this->fb);
            $_user = getUserBySocial($user);

            if (!$user->isRegistered()) {
                $user->save();
            }
        }
    }

    public function actionAddmessage()
    {
        $message     = new Message();
        $message->id = (!empty($_POST['id']))
        ? filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT)
        : null;
        $message->text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);

        $user = new User();
        $user->getUserData($this->fb);
        $message->user_id = User::getUserBySocial($user)->id;
        
        $message->created_at = time();
        $message->save();

        $this->view->messages = Message::findAll();
        $this->view->users = User::findAll();
        $this->view->display('messages.tpl');
    }

    protected function sendHtml()
    {
        if (User::isGuest()) {
            $this->view->header  = 'Some Header for Guest';
            $this->view->content = 'Content for Guest';
            $this->view->footer  = 'Footer for Guest';

            $this->view->display('index.tpl.php');
        } else {
            $this->view->header = '<h1>Hello, '.$this->getCurrentUser()->name.'!</h1>';
            $this->view->header  .= $this->view->render('_form_message.tpl');

            $this->view->messages = Message::findAll();
            $this->view->users = User::findAll();
            $this->view->content = $this->view->render('messages.tpl');

            $this->view->footer  = $this->getCurrentUser();

            $this->view->display('index.tpl.php');
        }
    }

    protected function getCurrentUser()
    {
        if(!User::isGuest()) {
            $user = new User();
            $user->getUserData($this->fb);
            return User::getUserBySocial($user);
        }  
    }
}
