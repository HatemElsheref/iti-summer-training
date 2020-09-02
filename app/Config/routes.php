<?php


define('NOTFOUNDCONTROLLER','NotFoundController');
define('NOTFOUNDACTION','NotFoundAction');
$routes=[
    'UserController'=>['index','create','store','edit','update','destroy'],
    'ProductController'=>['index','create','store','edit','update','destroy'],
    NOTFOUNDCONTROLLER=>[NOTFOUNDCONTROLLER,NOTFOUNDACTION]
];

define('ROUTES',$routes);