<?php

use App\Widgets;

$widget = new App\Widget();

$widget->setName("Text");

$widget->setCSS([
    "color" => "#000000",
    "font-size" => "1vw",
    "font-weight" => "normal",
    "font-family" => array_key_first(config("fonts")) ? array_key_first(config("fonts")) : "Arial",
    "text-align" => "center",

    "z-index" => "10"
]);

$widget->setOthers([
    "resizable" => [
        "minHeight" => "30",
        "minWidth" => "100",
    
        "defaultHeight" => "30",
        "defaultWidth" => "100"
    ]
]);

$widget->setVariable("text", "Text");

Widgets::getInstance()->add($widget);