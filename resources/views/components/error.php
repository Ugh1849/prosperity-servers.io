<?php if(isset($_SESSION["errors"])) { ?>
    <div class="alert alert-danger" role="alert">
        <ul class="m-0 b-0">
            <?php foreach ($_SESSION["errors"] as $k => $v) { ?>
                <li><?= $v ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } unset($_SESSION["errors"]); ?>