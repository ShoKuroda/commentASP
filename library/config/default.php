<?php
/*=====================================
    PATHの定義
=====================================*/
define('CB_FRAMEWORK_PRE', 'CA');
define('CB_FW_ROOT'      , "/usr/share/php/CBFramework_3.1");
define('HTDOCS_ROOT'     , realpath(dirname(__FILE__).'/../../'));
define('CB_BASE'         , HTDOCS_ROOT);
define('CB_PUBLIC'         , CB_BASE    . '/public/');
define('CB_SMARTY_CONFIG' , CB_PUBLIC .'_configs/default.global.inc');
define('CB_TMP'          , CB_BASE . "/../tmp");
define('CB_DEBUGGING'    , 0);

/*=====================================
    データベース定義
=====================================*/
define('CB_DB_TYPE' , 'pdo_mysql');
define('CB_DB_HOST' , 'comment-asp.ctscvoby7rnj.ap-northeast-1.rds.amazonaws.com');
define('CB_DB_PORT' , '3306');
define('CB_DB_NAME' , 'comment');
define('CB_DB_USER' , 'root');
define('CB_DB_PASS' , 'obpon0jybsc8');


/*=====================================
    アドレスの定義
=====================================*/
define("SYSTEM_MAIL_FROM", "no-reply@review-asp.com");
define("SYSTEM_MAIL_NAME", "Review ASP運営事務局");
define("CONTACT_MAIL", "");
define("BCC_MAIL", "");

/*=====================================
    その他の定義
=====================================*/
define('KEY', '79iBEQqN6kjs');
define('FREE_DAY', '7');
define('PRICE', '10000');
define('STERT_PRICE', '30000');
define('TERM_DAY', '30');

/*=====================================
    振込先
=====================================*/
define('BANK', 'ゆうちょ銀行');
define('BANK_BRANCH', '〇一八ゼロイチハチ（018）');
define('BANK_TYPE', '普通口座');
define('BANK_NUMBER', '4370335');
define('BANK_NAME', 'カ）＊＊＊');
