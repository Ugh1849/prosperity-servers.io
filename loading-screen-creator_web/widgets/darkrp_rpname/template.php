<?php
    $db = \App\Database::getInstance();

    $rpname = "RP Name";
    
    if( request("steamid") ){
        $req = $query = $db->query("SELECT rpname FROM darkrp_player WHERE uid = :steamid LIMIT 1", ["steamid" => request("steamid")]);   
        $res = $req->fetch();

        if( $res ){
            $rpname = $res->rpname;
        } else {
            $rpname = "{{ user_name }}";
        }
    }
?>

<div class="w-100 h-100" style="display:table;">
    <div style="display:table-cell;vertical-align:middle;">
        <div><?= $rpname ?></div>
    </div>
</div>
