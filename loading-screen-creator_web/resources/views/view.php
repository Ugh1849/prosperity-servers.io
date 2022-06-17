<?php 
    $l = $layout->getLayout(); 
    
    $user = new \App\User(request("steamid"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?= BASE_URL ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="layout" content="<?= $layout->getFileName() ?>">

    <title>Loading screen</title>

    <link rel=‘dns-prefetch’ href=’//fonts.googleapis.com’ />

    <?php foreach(config("fonts") as $k => $v): ?>
        <?php if( strlen($v) < 1 ) continue; ?>
        
        <link rel="stylesheet" href="<?= $v ?>">
    <?php endforeach; ?>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css">

    <link rel="stylesheet" href="./resources/css/view.min.css">
</head>
<body style="overflow: hidden;">
    <audio id='audio' src='' autoplay loop></audio>

    <div class="c-container"></div>

    <script>
        window.layout = <?= json_encode($l) ?>;
        window.user = <?= json_encode($user->__serialize()) ?>;
        window.base_url = "<?= rtrim(BASE_URL, "/") ?>";

        function GameDetails(servername, serverurl, mapname, maxplayers, steamid, gamemode, volume, language) {
            window.gameInfo = {
                name: servername,
                url: serverurl,
                map: mapname,
                maxPlayers: maxplayers,
                steamid: steamid,
                gamemode: gamemode,
                volume: volume,
                language: language,
            }
        }
    </script>

    <script src="./resources/js/view.js"></script>
</body>
</html>