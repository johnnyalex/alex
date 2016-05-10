<?php
include 'init.php';
//var_dump($_POST);
//var_dump($_SESSION);
$receiver=$_POST['receiver'];
$address=$_POST['address'];
$email=$_POST['email'];
$tel=$_POST['tel'];
$zip=$_POST['zip'];
$user_id=$_SESSION['home']['id'];
$total=$_SESSION['home']['total'];
$time=date('Ymdhis').mt_rand(0,9999);
if(empty($_POST['receiver'])||empty($_POST['address'])||empty($_POST['email'])||empty($_POST['tel'])||empty($_POST['zip'])){
    echo '信息不完全 <a href="settle.php">返回</a>';
    exit;
}
//echo $time;
$sql="INSERT INTO ".PRE."order VALUES(NULL,{$time},'{$receiver}','{$address}','{$email}','{$tel}','{$zip}',{$user_id},{$total},1)";
$result=mysqli_query($link,$sql);
if($result&&mysqli_affected_rows($link)>0){
    foreach($_SESSION['cart'] as $key=>$val){
  //      echo $key;
        $sql="INSERT INTO ".PRE."order_goods VALUES(NULL,{$key},'{$val['gname']}','{$val['price']}',{$val['qty']},{$time})";
        $result=mysqli_query($link,$sql);
        if($result&&mysqli_affected_rows($link)>0){

        }else{
            echo 'failed <a href="index.php">back</a>';
        }
    }
    echo '订单提交成功 <a href="personal.php">返回个人中心</a>';
    unset($_SESSION['cart']);
}
