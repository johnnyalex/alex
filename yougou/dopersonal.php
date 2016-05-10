<?php
include 'header.php';
//var_dump($_POST);
//var_dump($_SESSION);
$id=$_SESSION['home']['id'];
//echo $id;
$sql="SELECT password,sex,i.name FROM ".PRE."user u,".PRE."user_image i WHERE u.id={$id} AND i.user_id={$id}";
//echo $sql;
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
}
$osex=$row['sex'];
$sex=$_POST['sex'];
//echo $sex;
//echo $osex;
//var_dump($_FILES);
if(!empty($_FILES['pic']['name'])){
$filename=upload('pic',PATH.'uploads/');
    if(!$filename){
        echo '上传失败,请重新上传<a href="./add.php">返回</a>';
        exit;
    }
    $img_path=PATH.'uploads/';
    $img_path .=substr($filename,0,4).'/';
    $img_path .=substr($filename,4,2).'/';
    $img_path .=substr($filename,6,2).'/';
    $img_path .=$filename;
//    echo $img_path;
    if(!zoom($img_path,350,350)||!zoom($img_path,80,80)||!zoom($img_path,50,50)){
        $path_350=dirname($img_path).'/350_'.basename($img_path);
        $path_80=dirname($img_path).'/80_'.basename($img_path);
        $path_50=dirname($img_path).'/50_'.basename($img_path);
        @unlink($path_350);
        @unlink($path_80);
        @unlink($path_50);
        @unlink($img_path);
        echo '缩放失败,请重新上传图片<a href="add.php">返回</a>';
        exit;
    }
//    var_dump($_SESSION);
    $user_id=$_SESSION['home']['id'];
    $sql="INSERT INTO ".PRE."user_image VALUES(NULL,'{$filename}',{$id})";
    $value=mysqli_query($link,$sql);
    if($result&&mysqli_affected_rows($link)>0){
        echo '头像修改成功 <a href="personal.php">返回</a>';
    }
}
//var_dump($row);
$oldpassword=$row['password'];
$password=$_POST['password'];
$password=md5($password);
$newpassword=$_POST['newpassword'];
$sex=$_POST['sex'];
//echo $sex;
//echo $password;
//echo $oldpassword;
if(!empty($_POST['password'])&&$sex==$osex){
if($password==$oldpassword){
    $ppreg='/^\w{5,15}$/';
    if(preg_match($ppreg,$newpassword)){
        $newpassword=md5($newpassword);
//        echo $newpassword;
        $sql="UPDATE ".PRE."user SET password='{$newpassword}',sex={$sex} WHERE id={$id}";
//        echo $sql;
        $result=mysqli_query($link,$sql);
        if($result&&mysqli_affected_rows($link)>0){
            echo '修改成功 <a href="personal.php">返回</a>';
        }
    }else{
        echo '密码格式不正确 <a href="personal.php">返回</a>';
    }
}else{
    echo '原密码不一致 <a href="personal.php">返回</a>';
}
}else{
    $sql="UPDATE ".PRE."user SET sex={$sex} WHERE id={$id}";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_affected_rows($link)>0){
        echo '修改成功 <a href="personal.php">返回</a>';
    }
}






