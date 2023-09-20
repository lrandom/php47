<?php
if (isset($_GET['ct'])) {
    //MAGIC CONSTANT
    $ct = $_GET['ct'];
    $ct=explode('/', $ct);
    $controller = $ct[0]; //home->Home
    $action = $ct[1]; //about
    $controller = ucfirst($controller). 'Controller'; //HomeController
    require_once 'controllers/' . $controller . '.php';
    $obj = new $controller();//meta programming//reflect API in Java
    $obj->$action();
}
?>
