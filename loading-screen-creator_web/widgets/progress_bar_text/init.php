<?php

use App\Widgets;

$widget = new App\Widget();

$widget->setName("Progress text");
$widget->extend("Text");

Widgets::getInstance()->add($widget);