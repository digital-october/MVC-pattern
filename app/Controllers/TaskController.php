<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;
use Core\Controller\Controller;
use Core\Libraries\AcResizeImage;


class TaskController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->setTemplate('template');
    }


    public function index()
    {
        $users = new User();
        $task = new Task();
        $sort = null;

        switch ($_GET['sort']){
            case 'status': $sort = 'done'; break;
            case 'name': $sort = 'users.name'; break;
            case 'heading': $sort = 'tasks.name'; break;
        }

        if($sort){
            $task = $task->orderBy($sort, 'ASC');
        }
        $allTasks = $task->getWith(User::class, 'id', 'user_id');

        return $this->view->setData([
            'tasks' => $allTasks,
            'users' => $users
        ])->render('tasks');
    }


    public function newTask()
    {
        $users = new User();
        return $this->view->setData([
            'users' => $users
        ])->render('task-form');
    }


    public function createTask()
    {
        $task = new Task();

        #Работа с изображением
        $uploadDir = 'public/upload/';
        $image = $uploadDir . time() . $_FILES['image']['name'];

        copy($_FILES['image']['tmp_name'], $image);
        print_r($_FILES);die();
        $img = new AcResizeImage($image);
        $img->resize(320, 240); //масштабировали изображение, вписав его в рамки
        $path = $img->save($uploadDir, time(), 'jpg', false, 100); //сохранили

        if ($_POST['id'] != '') {
            $task->id = $_POST['id'];
        }
        if ($_POST['done'] != 0) {
            $task->done = 1;
        }
//        $task->done = (isset($_POST['done'])) ? true:false;
        $task->name = $_POST['name'];
        $task->task = $_POST['task'];
        $task->user_id = $_COOKIE['id'];
        $task->image = $path;;
        $task->save();

        header('location:/');
    }


    public function show()
    {
        $task = (new Task())->find($_GET['id']);
        return $this->view->setData([
            'task' => $task,
            'user' => $task->getUser()
        ])->render('task');
    }


    public function edit()
    {
        $users = new User();
        $task = (new Task())->find($_GET['id']);
        return $this->view->setData([
            'task' => $task,
            'id' => $_GET['id'],
            'users' => $users
        ])->render('task-form');
    }
}