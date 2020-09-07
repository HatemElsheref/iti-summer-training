<?php

if (!function_exists('validateEmail')){
    function validateEmail($string){
        if (empty($string)){
            return false;
        }else{
            $validatedEmail=filter_var($string,FILTER_SANITIZE_EMAIL,ENT_QUOTES);
            $validatedEmail=trim($validatedEmail);
            $validatedEmail=strip_tags($validatedEmail);
            if (filter_var($validatedEmail,FILTER_VALIDATE_EMAIL)){
                return $validatedEmail;
            }
           return false;
        }
    }
}
if (!function_exists('validateString')){
    function validateString($string){
        if (empty($string)){
            return false;
        }else{
            $validatedString=filter_var($string,FILTER_SANITIZE_STRING,ENT_QUOTES);
            $validatedString=trim($validatedString);
            $validatedString=strip_tags($validatedString);
            return $validatedString;
        }
    }
}
if (!function_exists('validateInteger')){
    function validateInteger($integer){
        if (empty($integer)){
            return false;
        }else{
            $validatedInteger=filter_var($integer,FILTER_SANITIZE_NUMBER_INT);
            settype($validatedInteger,'integer');
            if (is_integer($validatedInteger)){
                return $validatedInteger;
            }
            return false;
        }

    }
}
if (!function_exists('isExist')){
    function isExist($model,$column,$value,$ignore){
        if (!empty($column) or !empty($value)){
           if ($ignore){
               $result=$model->findWithIgnore($column,$value,$ignore);
               if (!($result===false)){
                   return [$result,'ignore'];
               }
           }else{
               return $model->findBy($column,$value);
           }
        }
     return false;
    }
}