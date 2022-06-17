<div class="container h-100">
    <div class="row h-100">
        <div class="col-md-6 my-auto mx-auto">
            <h1>
                <?= __("home.title") ?> 
                <small><a href="#" class="lead" onClick="document.getElementById('logoutForm').submit()">(<?= __("logout") ?>)</a></small>

                <form action="./logout" method="POST" id="logoutForm"></form>
            </h1>
            <p class="text-muted"><?= __("home.subtitle") ?></p>
            
            <?php require("components/error.php"); ?>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <a href="./view?steamid=76561198251737334" class="btn btn-custom btn-block btn-lg"><?= __("home.go_to_public") ?></a>
                </div>
                    
                <div class="col-md-12 mb-3">
                    <a href="./creator" class="btn btn-custom btn-block btn-lg"><?= __("home.go_to_creator") ?></a>
                </div>

                <div class="col-md-12">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" value='sv_loadingurl "<?= rtrim(BASE_URL, "/") ?>/view?steamid=%s"' id="copy-input" readonly>
                            
                            <span class="input-group-btn">
                                <button class="btn btn-custom" type="button" data-toggle="copy" data-target="#copy-input">
                                    <img src="./resources/img/font-awesome/clipboard.png" width="20" height="20"/>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>