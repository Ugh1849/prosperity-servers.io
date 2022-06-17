<?php

namespace App;

class User{
    public $steamid;

    public function __construct(string $steamid)
    {
        $this->steamid = $steamid;
    
        $this->load();
    }
    
    public function load()
    {
        $content = @file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . config('steam.apiKey') . "&steamids={$this->steamid}");
       
        if( !$content ){
            die("Steam API error! (check your api_key and steam API status)");
        }
        
        $json = \json_decode($content);

        if( !isset($json->response->players[0]) ){
            die("Invalid steamid64.");
        }

        $this->info = $json->response->players[0];
    }

    public function __serialize()
    {

        $steamid32 = $this->steamid64_to_32($this->info->steamid);

        return (object) [
            "user_steamid" => $this->info->steamid,
            "user_name" => $this->info->personaname,
            "user_avatar" => $this->info->avatarfull,
            "user_steamid32" => $steamid32
        ]; 
    }

    private function steamid64_to_32(string $steamid64)
    {
        $subid = substr($steamid64, 4);
        $steamY = (int) $subid;
        $steamY = $steamY - 1197960265728;
        $steamX = 0;

        if( $steamY % 2 == 1 ){
            $steamX = 1;
        } else {
            $steamX = 0;
        }
        
        $steamY = (($steamY - $steamX) / 2);
        $steamID = "STEAM_0:" . (string)$steamX . ":" . (string)$steamY;
        
        return $steamID;   
    }
}
