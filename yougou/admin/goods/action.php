<?php
include'../init.php';
//var_dump($_POST);
$a=$_GET['a'];
switch($a){
case 'add':
foreach($_POST as $val){
    if($val==''){
        echo '请将表单完善后再提交 <a href="./add.php">返回</a>';
        exit;
        }
}
    $filename=upload('pic',PATH.'uploads/');
    //echo $filename;
    if(!$filename){
        echo '上传失败,请重新上传<a href="./add.php">返回</a>';
        exit;
    }
    $img_path=PATH.'uploads/';
    $img_path .=substr($filename,0,4).'/';
    $img_path .=substr($filename,4,2).'/';
    $img_path .=substr($filename,6,2).'/';
    $img_path .=$filename;
    //echo $img_path;
    if(!zoom($img_path,350,350)||!zoom($img_path,80,80)||!zoom($img_path,50,50)){
        $path_350=dirname($img_path).'/350_'.basename($img_path);
        $path_80=dirname($img_path).'/80_'.basename($img_path);
        $path_50=dirname($img_path).'/50_'.basename($img_path);
        @unlink($path_350);
        @unlink($path_80);
        @unlink($path_50);
        unlink($img_path);
        echo '缩放失败,请重新上传图片<a href="add.php">返回</a>';
        exit;
    }
//    exit;
    $name=$_POST['name'];
    $cate_id=$_POST['cate_id'];
    $price=$_POST['price'];
    $stock=$_POST['stock'];
    $status=$_POST['status'];
    $is_hot=$_POST['is_hot'];
    $is_new=$_POST['is_new'];
    $is_best=$_POST['is_best'];
    $describe=$_POST['describe'];
    $addtime=time();
    $sql="INSERT INTO ".PRE."goods(name,cate_id,price,stock,`status`,is_hot,is_new,is_best,`describe`,addtime) VALUES('{$name}',{$cate_id},{$price},{$stock},{$status},{$is_hot},{$is_new},{$is_best},'{$describe}','{$addtime}')";
//    echo $sql;
//    exit;
    $result=mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)>0){
        $goods_id=mysqli_insert_id($link);
        $sql="INSERT INTO ".PRE."image(name,goods_id,is_face) VALUES('{$filename}','{$goods_id}','1')";
        $result=mysqli_query($link,$sql);
        if($result && mysqli_affected_rows($link)>0){
            echo '商品添加成功<a href="index.php">返回</a>';exit;
        }else{
            $sql="DELETE FROM ".PRE."goods WHERE id={$goods_id}";
            $result=mysqli_query($link,$sql);
            if($result){
                $path_350=dirname($img_path).'/350_'.basename($img_path);
                $path_80=dirname($img_path).'/80_'.basename($img_path);
                $path_50=dirname($img_path).'/50_'.basename($img_path);
                @unlink($path_350);
                @unlink($path_80);
                @unlink($path_50);
                unlink($img_path);
                echo '添加图片失败,请重新上传图片<a href="add.php">返回</a>';
                exit;
            }
        }
    }else{
                $path_350=dirname($img_path).'/350_'.basename($img_path);
                $path_80=dirname($img_path).'/80_'.basename($img_path);
                $path_50=dirname($img_path).'/50_'.basename($img_path);
                @unlink($path_350);
                @unlink($path_80);
                @unlink($path_50);
                unlink($img_path);
                echo '添加图片失败,请重新上传图片<a href="add.php">返回</a>';
    }
    break;
case 'del':
        $gid=$_GET['gid'];
        $sql="SELECT name FROM ".PRE."image WHERE goods_id={$gid}";
//        echo $sql;exit;
        $result=mysqli_query($link,$sql);
        if($result && mysqli_num_rows($result)>0){
            $img_list=array();
            while($row=mysqli_fetch_assoc($result)){
                $img_list[]=$row;
            }
        }
//       var_dump($img_list);exit;
        foreach($img_list as $val){
            $path =PATH.'uploads/';
            $path .=substr($val['name'],0,4).'/';
            $path .=substr($val['name'],4,2).'/';
            $path .=substr($val['name'],6,2).'/';
            $path_src=$path.$val['name'];
            $path_350=$path.'350_'.$val['name'];
            $path_80=$path.'80_'.$val['name'];
            $path_50=$path.'50_'.$val['name'];
//            echo $path_src;exit;
//            echo $path_350;exit;
            @unlink($path_350);
            @unlink($path_80);
            @unlink($path_50);
            @unlink($path_src);
        }
        $sql="DELETE FROM ".PRE."image WHERE goods_id={$gid}";
//        echo $sql;exit;
        $result=mysqli_query($link,$sql);
        if($result){
            $sql="DELETE FROM ".PRE."goods WHERE id={$gid}";
            $result=mysqli_query($link,$sql);
            if($result){
                header('location:index.php');
            }else{
                header('location:index.php');
            }
        }else{
            header('location:index.php');
        }
        break;
case 'dels':
    $id=$_GET['id'];
    $gid=$_GET['gid'];
    $gname=$_GET['gname'];
    $sql="SELECT name FROM ".PRE."image WHERE id={$id}";
//    echo $sql;exit;
    $result=mysqli_query($link,$sql);
    if($result && mysqli_num_rows($result)>0){
        $val=mysqli_fetch_assoc($result);
//        var_dump($val);exit;
        $path =PATH.'uploads/';
            $path .=substr($val['name'],0,4).'/';
            $path .=substr($val['name'],4,2).'/';
            $path .=substr($val['name'],6,2).'/';
            $path_src=$path.$val['name'];
            $path_350=$path.'350_'.$val['name'];
            $path_80=$path.'80_'.$val['name'];
            $path_50=$path.'50_'.$val['name'];
//            echo $path_src;exit;
//            echo $path_350;exit;
            @unlink($path_350);
            @unlink($path_80);
            @unlink($path_50);
            @unlink($path_src);
            $sql="DELETE FROM ".PRE."image WHERE id={$id}";
            $result=mysqli_query($link,$sql);
            if($result){
                header("location:image.php?gid={$gid}&gname={$gname}");
            }else{
                header("location:image.php?gid={$gid}&gname={$gname}");
            }
    }else{
        header("location:image.php?gid={$gid}&gname={$gname}");
    }
    break;
case 'addimg':
//    var_dump($_POST);
    $gid=$_POST['gid'];
    $gname=$_POST['gname'];
    $filename=upload('pic',PATH.'uploads/');
    if(!$filename){
        echo '请重新上传<a href="image.php?gid='.$gid.'&gname='.$gname.'">返回</a>';exit;
    }
     $img_path = PATH.'uploads/';
     $img_path .=substr($filename,0,4).'/';
     $img_path .=substr($filename,4,2).'/';
     $img_path .=substr($filename,6,2).'/';
     $img_path .=$filename;
     if(
        !zoom($img_path,350,350)||
        !zoom($img_path,80,80)||
        !zoom($img_path,50,50)
     ){
        $path_350 = dirname($img_path).'/350_'.basename($img_path);
        $path_80 = dirname($img_path).'/80_'.basename($img_path);
        $path_50 = dirname($img_path).'/50_'.basename($img_path);
        @unlink($path_350);
        @unlink($path_80);
        @unlink($path_50);
        echo '缩放失败<a href="image.php?gid='.$gid.'&gname='.$gname.'">返回</a>';exit;
     }
     $sql="INSERT INTO ".PRE."image(name,goods_id,is_face) VALUES('{$filename}','{$gid}',0)";
        $result =mysqli_query($link,$sql);
        if($result && mysqli_affected_rows($link)>0){
        echo '添加图片成功<a href="image.php?gid='.$gid.'&gname='.$gname.'">返回</a>';exit;
        }else{
        $path_350 = dirname($img_path).'/350_'.basename($img_path);
        $path_80 = dirname($img_path).'/80_'.basename($img_path);
        $path_50 = dirname($img_path).'/50_'.basename($img_path);
        @unlink($path_350);
        @unlink($path_80);
        @unlink($path_50);
        echo '添加失败<a href="image.php?gid='.$gid.'&gname='.$gname.'">返回</a>';exit;
        }
        break;
case 'is_face':
//    var_dump($_GET);exit;
    $iid=$_GET['iid'];
    $gid=$_GET['gid'];
    $sql="UPDATE ".PRE."image SET is_face=0 WHERE goods_id={$gid}";
//    echo $sql;exit;
    $result=mysqli_query($link,$sql);
    if($result && mysqli_affected_rows($link)>0){
        $sql="UPDATE ".PRE."image SET is_face=1 WHERE id={$iid}";
        echo $sql;
        $result=mysqli_query($link,$sql);
        if($result && mysqli_affected_rows($link)>0){
            header("location:image.php?gid=$gid");
        }else{
      //      header("location:image.php?gid=$gid");
        }
    }else{
      //  header("location:image.php?gid=$gid");
    }
    break;
case 'status':
    $gid=$_GET['gid'];
    $type=$_GET['type'];
//    echo $gid;echo $type;exit;
    $sql="UPDATE ".PRE."goods SET status={$type} WHERE id={$gid}";
    $result=mysqli_query($link,$sql);
    if($result){
        header('location:index.php');
    }else{
        header('location:index.php');
    }
    break;
case 'is_hot':
    $gid=$_GET['gid'];
    $type=$_GET['type'];
//    echo $gid;echo $type;exit;
    $sql="UPDATE ".PRE."goods SET is_hot={$type} WHERE id={$gid}";
    $result=mysqli_query($link,$sql);
    if($result){
        header('location:index.php');
    }else{
        header('location:index.php');
    }
    break;
case 'is_best':
    $gid=$_GET['gid'];
    $type=$_GET['type'];
//    echo $gid;echo $type;exit;
    $sql="UPDATE ".PRE."goods SET is_best={$type} WHERE id={$gid}";
    $result=mysqli_query($link,$sql);
    if($result){
        header('location:index.php');
    }else{
        header('location:index.php');
    }
    break;
case 'is_new':
    $gid=$_GET['gid'];
    $type=$_GET['type'];
//    echo $gid;echo $type;exit;
    $sql="UPDATE ".PRE."goods SET is_new={$type} WHERE id={$gid}";
    $result=mysqli_query($link,$sql);
    if($result){
        header('location:index.php');
    }else{
        header('location:index.php');
    }
    break;
case 'edit':
    $id=$_GET['id'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $stock=$_POST['stock'];
    $describe=$_POST['describe'];
    $sql="UPDATE ".PRE."goods SET name='{$name}',price={$price},stock={$stock},`describe`={$describe} WHERE id={$id}";
//    echo $sql;exit;
    $result=mysqli_query($link,$sql);
    if($result){
        echo '修改成功<a href="index.php">返回</a>';
    }else{
        echo '修改失败<a href="index.php">返回</a>';
    }
    break;
case 'delete':
    echo 'sss';
    var_dump($_GET);
    $wid=$_GET['wid'];
    $gid=$_GET['gid'];
    $sql="DELETE FROM ".PRE."goods_comment WHERE id={$wid}";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_affected_rows($link)>0){
        header("location:comment.php?gid={$gid}");
    }
    break;
}





















