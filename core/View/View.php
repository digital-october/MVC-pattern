<?php

namespace Core\View;

class View
{
    protected $template = null;
    protected $data = [];

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }


    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }


    public function render($page)
    {
        extract($this->data, EXTR_OVERWRITE);
        $_CONTENT_VIEW =  __DIR__. '/../../app/Views/' . $page . '.php';
        $template = include __DIR__. '/../../app/Views/' . $this->template . '.php';
        return $template;
    }

}