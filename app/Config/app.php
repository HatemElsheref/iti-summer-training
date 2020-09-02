<?php

//application paths
define('DS',DIRECTORY_SEPARATOR);
define('APP_PATH',dirname(__DIR__));
define('UPLOAD_DIR','uploads');
define('UPLOAD_PATH',dirname(APP_PATH).DS.UPLOAD_DIR);
define('APP_NAME','el-sheref');
define('APP_URL','http://localhost/iti/database/');
define('AVATAR','default-user.png');


//database connection
define('HOSTNAME','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DATABASE','iti');
define('PORT',3306);

//general
define('DEBUG',true);
define('SUCCESS',200);
define('_SUCCESS','success');
define('FAIL',100);
define('_FAIL','danger');

//password
define('SALT_1','#ABCPO%^&*!@#axpttyr');
define('SALT_2','_'.APP_NAME);

//Y M D H I S =>DATE FORMATS
// GENERATE CUSTOM ID FOR USER
$prefix='user_';
$uid = uniqid($prefix).date("YMD");




