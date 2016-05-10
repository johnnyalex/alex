<?php
//var_dump($_POST);
include './init.php';
if(empty($_POST['username'])||empty($_POST['password'])||empty($_POST['repassword'])||empty($_POST['code'])){
    echo '请将信息填写完整 <a href="register.php">返回</a>';exit;
}
$name =$_POST['username'];
$sql="SELECT id FROM ".PRE."user WHERE name='{$name}'";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    echo '用户名已存在请重新输入 <a href="register.php">返回</a>';exit;
}
$code=$_POST['code'];
if(strtoupper($_SESSION['vcode'])!=strtoupper($code)){
    echo '验证码不正确请重新输入 <a href="register.php">返回</a>';exit;
}
//4-16位字符,字母开头,支持子母数字及"_"组合
$upreg='/^[a-zA-Z][a-zA-Z0-9_]{3,15}$/';
$ppreg='/^\w{5,15}$/';
$pwd=$_POST['password'];
$rpwd=$_POST['repassword'];
if($pwd!=$rpwd){
    echo '两次输入密码不一致请重新输入 <a href="register.php">返回</a>';exit;
}
if(!preg_match($upreg,$name)){
    echo '用户名格式不正确请重新输入 <a href="register.php">返回</a>';exit;
}
if(!preg_match($ppreg,$pwd)){
    echo '密码格式不正确请重新输入 <a href="register.php">返回</a>';exit;
}
$pwd=md5($pwd);
$sql="INSERT INTO ".PRE."user(name,password,type,display) VALUES('{$name}','{$pwd}',0,1)";
//echo $sql;
$result=mysqli_query($link,$sql);
if($result&&mysqli_affected_rows($link)){
    echo '注册成功 <a href="login.php">登录</a>';
}

