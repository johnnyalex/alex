<?php
//var_dump($_POST);
include './init.php';
$username=$_POST['username'];
$password=$_POST['pwd'];
//var_dump($link);
$sql="SELECT id,name,password,sex,type,display,login FROM ".PRE."user WHERE name='{$username}' AND type !=0";
$result=mysqli_query($link,$sql);
if($result && mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
//    var_dump($row);
    $password=md5($password);
    if($password == $row['password']){
        unset($row['password']);
//        var_dump($row);
        $type=$row['type'];
//        echo $type;exit;
        if($type==0){
echo '请使用管理员账号登陆<a href="login.php">返回</a>';exit;
        }
        $_SESSION['admin']=$row;
        $login=$row['login'];
        $login+=1;
        $sql="UPDATE ".PRE."user SET login={$login} WHERE id={$row['id']}";
        $result=mysqli_query($link,$sql);
//        var_dump($_SESSION);
        header('location:./index.php');
    }else{
        echo '用户名或密码不正确,点此<a href="login.php">返回</a>';
    }
}else{
    echo '用户名或密码不正确,点此<a href="login.php">返回</a>';
}

