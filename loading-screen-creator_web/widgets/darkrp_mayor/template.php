<?php
    $db = \App\Database::getInstance();

    $mayor = "Mayor name";
    
    if( request("steamid") ){
        $req = $query = $db->query("SELECT value FROM loading_screen_creator WHERE key = 'mayor' LIMIT 1");   
        $res = $req->fetch();

        if( $res && $res->value != null ){
            $mayor = $res->value;
        } else {
            $$mayor = "";
        }
    }
?>

<div class="w-100 h-100" style="display:table;">
    <div style="display:table-cell;vertical-align:middle;">
        <div><?= $mayor ?></div>
    </div>
</div>
