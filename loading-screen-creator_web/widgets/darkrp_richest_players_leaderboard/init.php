<?php

use App\Widgets;

$widget = new App\Widget();

$widget->setName("(DarkRP) Richest players leaderboard");
$widget->extend("Text");

// $widget->setCSS([
//     "color" => "#000000",
//     "font-size" => "24px",
//     "font-weight" => "normal",
//     "font-family" => "Roboto",

//     "z-index" => "10"
// ]);

// $widget->setOthers([
//     "resizable" => [
//         "minHeight" => "30",
//         "minWidth" => "100",
    
//         "defaultHeight" => "30",
//         "defaultWidth" => "100"
//     ]
// ]);

// $widget->setVariable("text", "Text");

Widgets::getInstance()->add($widget);