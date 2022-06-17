<?php

namespace App\Controllers;

use PDO;
use App\Config;
use App\Database;
use PDOException;
use App\Validator;

class InstallController{
    /**
     * Show installation form
     *
     * @return void
     */
    public function index()
    {
        return view("install");
    } 

    /**
     * Store Informations installation
     *
     * @return void
     */
    public function store()
    {
        $validator = new Validator();
        $validator->name("api_key")->min(20)->max(40)->required();
        $validator->validate();

        $data = request()->all();

        $config = [
            "database" => [
                "selected" => $data->db_type,

                "mysql" => [
                    "host" => $data->db_host,
                    "port" => $data->db_port,
                    "username" => $data->db_username,
                    "password" => $data->db_password,
                    "name" => $data->db_name
                ],
    
                "sqlite" => [
                    "path" => $data->db_directory
                ],                
            ],

            "steam" => [
                "apiKey" => $data->api_key
            ],

            "fonts" => [
                "Rajdhani" => "https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700"
            ]
        ];

        $selected = $config["database"]["selected"];

        if( !empty($data->db_host) || !empty($data->db_directory) ){
            try{

                if( $selected === "mysql" ) {
                    $mysql = $config["database"]["mysql"];
    
                    $pdo = new PDO("mysql:host={$mysql["host"]};dbname={$mysql["name"]};port={$mysql["port"]}", $mysql["username"], $mysql["password"]);
                } elseif( $selected === "sqlite" ){
                    $sqlite = $config["database"]["sqlite"];
                    
                    $pdo = new PDO("sqlite:{$sqlite["path"]}");
                }
            } catch( PDOException $e ){
                $_SESSION["errors"][] = "Connection to database failed.";
                return back();
            }
        }

        config()->setAll($config);

        return back();
    }
}