<div class="container h-100">
    <div class="row h-100">
        <div class="col-md-6 mx-auto my-auto">
            <h1><?= __("login.title") ?></h1>
            <p class="text-muted"><?= __("login.subtitle") ?></p>
            
            <?php require("components/error.php"); ?>

            <div class="bg-white shadow p-3 mb-5 bg-white rounded w-100">
                <img src="./resources/img/admin.png" alt="Unknown image" width="100px" height="100px" class="mt-2 mb-1 mx-auto d-block">
                
                <div class="text-center mb-3">admin</div>

                <form method="POST" action="">
                    <input type="hidden" name="steamLogin">

                    <button type="submit" class="btn btn-custom btn-block"><?= __("login.title") ?></button>
                </form>
            </div>        
        </div>
    </div>
</div>