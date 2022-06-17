<?php
    $db = \App\Database::getInstance();
    
    $query = $db->query("SELECT MIN(uid) AS uid, rpname, wallet FROM darkrp_player GROUP BY rpname ORDER BY wallet DESC LIMIT 5");   
    $players = $query->fetchAll();

    $bestPlayers = [];

    foreach($players as $player){
        $bestPlayers[$player->rpname] = $player->wallet;
    }
?>

<div class="w-100 h-100" style="display:table;">
    <div style="display:table-cell;vertical-align:middle;">
        <?php foreach($bestPlayers as $k => $v): ?>
            <p class="text-break text-truncate"><?= $k ?> - $<?= number_format($v) ?></p>
        <?php endforeach; ?>
    </div>
</div>