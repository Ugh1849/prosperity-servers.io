<div class="container h-100">
    <div class="row h-100">
        <div class="col-md-12 my-auto">
            <h1>Installation settings</h1>
            <p class="text-muted">Please fill in all the fields below</p>
            
            <?php require("components/error.php"); ?>

            <div class="bg-white shadow p-3 mb-5 bg-white rounded w-100">

                <form method="POST" action="">
                    <label class="custom mb-2 d-block">Database Type</label>

                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="db_type" id="database-mysql" value="mysql" checked>
                        <label class="form-check-label" for="database-mysql">
                            MySQL
                        </label>
                    </div>

                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="radio" name="db_type" id="database-sqlite" value="sqlite">
                        <label class="form-check-label" for="database-sqlite">
                            SQLite
                        </label>
                    </div>
                    
                    <div class="togglable">
                        <div class="form-group">
                            <label for="db_host">Database Host</label>
                            <input type="text" class="form-control" id="db_host" name="db_host" placeholder="127.0.0.1">
                        </div>

                        <div class="form-group">
                            <label for="db_name">Database Name</label>
                            <input type="text" class="form-control" id="db_name" name="db_name" placeholder="gmod">
                        </div>
    
                        <div class="form-group">
                            <label for="db_port">Database Port</label>
                            <input type="number" class="form-control" id="db_port" name="db_port" placeholder="3306">
                        </div>
    
                        <div class="form-group">
                            <label for="db_username">Database Username</label>
                            <input type="text" class="form-control" id="db_username" name="db_username" placeholder="root">
                        </div>
                        
                        <div class="form-group">
                            <label for="db_password">Database Password</label>
                            <input type="password" class="form-control" id="db_password" name="db_password" placeholder="••••••••••••">
                        </div>
                    </div>
                        
                    <div class="togglable d-none">
                        <div class="form-group">
                            <label for="db_directory">Database File Directory</label>
                            <input type="text" class="form-control" id="db_directory" name="db_directory" placeholder="/home/...">
                        </div>
                    </div>

                    <hr>
                    
                    <div class="form-group">
                        <label for="api_key">API Key <a href="https://steamcommunity.com/dev/apikey" target="_blank" class="text-primary">?</a></label>
                        <input type="text" class="form-control" id="api_key" name="api_key" placeholder="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" required>
                    </div>

                    <button type="submit" class="btn btn-custom btn-block">Install</button>
                </form>
            </div>        
        </div>
    </div>
</div>