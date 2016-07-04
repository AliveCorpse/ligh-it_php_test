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
        if (User::isGuest()) {
            $this->view->display('index.tpl.php');
        } else {
            $request = $this->fb->request('GET', '/me');
            $request->setAccessToken($_SESSION['fb_access_token']);
            // Send the request to Graph
            try {
                $response = $this->fb->getClient()->sendRequest($request);
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            $graphNode = $response->getGraphNode();
            var_dump($graphNode);
            echo 'User name: ' . $graphNode['name'];

            $this->view->content = $this->view->render('_form_message.tpl');
            $this->view->display('index.tpl.php');
        }

    }

    public function actionLogin()
    {
        $helper = $this->fb->getJavaScriptHelper();
        $user   = new User();
        $user->login($helper);

        header('Location: index.php');
        exit;   

        if (!User::isGuest()) {
            $this->view->content = $this->view->render('test.tpl');
            $this->view->display('index.tpl.php');
        } else {
            header('Location: index.php');
            exit;
        }
    }

}
