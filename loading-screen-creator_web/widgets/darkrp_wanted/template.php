<?php
    $db = \App\Database::getInstance();

    $wanted = [
        "Jackob Turner",
        "Damian Nixon",
        "Jaydon Walton",
    ];
    
    if( request("steamid") ){
        $req = $query = $db->query("SELECT value FROM loading_screen_creator WHERE key = 'wanted' LIMIT 1");   
        $res = $req->fetch();

        if( $res && $res->value != null ){
            $wanted = json_decode($res->value);
        } else {
            $wanted = [];
        }
    }
?>

<div class="w-100 h-100" style="display:table;">
    <div style="display:table-cell;vertical-align:middle;">
        <?php foreach($wanted as $k => $v): ?>
            <p class="text-break text-truncate"><?= $v ?></p>
        <?php endforeach; ?>
    </div>
</div>
