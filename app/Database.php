<?php

namespace App;

use PDO;
use PDOException;

class Database {
    private static $_instance = null;

    private $config = [];
    private $pdo;
    private $connected = false;

    public function __construct()
    {
        $this->config = (object) config("database");
    
        if( !$this->config->selected ) {
            return;
        }

        $selected = $this->config->selected;
        
        try{
            if( $selected === "mysql" ) {
                $mysql = (object) $this->config->mysql;

                $this->pdo = new PDO("mysql:host={$mysql->host};dbname={$mysql->name};port={$mysql->port}", $mysql->username, $mysql->password);
            } elseif( $selected === "sqlite" ){
                $sqlite = (object) $this->config->sqlite;
                
                $this->pdo = new PDO("sqlite:{$sqlite->path}");
            }

            $this->connected = true;
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch( PDOException $e ){
            $this->connected = false;
        }
    }

    public function query(string $query, array $params = [])
    {
        if(  $this->connected === false ) return $this;

        $req = $this->pdo->prepare($query);
        
        if( $req === false ){
            return $this;;
        }

        foreach($params as $k => $v){
            $req->bindValue($k, $v);
        }
        
        $req->execute();

        return $req;
    }

    public function fetchAll()
    {
        return (object) [];
    }
    
    public function fetch()
    {
        return (object) [];
    }
    
    public static function getInstance() 
    {
        if(is_null(self::$_instance)) {
          self::$_instance = new Database();  
        }
    
        return self::$_instance;
    }
}