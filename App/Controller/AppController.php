<?php
/**
 * Created by PhpStorm.
 * User: HZM
 * Date: 14/09/2019
 * Time: 16:09
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

