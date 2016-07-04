<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    const TABLE = 'users';

    public $id;
    public $name;
    public $social_id;
    public $social_name = 'facebook';

    protected $accessToken = null;

    public static function isGuest()
    {
        return !isset($_COOKIE['fbsr_286994848357270']);
    }

    public function login($helper)
    {
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

        $_SESSION['fb_access_token'] = (string) $accessToken;
        $this->accessToken = (string) $accessToken;

    }

    public function logout()
    {
        $this->accessToken = null;
    }

    public function getUserToken()
    {
        return $this->accessToken;
    }

}