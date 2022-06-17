<?php

namespace App;

class Layout {
    private $layout = [];
    private $path = "";
    private $fileName = "";

    public function __construct(string $layoutName)
    {
        $fileName = strtolower($layoutName);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName = preg_replace('/[^A-Za-z0-9-]/', '', $fileName);

        $this->fileName = $fileName;

        $this->path = BASE_PATH . "/layouts/{$this->fileName}.json";

        $json = @file_get_contents($this->path);

        if( !$json ) return $this;

        $layout = json_decode($json);

        $this->layout = $layout;

        return $this;
    }
    
    public function create(array $layout)
    {
        if( file_exists($this->path) ) {
            return false;
        }
        
        $this->layout = $layout;
        
        return $this->save();
    }

    public function edit(string $key, $newValue)
    {
        $this->layout->$key = $newValue;
    }

    public function delete()
    {
        $this->layout = null;

        unlink($this->path);
    }
    
    public function save() : Layout
    {
        json_encode($this->layout, JSON_PRETTY_PRINT);
        
        file_put_contents($this->path, json_encode($this->layout, JSON_PRETTY_PRINT));
        
        return $this;
    }
    
    public function getName()
    {
        return $this->layout->name;
    }
    
    public function getFileName()
    {
        return $this->fileName;
    }

    public function exist()
    {
        return count((array) $this->layout) > 0;
    }
    
    public static function fetchAll()
    {
        $layoutsFiles = scandir(BASE_PATH . "/layouts/");
        
        unset($layoutsFiles[0], $layoutsFiles[1]);
        
        $layouts = (object) [];
        
        foreach ($layoutsFiles as $k => $v) {
            $path = substr($v, 0, -5);
            $layout = new Layout($path);
            
            $layouts->$k = $layout;
        }
        
        return $layouts;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function __serialize()
    {
        return json_encode($this->layout);
    }
}