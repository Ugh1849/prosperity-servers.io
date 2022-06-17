<?php

namespace App\Controllers;

use App\Layout;

class ViewController{
    public function index()
    {
        $layout = new Layout(config()->get("layout"));

        if( !$layout->exist() ){
            return "Invalid layout";
        }

        if( !request("steamid") ) {
            return "Invalid steamid";
        }

        return view("view", compact("layout"), "none");
    }
}