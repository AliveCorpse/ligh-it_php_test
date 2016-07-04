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
        if(User::isGuest()) {
            $this->view->display('index.tpl.php');
        } else {
            $this->view->content = $this->view->render('_form_message.tpl');
            $this->view->display('index.tpl.php');
        }
        
    }

    public function actionLogin()
    {
        $helper = $this->fb->getJavaScriptHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
            echo 'No cookie set or no OAuth data could be obtained from cookie.';
            exit;
        }

        // Logged in
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());

        $_SESSION['fb_access_token'] = (string) $accessToken;

        // User is logged in!
        // You can redirect them to a members-only page.
        //header('Location: https://example.com/members.php');
        $this->view->content = $this->view->render('test.tpl');
        $this->view->display('index.tpl.php');
        // echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    }

    // public function actionLogincallback()
    // {
    //     $helper = $this->fb->getRedirectLoginHelper();

    //     try {
    //         $accessToken = $helper->getAccessToken();
    //     } catch (Facebook\Exceptions\FacebookResponseException $e) {
    //         // When Graph returns an error
    //         echo 'Graph returned an error: ' . $e->getMessage();
    //         exit;
    //     } catch (Facebook\Exceptions\FacebookSDKException $e) {
    //         // When validation fails or other local issues
    //         echo 'Facebook SDK returned an error: ' . $e->getMessage();
    //         exit;
    //     }

    //     if (isset($accessToken)) {
    //         // Logged in!
    //         $_SESSION['facebook_access_token'] = (string) $accessToken;

    //     }
    // }
}
