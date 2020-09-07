<?php
namespace ITI;
use ITI\Database\Database;
use ITI\Controllers\UserController;
require_once 'vendor/autoload.php';


$CONFIGURATION_TO_BOOTSTRAP_THE_APPLICATION=[
    'HOSTNAME'          =>HOSTNAME,
    'USERNAME'          =>USERNAME,
    'PASSWORD'          =>PASSWORD,
    'DATABASE'          =>DATABASE,
    'PORT'              =>PORT,
];

$START_APP=new Database($CONFIGURATION_TO_BOOTSTRAP_THE_APPLICATION);
$controller='UserController';
$action='index';
$params=[
    'post'=>$_POST,
    'get'=>$_GET
];
$namespace='ITI\Controllers\\';
if (isset($_GET['controller']) and !empty($_GET['controller'])){
    if (in_array(ucfirst(strtolower($_GET['controller'])).'Controller',array_keys(ROUTES))){
        $controller=ucfirst(strtolower($_GET['controller'])).'Controller';
        if (isset($_GET['action']) and !empty($_GET['action'])){
            if (in_array(strtolower($_GET['action']),ROUTES[$controller])){
                $action=strtolower($_GET['action']);
            }else{
                $action=NOTFOUNDACTION;
            }
        }else{
            $controller=NOTFOUNDCONTROLLER;
            $action=NOTFOUNDACTION;
        }
    }else{
        $controller=NOTFOUNDCONTROLLER;
        $action=NOTFOUNDCONTROLLER;
    }
}
$controller=$namespace.$controller;

if ($controller===NOTFOUNDCONTROLLER or $action===NOTFOUNDACTION){
    $controllerObject=new NOTFOUNDCONTROLLER;
    $controllerObject->{NOTFOUNDACTION()};
}else{
    $controllerObject=new $controller($START_APP);
    $controllerObject->setValues($params,$_FILES);
    $controllerObject->$action();
}




//$userController=new UserController($START_APP);
//
//if (isset($_REQUEST['submit'])){
//    switch ($_REQUEST['submit']){
//        case 'addUser':
//            $userController->setValues($_POST,$_FILES);
//            $userController->store();
//            break;
//        case 'editUser':
//            $userController->edit($_GET['id']);
//        case 'updateUser':
//            $userController->setValues($_POST,$_FILES);
//            $userController->update($_GET['id']);
//            break;
//        case 'deleteUser':
//            $userController->setValues($_POST);
//            $userController->destroy($_POST['id']);
//            break;
//    }
//}else{
//    $userController->index();
//}