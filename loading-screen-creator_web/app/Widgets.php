<?php

namespace App;

class Widgets {
    private static $_instance = null;

    private $widgets = [];

    public function load()
    {
        $widgets = scandir(BASE_PATH . "/widgets/");

        unset($widgets[0], $widgets[1]);

        foreach($widgets as $widget){
            require_once BASE_PATH . "/widgets/$widget/init.php";
        }
    }

    public function add($widget)
    {
        $this->widgets[] = $widget;
    }
    
    public function getAll()
    {
        $widgets = [];

        foreach($this->widgets as $widget)
        {
            $wg = $widget;
            $extend = $widget->extend;

            if( $extend ) {
                $e_wg = $this->get($extend);

                if( $e_wg ){
                    $wg->css = array_merge($wg->css, $e_wg->css);

                    if( $e_wg->others ){
                        $wg->others = array_merge($wg->others, $e_wg->others);
                    }
                }
            }

            $widgets[] = $wg->__serialize();
        }

        return $widgets;
    }

    public function get(string $name)
    {
        foreach($this->widgets as $widget) {
            if( $widget->getName() === $name ) {
                return $widget;
            }
        }
        
        return [];
    }

    public static function getInstance() 
    {
        if(is_null(self::$_instance)) {
          self::$_instance = new Widgets();  
        }
    
        return self::$_instance;
    }
}