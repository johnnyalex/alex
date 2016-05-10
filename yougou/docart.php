<?php
include 'init.php';
var_dump($_POST);
$a=$_GET['a'];
switch($a){
case 'add':
    $gid=$_POST['id'];
    $qty=$_POST['num'];
    if($qty<1){
        $qty=1;
    }
    if(!empty($_SESSION['cart'][$gid])){
        $_SESSION['cart'][$gid]['qty']+=$qty;
        $sql="SELECT stock FROM ".PRE."goods WHERE id={$gid}";
        $result=mysqli_query($link,$sql);
        if($result&&mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
        }
        $stock=$row['stock'];
        if($_SESSION['cart'][$gid]['qty']>$stock){
            $_SESSION['cart'][$gid]['qty']=$stock;
        }
        header('location:cart.php');
        exit;
    }
    $sql="SELECT g.name gname,g.price,i.name iname  FROM ".PRE."goods g,".PRE."image i WHERE g.id=i.goods_id AND i.is_face =1 AND g.id={$gid}";
    $result =mysqli_query($link,$sql);
    if($result && mysqli_num_rows($result)>0){
        $goods = mysqli_fetch_assoc($result);
    }
    $goods['qty']=$qty;
    $_SESSION['cart'][$gid]=$goods;
    header('location:cart.php');
    break;
case 'jian':
    $gid=$_GET['gid'];
    $_SESSION['cart'][$gid]['qty']-=1;
    if($_SESSION['cart'][$gid]['qty']<1){
        $_SESSION['cart'][$gid]['qty']=1;
    }
    header('location:cart.php');
    break;
case 'jia':
    $gid=$_GET['gid'];
    $sql="SELECT stock FROM ".PRE."goods WHERE id={$gid}";
    //echo $sql;exit;
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)>0){
        $num=mysqli_fetch_assoc($result);
    }
    //echo $num['stock'];exit;
    $_SESSION['cart'][$gid]['qty']+=1;
//    echo $_SESSION['cart'][$gid]['qty'];exit;
    if($_SESSION['cart'][$gid]['qty']>$num['stock']){
        $_SESSION['cart'][$gid]['qty']=$num['stock'];
    }
    header('location:cart.php');
    break;
//    var_dump($_SESSION);
    exit;
case 'del':
    $gid=$_GET['gid'];
    unset($_SESSION['cart'][$gid]);
    header('location:cart.php');
    break;
case 'delete':
    unset($_SESSION['cart']);
    header('location:cart.php');
    break;
}
