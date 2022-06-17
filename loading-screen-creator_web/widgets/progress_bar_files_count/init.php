<?php

use App\Widgets;

$widget = new App\Widget();

$widget->setName("Progress Files Count");
$widget->extend("Text");

Widgets::getInstance()->add($widget);