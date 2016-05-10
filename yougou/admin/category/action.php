<?php
include '../init.php';
//var_dump($_GET);
//echo 'get';
//var_dump($_POST);
//echo 'post';

$a=$_GET['a'];
switch($a){
case 'add':
    $name=$_POST['name'];
    $pid=$_POST['pid'];
    $path=$_POST['path'];
    $display=$_POST['display'];
    $sql="INSERT INTO ".PRE."category(id,name,pid,path,display) VALUES(NULL,'{$name}',{$pid},'{$path}',{$display})";
//    echo $sql;exit;
    $result=mysqli_query($link,$sql);
    if($result){
        echo '添加成功<a href="index.php">返回</a>';
    }else{
        echo '添加失败<a href="add.php">返回</a>';
    }
    break;
case 'edit':
    $name=$_POST['name'];
    $display=$_POST['display'];
    $pid=$_POST['pid'];
    $sql="UPDATE ".PRE."category SET name='{$name}',display={$display} WHERE id={$pid}";
   // echo $sql;
    $result=mysqli_query($link,$sql);
    if($result){
        echo '修改成功<a href="index.php">返回</a>';
    }else{echo $pid;
        echo '修改失败<a href="index.php">返回</a>';
    }
    break;
case 'del':
    $id=$_GET['id'];
   // $pid=$_GET['pid'];
    $sql="SELECT id,name,pid,path FROM ".PRE."category WHERE pid={$id}";
    $result=mysqli_query($link,$sql);
    if($result && mysqli_num_rows($result)>0){
        echo '请先删除子分类 <a href="index.php">返回</a>';exit;
    }else{
        $sql="DELETE FROM ".PRE."category WHERE id={$id}";
        $result=mysqli_query($link,$sql);
        if($result){
        header('location:index.php');
        }else{
        echo '删除失败<a href="index.php">返回</a>';
        }
    }
    break;
case 'display':
        $id = $_GET['id'];
        $display= $_GET['display'];
        $sql = "UPDATE ".PRE."category SET display={$display} WHERE id={$id}";
        $result = mysqli_query($link,$sql);
  //      echo $sql;exit;
        if($result){
            header('location:index.php');
        }else{
            header('location:index.php');
        }
        break;
        

        break;
}
