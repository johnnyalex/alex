<?php
include'./init.php';
//var_dump($_POST);
$username=$_POST['username'];
$password=$_POST['password'];
$sql="SELECT id,name,password,sex,type,display,login FROM ".PRE."user WHERE name='{$username}'";
//echo $sql;
$result=mysqli_query($link,$sql);
if($result){
    $row=mysqli_fetch_assoc($result);
    $password=md5($password);
    if($password==$row['password']){
        unset($row['password']);
        $_SESSION['home']=$row;
//        var_dump($row);exit;
    $login=$row['login'];
        $login+=1;
        $sql="UPDATE ".PRE."user SET login={$login} WHERE id={$row['id']}";
        //    echo $sql;exit;    
        $result=mysqli_query($link,$sql);
    header ('location:index.php');        
//    echo '登录成功<a href="index.html">继续购物</a>';
    }else{
        echo '用户名或密码不正确,点此<a href="login.php">返回</a>';
    }
}else{
    echo '用户名或密码不正确,点此<a href="login.php">返回</a>';
}
