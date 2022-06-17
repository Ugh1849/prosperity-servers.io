<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?= BASE_URL ?>">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?> &middot; Loading Screen Creator</title>

        <link rel=‘dns-prefetch’ href=’//fonts.googleapis.com’ />
        
        <?php if( config("fonts") ){ ?>
        <?php foreach(config("fonts")  as $k => $v): ?>
            <?php if( strlen($v) < 1 ) continue; ?>
            <link rel="stylesheet" href="<?= $v ?>">
        <?php endforeach; ?>
        <?php } ?>

        <link rel="stylesheet" href="./resources/css/app.min.css">
    </head>
    <body>
        <?= $content ?>

        <script>
            window.fonts = <?= json_encode(config("fonts")) ?>
        </script>

        <script>
            window.language = <?= App\Language::getInstance()->__serialize() ?>;
            window.base_url = "<?= rtrim(BASE_URL, "/") ?>";
        </script>

        <script src="./resources/js/app.min.js"></script>
    </body>
</html>