<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.03.17
 * Time: 17:06
 */

namespace App\Models;


use PDO;

class User
{
    protected
        $email,
        $password;

    public function getEmail(){
        return $this->email;
    }

    public function login(string $email, string $password){
        $db = new PDO("mysql:host=localhost;dbname=sg_news;charset=utf8", "root", "123");
        $user = $db->query("SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1");
        if($user = $user->fetch()) {
            $this->email = $user['email'];
            $this->password = $user['password'];
            return $this;
        }
        else {
            return false;
        }
    }

}