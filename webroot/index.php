<?php
define('ROOT', dirname(__DIR__));
define("APPPATH", ROOT . '/src');

require APPPATH . '/App.php';

App\App::load();

// page url
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 'default.home';
}

$page = explode('.', $page);
$controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
$parameter0 = null;
$parameter1 = null;

if(isset($page[3])){
    $parameter1 = $page[3];
}

if(isset($page[2])){
    $parameter0 = $page[2];
}

if(isset($page[1])){
    $action = $page[1];
}else{
    $action = 'index';
}

$controller = new $controller();
$controller->$action($parameter0,$parameter1);


?>
