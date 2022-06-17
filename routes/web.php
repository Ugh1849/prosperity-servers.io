<?php

$router = new App\AltoRouter();
$router->setBasePath(rtrim(BASE_URL, "/"));

// GLOBAL ROUTES

$router->map("GET", '/', "IndexController@index", "Home");
$router->map("GET", '/view', "ViewController@index", "View");
$router->map("GET", '/install', "InstallController@index", "Install");
$router->map("POST", '/install', "InstallController@store", "");

$router->map("GET", '/login', "LoginController@index", "Login");
$router->map("POST", '/login', "LoginController@login", "");

$router->map("POST", '/logout', "LoginController@logout", "Logout");

$router->map("GET", '/creator', "CreatorController@index", "Creator");
$router->map("POST", '/creator', "CreatorController@store", "");
$router->map("GET", '/creator/fonts', "CreatorController@fonts", "Fonts");
$router->map("POST", '/creator/fonts', "CreatorController@addFont", "");
$router->map("POST", '/creator/fonts/delete', "CreatorController@deleteFont", "");
$router->map("GET", '/creator/[*:name]', "CreatorController@show", "Creator Panel");
$router->map("POST", '/creator/use', "CreatorController@use", "");
$router->map("POST", '/creator/delete', "CreatorController@delete", "");

// REST API

$router->map("GET", "/api/widgets", "ApiController@getWidgets", "");

$router->map("GET", "/api/widgets/[*:name]", "ApiController@getWidget", "");
$router->map("PATCH", "/api/widgets/[*:name]", "ApiController@renameLayout", "");

$router->map("POST", "/api/layout/[*:name]/save", "ApiController@saveLayout", "");
$router->map("GET", "/api/layout/[*:name]/get", "ApiController@getLayout", "");