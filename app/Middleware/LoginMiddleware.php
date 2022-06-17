<?php

namespace App\Middleware;

class LoginMiddleware {
    private static $allowed = [
        "/login",
        "/api"
    ];

    public static function handle()
    {
        $uri = $_SERVER["REQUEST_URI"];

        if( $_SERVER["REQUEST_METHOD"] === "GET" ) {
            foreach( self::$allowed as $url ) {
                if( $url === substr( $uri, 0, strlen($url) ) ) {
                    return true;
                }
            }
        }
        
        if( isset($_SESSION["logged"]) && !isset($GLOBALS["allowedUsers"][$_SESSION["steamid"]]) ) {
            $_SESSION["errors"][] = __("login.notAllowed");
            unset($_SESSION["logged"]);
            redirect("/login");
            exit();
        }

        if( !isUrl("login") && !isUrl("view") && !isUrl("api") && !isset($_SESSION["logged"]) ) {
            return redirect("/login");
        }
    } 
}
