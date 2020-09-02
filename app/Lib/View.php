<?php
namespace ITI\Lib;
class View
{
    public static function render($folder,$file,$data=null){
            extract($data);
            require_once APP_PATH.DS.'Views'.DS.'layouts'.DS.'header.view.php';
            require_once APP_PATH.DS.'Views'.DS.'layouts'.DS.'navbar.view.php';
            require_once APP_PATH.DS.'Views'.DS.$folder.DS.$file.'.view.php';
            require_once APP_PATH.DS.'Views'.DS.'layouts'.DS.'footer.view.php';
    }
}