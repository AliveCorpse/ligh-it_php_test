<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Db;

class User extends Model
{
    const TABLE = 'users';

    public $id;
    public $name;
    public $social_id;
    public $social_name = 'facebook';

    // private $accessToken = null;

    public static function isGuest()
    {
        return !isset($_COOKIE['fbsr_286994848357270']);
    }

    public function getUserData($fb)
    {
        $request = $fb->request('GET', '/me');
        $request->setAccessToken($_SESSION['fb_access_token']);
        // Send the request to Graph
        try {
            $response = $fb->getClient()->sendRequest($request);
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

        $this->name      = $graphNode['name'];
        $this->social_id = $graphNode['id'];

    }

    public function login($fb)
    {
        $helper = $fb->getJavaScriptHelper();
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
        // $this->accessToken           = (string) $accessToken;
    }

    public function isRegistered()
    {
        $db     = Db::instance();
        $result = $db->query(
            'SELECT * FROM ' . static::TABLE
            . ' WHERE social_id=:social_id
                AND social_name=:social_name',
            [
                ':social_id'   => $this->social_id,
                ':social_name' => $this->social_name,
            ],
            static::class
        );

        if (!empty($result)) {
            return true;
        }
        return false;
    }
}
