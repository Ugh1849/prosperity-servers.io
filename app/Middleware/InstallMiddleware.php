<?php

namespace App\Middleware;

class InstallMiddleware {
    public static function handle()
    {
        if( isUrl("/install") && file_exists(BASE_PATH . "/config-install.php") ) {
            return redirect("/");
        }

        if( !isUrl("/install") && !file_exists(BASE_PATH . "/config-install.php") ) {
            return redirect("/install");
        }

        return @file_exists(BASE_PATH . "/config-install.php");
    } 
}
