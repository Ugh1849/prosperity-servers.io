<?php

use App\Widgets;

$widget = new App\Widget();

$widget->setName("Avatar image");

$widget->extend("Box");

// $widget->setOthers([
//     "resizable" => [
//         "minHeight" => "5%",
//         "minWidth" => "5%",
    
//         "defaultHeight" => "5%",
//         "defaultWidth" => "5%"
//     ]
// ]);

Widgets::getInstance()->add($widget);