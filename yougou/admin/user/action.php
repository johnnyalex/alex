<?php
include '../init.php';
//var_dump($_GET);
//var_dump($_POST);
$a=$_GET['a'];
switch($a){
    case 'add':
        $name=$_POST['name'];
        $password=$_POST['password'];
        $repassword=$_POST['repassword'];
        $sex=$_POST['sex'];
        $type=$_POST['type'];
        if($password != $repassword){
            echo '两次密码不一致<a href="./add.php">返回</a>';exit;
        }
        $password=md5($password);
        $sql="INSERT INTO ".PRE."user(id,name,password,sex,type) VALUES(NULL,'{$name}','{$password}',{$sex},{$type})";
        //echo $sql;
        $result=mysqli_query($link,$sql);
        if($result){
            echo '添加成功<a href="index.php">返回</a>';
        }else{
            echo '添加失败<a href="./add.php">返回</a>';
        }
        break;
    case 'edit':
        $id=$_POST['id'];
//        echo $id;
        $name=$_POST['name'];
        $sex=$_POST['sex'];
        $type=$_POST['type'];
        $password=$_POST['password'];
        $password=md5($password);
        if($_POST['password']!=$_POST['repassword']){
        echo '两次输入密码不一致,点此<a href="edit.php?id='.$id.'">返回</a>';exit;
        }elseif(empty($_POST['password'])){
            $sql="UPDATE ".PRE."user SET name='{$name}',sex={$sex},type={$type} WHERE id={$id}";//echo 'ss';
        }elseif(!empty($_POST['password'])){
            $sql="UPDATE ".PRE."user SET name='{$name}',password='{$password}',sex={$sex},type={$type} WHERE id={$id}";//echo $sql;
        }
        $result=mysqli_query($link,$sql);
        if($result){
            echo '修改成功<a href="index.php">返回</a>';exit;
        }else{
            echo '修改失败<a href="edit.php?id='.$id.'">返回</a>';
        }
        break;
    case 'del':
        $id=$_GET['id'];
        $sql="DELETE FROM ".PRE."user WHERE id={$id}";
        $result=mysqli_query($link,$sql);
        if($result){
            header('location:index.php');
        }else{
            header('location:index.php');
        }
        break;
    case 'display':
        $id=$_GET['id'];
        $display=$_GET['display'];
        $sql="UPDATE ".PRE."user SET display={$display} WHERE id={$id}";
        $result=mysqli_query($link,$sql);
        if($result){
            header('location:index.php');
        }else{
            header('location:index.php');
        }
        break;
}
