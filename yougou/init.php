<?php
session_start();
define('PATH',str_replace('\\','/',dirname(__FILE__).'/'));
define('URL','http://localhost/alex/yougou/');
header("content-type:text/html;charset=utf-8");
date_default_timezone_set('PRC');
error_reporting(E_ALL ^ E_NOTICE);
include PATH.'./config.php';
include PATH.'./function.php';
$link=mysqli_connect(HOST,USER,PWD);
if(mysqli_connect_errno($link)){
    echo mysqli_connect_error($link);
    exit;
}
mysqli_select_db($link,DB);
mysqli_set_charset($link,CHARSET);
