<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;
use Core\Controller\Controller;


class TaskController extends Controller
{
    public function index()
    {
        return view('index.twig');
    }
}