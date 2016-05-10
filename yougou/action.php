<?php
include 'init.php';
var_dump($_GET);
$p=$_GET['p'];
$oid=$_GET['oid'];
switch($p){
case '2':
    $sql="UPDATE ".PRE."order SET status={$p} WHERE id={$oid}";
    $result=mysqli_query($link,$sql);
    if($result){
    header('location:personal.php');
    }
    break;
case '4':
    $sql="UPDATE ".PRE."order SET status={$p} WHERE id={$oid}";
    $result=mysqli_query($link,$sql);
    if($result){
    header('location:personal.php');
    }
    break;
}

