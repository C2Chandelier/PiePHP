<?php

namespace Core;

class Request
{
    static function secure_post(){
        foreach($_POST as $key => $value){
            $value = trim($value);
            $value = htmlspecialchars($value);
            $value=implode("",explode("\\",$value));
            $value = stripslashes($value);
            $_POST[$key] = $value;
        }
        return $_POST;
    }

    static function secure_get(){
        foreach($_GET as $key => $value){
            $value = trim($value);
            $value = htmlspecialchars($value);
            $value=implode("",explode("\\",$value));
            $value = stripslashes($value);
            $_GET[$key] = $value;
        }

        return $_GET;
    }
}
