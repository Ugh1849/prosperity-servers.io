<?php

namespace App;

class Request{
    private static $_instance = null;

    private $method;

    public function get($key)
    {
        if( $this->method === "POST" ){
            return isset($_POST[$key]) ? $_POST[$key] : null;
        }

        if( $this->method === "GET" ){
            return isset($_GET[$key]) ? $_GET[$key] : null;
        }
    }

    public function all()
    {
        if( $this->method === "POST" ){
            return (object) $_POST;
        }

        if( $this->method === "GET" ){
            return (object) $_GET;
        }
    }

    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    public static function getInstance() 
    {
        if(is_null(self::$_instance)) {
          self::$_instance = new Request();  
        }
    
        return self::$_instance;
    }    
}