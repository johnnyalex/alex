<?php
define('ADMIN_PATH',str_replace('\\','/',dirname(__FILE__).'/'));
define('ADMIN_URL','http://localhost/alex/yougou/admin/');
include ADMIN_PATH.'../init.php';
//if(empty($_SESSION['admin'])){
//    header('location:./login.php');
//}
$filename=basename($_SERVER['SCRIPT_NAME']);
$allow_array=array('login.php','dologin.php');
if(!in_array($filename,$allow_array)){
    if(empty($_SESSION['admin'])){
        header('location:'.ADMIN_URL.'login.php');
    }
}
