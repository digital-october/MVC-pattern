<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller\Controller;

class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->setTemplate('template');
    }


    public function registration()
    {
        return $this->view->render('reg-form');
    }


    public function createUser()
    {
        $user = new User();
        $user->name = $_POST['name'];
        $user->password = md5($_POST['password']);
        $user->email = $_POST['email'];
        $user->save();

        header('location:/');
    }


    public function auth()
    {
        return $this->view->render('auth-form');
    }


    public function login()
    {
        $user = new User();
        $oneUser = $user->getUserEmail($_POST['email']);
        $emailForm = $oneUser[0]['email'];

        if ($_POST['email'] == $emailForm && md5($_POST['password']) == $oneUser[0]['password']) {
            $hash = md5($this->generateCode());

            setcookie("id", $oneUser[0]['id'], time()+3600);
            setcookie("hash", $hash, time()+3600);
            setcookie("name", $oneUser[0]['name'], time()+3600);
            setcookie("email", $emailForm, time()+3600);

            $user->id = $oneUser[0]['id'];
            $user->hash = $hash;
            $user->save();

        } else {
            return $this->view->setData([
                'email' => $_POST['email'],
                'error' => 'Не верные данные, проверьте и попробуйте снова'
            ])->render('auth-form');
        }
        header('location:/');
    }


    public function logout()
    {
        setcookie("id", '', time()-3600);
        setcookie("hash", '', time()-3600);
        setcookie("name", '', time()-3600);
        setcookie("email", '', time()-3600);
        header('location:/');
    }


    # Функция для генерации случайной строки
    public function generateCode($length = 6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }
}