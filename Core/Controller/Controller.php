<?php
/**
 * Created by PhpStorm.
 * User: HZM
 */

namespace Core\Controller;

class Controller {

    protected $template;
    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = ROOT . '/App/View/';
        $this->template = 'default';
    }

    protected function render($view, $variables = []){
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'layout/' . $this->template . '.php');
    }

    protected function redirectTo($url){
        header("Location:  ?page=".$url);
    }
}

