<?php

namespace App\Models;

use Core\Database\Model;

class User extends Model
{

    public function setTableName()
    {
        return 'users';
    }


    public function getUserEmail($email)
    {
        return $this->db->query("SELECT * FROM `{$this->table}` WHERE `email`='{$email}'");
    }
}