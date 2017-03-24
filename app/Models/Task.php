<?php

namespace App\Models;

use Core\Database\Model;

class Task extends Model
{

    public function setTableName()
    {
        return 'tasks';
    }


    public function getUser()
    {
        return (new User())->find($this->user_id);
    }
}