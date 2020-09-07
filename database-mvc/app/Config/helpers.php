<?php

if (!function_exists('assets')){
    function assets($path){
       return APP_URL.'assets/'.$path;
    }
}

if (!function_exists('generateStrongPassword')){
    function generateStrongPassword($password){
        return crypt(trim($password,''),SALT_1).SALT_2;
    }
}

if (!function_exists('verifyPassword')){
    function verifyPassword($hashed_password,$inputPassword){
        if (hash_equals($hashed_password, generateStrongPassword($inputPassword)))
            return true;
        else
            return false;
    }
}


if (!function_exists('redirect')){
    function redirect($path){
        header('location:'.APP_URL.$path);
    }
}


if (!function_exists('old')){
    function old($key){
        echo $_SESSION['old'][$key]??'';
    }
}

