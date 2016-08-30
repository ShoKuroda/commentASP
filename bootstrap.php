<?php
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application/'));

// サーバネームの設定ファイルが存在すれば読み込む
if(file_exists("library/config/{$_SERVER['HTTP_HOST']}.php")){
	if ( $_SERVER["HTTP_X_FORWARDED_PROTO"] == "http" ) {
        header( "HTTP/1.1 301 Moved Permanently" ); 
        header( "Location: https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}" );
        exit;
    };
    require_once( "library/config/{$_SERVER['HTTP_HOST']}.php" );
}else{
	require_once( "library/config/default.php" );
}

require_once( CB_FW_ROOT . '/library/CB/bootstrap.php' );
