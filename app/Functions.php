<?php

if ( !function_exists("view") ){
    function view(string $view, array $vars = [], $v_layout = "default")
    {
        foreach($vars as $key => $value){
            ${$key} = $value;
        }

        $title = $GLOBALS["title"];
        $v_layout = $v_layout ? $v_layout : "default";

        if( $v_layout === "none" ){
            require_once BASE_PATH . "/resources/views/$view.php";
            return;
        }

        ob_start();

        require_once BASE_PATH . "/resources/views/$view.php";
        
        $content = ob_get_clean();

        require_once BASE_PATH . "/resources/views/layout/$v_layout.php";
    }
}

if( !function_exists("request") ){
    function request(string $key = null)
    {
        $state = App\Request::getInstance();
        $state->setMethod($_SERVER["REQUEST_METHOD"]);

        if ( $key ){
            return $state->get($key);
        }

        return $state;
    }
}

if( !function_exists("config") ){
    function config(string $key = null)
    {
        $state = App\Config::getInstance();

        if ( $key ){
            return $state->get($key);
        }

        return $state;
    }
}

if( !function_exists("back") ){
    function back()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
        return;
    }
}

if( !function_exists("redirect") ){
    function redirect(string $url)
    {
        header('Location: ' . rtrim(BASE_URL, "/") . $url);
        exit();
        return;
    }
}

if( !function_exists("isUrl") ){
    function isUrl(string $url)
    {
        return strpos(FULL_URL, $url) !== false;
    }
}

if( !function_exists("__") ){
    function __(string $key)
    {
        $language = App\Language::getInstance();

        return $language->get($key);
    }
}

if (!function_exists('array_key_first')) {
    function array_key_first(array $arr) {
        foreach($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
}