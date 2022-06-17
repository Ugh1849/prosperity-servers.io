<?php

use App\Widgets;

$widget = new App\Widget();

$widget->setName("Image");

$widget->setCSS([
    "background-image" => "",
    "border-radius" => "0px",
    "opacity" => "1",
    "background-size" => "100% 100%",
    "background-repeat" => "no-repeat",
    "background-position" => "center center",

    "z-index" => "5"
]);

$widget->setOthers([
    "resizable" => [
        // "minHeight" => "30",
        // "minWidth" => "100",
    
        "defaultHeight" => "5%",
        "defaultWidth" => "5%"
    ]
]);

Widgets::getInstance()->add($widget);