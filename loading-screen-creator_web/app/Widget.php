<?php

namespace App;

class Widget {
    private $name = "";
    public $css = [];
    private $vars = [];
    private $template = "";
    public $others = [];
    
    public $extend;

    public function __construct()
    {
        $backTrace = debug_backtrace()[0];

        $path = str_replace("init.php", "template.php", $backTrace["file"]);

        ob_start();
        
        require_once $path;
        
        $this->template = ob_get_clean();
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setCSS($arrayOrKey, $value = null)
    {
        if( is_string($arrayOrKey) ) {
            $this->css[$arrayOrKey] = $value;
        } else {
            $this->css = $arrayOrKey;
        }
    }

    public function extend(string $name)
    {
        $this->extend = $name;
    }

    public function setOthers($arrayOrKey, $value = null)
    {
        if( is_string($arrayOrKey) ) {
            $this->others[$arrayOrKey] = $value;
        } else {
            $this->others = $arrayOrKey;
        }
    }

    public function setVariable(string $variable, $value)
    {
        $this->vars[$variable] = $value;
    }

    public function echo()
    {
        return $this->template;
    }
    
    public function __serialize()
    {
        return [
            "name" => $this->name,
            "css" => $this->css,
            "vars" => $this->vars,
            "others" => $this->others,
            "template" => $this->template
        ];
    }
}