<?php

define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application/'));

/*
 * メモリ制限。適宜変更する。
 */
ini_set( "memory_limit" , "1024M" );

$hostname = exec("uname -n");

// サーバネームの設定ファイルが存在すれば読み込む
if($file_exists(APPLICATION_PATH."/../library/config/default.php")){
        require_once(APPLICATION_PATH."/../library/config/default.php" );
}else{
        require_once( "library/config/".$_SERVER["SERVER_NAME"].".php" );
}

require_once( CB_FW_ROOT . '/library/CB/bootstrap.php' );