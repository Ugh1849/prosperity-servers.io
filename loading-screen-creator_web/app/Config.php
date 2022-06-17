<?php

namespace App;

class Config{
    private static $_instance = null;

    private $config = [];

    public function __construct()
    {
        $exist = @file_exists(BASE_PATH . "/config-install.php");

        if( !$exist ) return;

        $config = require BASE_PATH . "/config-install.php";

        $this->config = $config;   
        
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $language = Language::getInstance();

        if( $language->exist($lang) ){
            Language::getInstance()->setLang($lang);
        } else {
            Language::getInstance()->setLang("en");
        }
    }

    public function get(string $key)
    {
        $parts = explode(".", $key);
        $val = $this->config;

        foreach ($parts as $key => $v) {
            if ( isset($val[$v] ) ){
                $val = $val[$v];
            }
        }

        if( $val === $this->config ){
            return false;
        }

        return $val;
    }

    public function set(string $key, $value)
    {
        $this->config[$key] = $value;
        $this->save();
    }

    public function setAll(array $config)
    {
        $this->config = $config;
        $this->save();
    }

    public function save()
    {
        $config = var_export($this->config, true);
        file_put_contents(BASE_PATH . "/config-install.php", "<?php return $config;");

        return $this;
    }

    public static function getInstance() 
    {
        if(is_null(self::$_instance)) {
          self::$_instance = new Config();  
        }
    
        return self::$_instance;
    }
}