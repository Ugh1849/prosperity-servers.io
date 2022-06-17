<?php

use App\Widgets;

$widget = new App\Widget();

$widget->setName("Box");

$widget->setCSS([
    "background-color" => "#ffffffff",
    "background-image" => "",
    "border-radius" => "0px",
    "opacity" => "1",
    "background-size" => "cover",
    "background-position" => "center center",
    
    "box-shadow" => "0px 0px 0px rgba(0, 0, 0, 0.2)",
    
    "border-width" => "0",
    "border-color" => "#000000",
    "border-style" => "solid",

    "z-index" => "5"
]);

$widget->setOthers([
    "resizable" => [
        "minHeight" => "1%",
        "minWidth" => "2%",
    
        "defaultHeight" => "5%",
        "defaultWidth" => "5%"
    ]
]);

Widgets::getInstance()->add($widget);