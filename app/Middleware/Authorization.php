<?php
namespace App\Middleware;

use App\Models\User;

class Authorization
{

    public function handle()
    {
        if (isset($_COOKIE['id'])) {
            $id = $_COOKIE['id'];
            $authUser = (new User())->find($id);

            if ($authUser->hash == $_COOKIE['hash']) {
                return true;
            }
        }else{
            echo 'Для выполнения этой операции необходимо авторизироваться';
            return false;
        }
    }
}