<?
namespace Core\Controller;

use Core\View\View;

abstract class Controller
{
    public function __construct()
    {
        $this->view = new View();
    }
}