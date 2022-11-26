<?php

namespace App\Kernel;

use App\Helpers\Route;
use App\Model\Migration;

//Core
Class Kernel
{
    /**
     * App entry point
     */
    public static function run() {
        self::registerClassLoader();
        Migration::migrate();
        Route::handle();

    }

    // Autoload app classes
    private static function registerClassLoader(){
        spl_autoload_register(function ($class){
            $classPath = explode('\\', $class);
            $className = $classPath[count($classPath) - 1];

            if (file_exists("App/Controllers/".$className.'.php')){
                require_once "App/Controllers/".$className.'.php';
            }
            if (file_exists("App/Helpers/".$className.'.php')){
                require_once "App/Helpers/".$className.'.php';
            }
            if (file_exists("App/Model/".$className.'.php')){
                require_once "App/Model/".$className.'.php';
            }
            if (file_exists("App/Services/".$className.'.php')){
                require_once "App/Services/".$className.'.php';
            }


        });
    }

}