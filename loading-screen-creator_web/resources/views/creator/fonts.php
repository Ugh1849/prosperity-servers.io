<div class="container h-100">
    <div class="row h-100">
        <div class="col-md-6 mx-auto my-auto">
            <h1><?= __("creator.fonts.title") ?></h1>
            
            <?php require(BASE_PATH . "/resources/views/components/error.php"); ?>
            
            <p class="text-muted"><?= __("creator.fonts.subtitle") ?></p>

            <?php foreach ($fonts as $font => $link) { ?>
                <div class="btn-group w-100 mb-3">
                    <a class="btn btn-custom btn-block" style="cursor: default;"><?= $font ?> </a>
                    <button type="button" class="btn btn-custom-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    
                    
                    <div class="dropdown-menu">                      
                        <form action="./creator/fonts/delete" method="POST" class="p-0 m-0"> 
                            <input type="hidden" name="font_name" value="<?= $font ?>">
                            <input type="submit" class="dropdown-item" value="<?= __("creator.fonts.remove_font") ?>">
                        </form>
                    </div>
                </div>
            <?php } ?>

            <p class="text-muted"><?= __("creator.fonts.subtext") ?></p>

            <div class="bg-white shadow p-3 bg-white rounded w-100">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="font_name"><?= __("name") ?></label>
                        <input type="text" class="form-control" id="font_name" name="font_name" placeholder="Arial" required>
                    </div>

                    <div class="form-group">
                        <label for="font_link"><?= __("creator.fonts.direct_link") ?></label>
                        <input type="text" class="form-control" id="font_link" name="font_link" placeholder="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;700" required>
                    </div>

                    <button type="submit" class="btn btn-custom btn-block"><?= __("creator.fonts.add_font") ?></button>
                </form>
            </div>
            
            <p class="text-muted mt-3"><a href="./creator"><?= __("creator.fonts.or_go_back") ?></a></p>
        </div>
    </div>
</div>