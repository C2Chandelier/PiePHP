<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            if (file_exists($file)) {
                require_once $file;
                return true;
            }
            elseif (file_exists('./src/Controller/' . $file)) {
                require_once './src/Controller/' . $file;
                return true;
            }
            elseif (file_exists('./src/Model/' . $file)) {
                require_once './src/Model/' . $file;
                return true;
            }

            return false;
        });
    }
}
Autoloader::register();

