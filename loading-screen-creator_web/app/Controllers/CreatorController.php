<?php

namespace App\Controllers;

use App\Config;
use App\Layout;
use App\Validator;

class CreatorController{
    public function index()
    {
        $layouts = Layout::fetchAll();

        return view("creator/index", compact("layouts"));
    }

    public function show()
    {
        $name = request("name");

        $layout = new Layout($name);

        if( !$layout->exist() ){
            return redirect("/creator");
        }

        return view("creator/show", compact("layout"));
    }

    public function store()
    {
        $validator = new Validator();
        $validator->name("layout_name")->min(1)->max(32)->required();
        $validator->validate();
        
        $data = request()->all();

        $layout = new Layout($data->layout_name);
        $created = $layout->create([
            "name" => $data->layout_name,
            "widgets" => []
        ]);

        if( $created === false ) {
            $_SESSION["errors"][] = "This layout name is already taken";
            return back();
        }

        return redirect("/creator/{$layout->getFileName()}");
    }

    public function use()
    {
        $layout = new Layout(request("layout"));

        if( !$layout->exist() ){
            $_SESSION["errors"][] = "Unknown layout, please try again";
            return back();
        }

        config()->set("layout", request("layout"));

        return back();
    }

    public function delete()
    {
        $layout = new Layout(request("layout"));

        if( !$layout->exist() ){
            $_SESSION["errors"][] = "Unknown layout, please try again";
            return back();
        }

        $layout->delete();

        if( config()->get("layout") === request("layout")){
            config()->set("layout", null);
        }

        return back();
    }

    public function fonts()
    {
        $fonts = config("fonts");

        return view("creator/fonts", compact("fonts"));
    }

    public function addFont()
    {
        $validator = new Validator();
        $validator->name("font_name")->min(1)->max(255)->required();
        $validator->name("font_link")->min(1)->required();
        $validator->validate();

        $fonts = config("fonts");

        $fontName = request("font_name");
        $fontLink = request("font_link");

        if( $fonts[$fontName] ) {
            $_SESSION["errors"][] = "The font name is already taken";
            return back();
        }

        $fonts[$fontName] = $fontLink;

        config()->set("fonts", $fonts);

        return back();
    }

    public function deleteFont()
    {
        $validator = new Validator();
        $validator->name("font_name")->min(1)->max(255)->required();
        $validator->validate();

        $fonts = config("fonts");

        $fontName = request("font_name");

        if( !$fonts[$fontName] ) {
            $_SESSION["errors"][] = "Unknown font, please try again";
            return back();
        }

        unset($fonts[$fontName]);

        config()->set("fonts", $fonts);

        return back();
        
    }
}