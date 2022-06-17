<?php

namespace App;

class Language{
    private static $_instance = null;

    private $language = [];

    public function setLang(string $lang)
    {
        $language = @require_once BASE_PATH . "/resources/lang/$lang.php";

        if( !$language ) return;

        $this->language = $language;
    }

    public function get($key)
    {
        $parts = explode(".", $key);
        $val = $this->language;

        foreach ($parts as $key => $v) {
            if ( isset($val[$v] ) ){
                $val = $val[$v];
            } else {
                $val = false;
            }
        }

        if( $val === $this->language || $val === false ){
            return "Unknown";
        }

        return $val;
    }

    public function exist(string $lang)
    {
        return file_exists(BASE_PATH . "/resources/lang/$lang.php");
    }

    public function __serialize()
    {
        return json_encode($this->language);
    }

    public static function getInstance() 
    {
        if(is_null(self::$_instance)) {
          self::$_instance = new Language();  
        }
    
        return self::$_instance;
    }    
}