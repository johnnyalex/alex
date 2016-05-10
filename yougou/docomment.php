<?php
include 'init.php';
//var_dump($_POST);
$comment=$_POST['comment'];
$goods_id=$_POST['id'];
$user_id=$_SESSION['home']['id'];
$user_name=$_SESSION['home']['name'];
//var_dump($_SESSION);
$sql="INSERT INTO ".PRE."goods_comment VALUES(NULL,'{$comment}',{$goods_id},{$user_id},'{$user_name}')";
$result=mysqli_query($link,$sql);
if($result&&mysqli_affected_rows($link)>0){
    echo '添加成功<a href="personal.php">返回</a>';
}
