<?php

use App\Widgets;

$widget = new App\Widget();

$widget->setName("Progress bar");
$widget->extend("Box");

Widgets::getInstance()->add($widget);