<?php
/**
 * Created by PhpStorm.
 * User: HZM
 */

namespace App\Controller;


use Core\Controller\Controller;

class AppController extends Controller
{
    // default template
    protected $template = 'default';

    /*
     * App construct
     */
    public function __construct()
    {
        //the views pages path
        $this->viewPath = ROOT . '/App/Views/';
    }
}

