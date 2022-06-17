<div class="container h-100">
    <div class="row h-100">
        <div class="col-md-6 mx-auto my-auto">
            <h1><?= __("creator.title") ?></h1>
            
            <?php require(BASE_PATH . "/resources/views/components/error.php"); ?>
            
            <p class="text-muted"><?= __("creator.subtitle") ?></p>

            <?php foreach ($layouts as $layout) { ?>
                <div class="btn-group w-100 mb-3">
                    <a href="./creator/<?= $layout->getFileName() ?>" class="btn btn-custom btn-block"><?= sprintf(__("creator.listing"), $layout->getName()) ?> <?= config()->get("layout") === $layout->getFileName() ? " (" . __("creator.current") . ")" : "" ?> </a>
                    <button type="button" class="btn btn-custom-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    
                    
                    <div class="dropdown-menu">
                        <?php if( config()->get("layout") !== $layout->getFileName() ) { ?>
                        <form action="./creator/use" method="POST" class="p-0 m-0">
                            <input type="hidden" value="<?= $layout->getFileName() ?>" name="layout">
                            <input type="submit" class="dropdown-item" value="<?= __("creator.use_layout") ?>">
                        </form>
                        <?php } ?>
                        
                        <form action="./creator/delete" method="POST" class="p-0 m-0"> 
                            <input type="hidden" value="<?= $layout->getFileName() ?>" name="layout">
                            <input type="submit" class="dropdown-item" value="<?= __("creator.delete_layout") ?>">
                        </form>
                    </div>
                </div>
            <?php } ?>

            <p class="text-muted mt-3"><?= __("creator.subtext") ?></p>

            <div class="bg-white shadow p-3 bg-white rounded w-100">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="layout_name"><?= __("name") ?></label>
                        <input type="text" class="form-control" id="layout_name" name="layout_name" placeholder="<?= __("creator.name_placeholder") ?>" required minlength="1" maxlength="32">
                    </div>

                    <button type="submit" class="btn btn-custom btn-block"><?= __("creator.create_layout") ?></button>
                </form>
            </div>
            
            <p class="text-muted mt-3"><a href="./creator/fonts"><?= __("creator.or_manage_fonts") ?></a></p>
            <p class="text-muted mt-3"><a href="./"><?= __("creator.or_go_back") ?></a></p>
        </div>
    </div>
</div>