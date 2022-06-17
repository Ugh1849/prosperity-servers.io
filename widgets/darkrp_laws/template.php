<?php
    $db = \App\Database::getInstance();

    $laws = [
        "Do not attack other citizens except in self-defence.",
        "Do not steal or break into people's homes.",
        "Money printers/drugs are illegal.",
    ];
    
    if( request("steamid") ){
        $req = $query = $db->query("SELECT value FROM loading_screen_creator WHERE key = 'laws' LIMIT 1");   
        $res = $req->fetch();

        if( $res && $res->value != null ){
            $laws = json_decode($res->value);
        } else {
            $laws = [];
        }
    }
?>

<div class="w-100 h-100" style="display:table;">
    <div style="display:table-cell;vertical-align:middle;">
        <?php foreach($laws as $k => $v): ?>
            <p class="text-break text-truncate"><?= $k + 1 ?> - <?= $v ?></p>
        <?php endforeach; ?>
    </div>
</div>
