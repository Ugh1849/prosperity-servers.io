<?php

namespace App\Controllers;

use App\Layout;
use App\Widget;
use App\Widgets;
use App\Validator;

class ApiController {
    public function getWidgets()
    {
        $widgets = Widgets::getInstance()->getAll();

        return json_encode($widgets);
    }

    public function getWidget()
    {
        $widgets = Widgets::getInstance()->get(request("name"));

        return json_encode($widgets);
    }

    public function renameLayout()
    {
        $permanentName = (string) htmlspecialchars($_GET["name"]);

        parse_str(file_get_contents('php://input'), $_PATCH);

        $newLayoutName = (string) htmlspecialchars($_PATCH["newName"]);
        
        $layout = new Layout($permanentName);

        if( !$layout->exist() ) {
            http_response_code(404);
            return;
        }

        $layout->edit("name", $newLayoutName);
        $layout->save();

        http_response_code(204);
        return;
    }

    public function saveLayout()
    {
        $layout = new Layout($_GET["name"]);

        if( !$layout->exist() ){
            http_response_code(404);
            return;
        }

        $layout->edit("widgets", request("widgets"));
        $layout->edit("sound", request("sound"));
        $layout->edit("body", request("body"));
        $layout->save();

        http_response_code(204);
        return;
    }

    public function getLayout()
    {
        $name = request("name");

        $layout = new Layout($name);

        if( !$layout->exist() ){
            http_response_code(404);
            return;
        }

        return $layout->__serialize();
    }
}