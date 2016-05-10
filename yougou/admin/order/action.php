<?php 
include '../init.php';
//var_dump($_POST);
//var_dump($_GET);
$a=$_GET['a'];
//shoujianren  dizhi  email dianhua youbin  zongjia dingdanzhuangtai
switch($a){
case 'edit':
    $order_num=$_POST['order_num'];
    $receiver=$_POST['receiver'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $tel=$_POST['tel'];
    $zip=$_POST['zip'];
    $price_total=$_POST['price_total'];
    $status=$_POST['status'];
    $sql="UPDATE ".PRE."order SET receiver='{$receiver}',address='{$address}',email='{$email}',tel='{$tel}',zip='{$zip}',price_total={$price_total},status={$status} WHERE order_num={$order_num}";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_affected_rows($link)>0){
        echo '修改成功<a href="index.php">返回</a>';
    }else{
        echo '订单未修改<a href="index.php">返回</a>';
    }
    if($status==4){
        $sql="SELECT goods_id,qty FROM ".PRE."order_goods WHERE order_id={$order_num}";
  //         echo $sql;
        $result=mysqli_query($link,$sql);
        if($result&&mysqli_num_rows($result)>0){
            $goodlist=array();
            while($row=mysqli_fetch_assoc($result)){
                $goodlist[]=$row;
            }
        }
//        var_dump($goodlist);
        foreach($goodlist as $val){
            $goods_id=$val['goods_id'];
            $qty=$val['qty'];
            $sql="SELECT stock FROM ".PRE."goods WHERE id={$goods_id}";
            //echo $sql;
            $result=mysqli_query($link,$sql);
            if($result&&mysqli_num_rows($result)>0){
                $rows=mysqli_fetch_assoc($result);
                $stock=$rows['stock'];
                $stock=$stock-$qty;
                $sql="UPDATE ".PRE."goods SET stock={$stock} WHERE id={$goods_id}";
                $result=mysqli_query($link,$sql);
            }
        }
    }
//    echo $price_total;
    if($status==4){
//        echo 'sss';
        $points=$price_total/100;
//        echo $points;
        $user_id=$_POST['user_id'];
        //        var_dump($_POST);
        $sql="SELECT points FROM ".PRE."user WHERE id={$user_id}";
//        echo $sql;
        $result=mysqli_query($link,$sql);
        if($result&&mysqli_num_rows($result)>0){
            $roo=mysqli_fetch_assoc($result);
        }
        $opoints=$roo['points'];
        $points+=$opoints;
        $sql="UPDATE ".PRE."user SET points={$points} WHERE id={$user_id}";
//        echo $sql;
        $result=mysqli_query($link,$sql);
    }
    break;
}

$p=$_GET['p'];
$oid=$_GET['oid'];
switch($p){
case '3':
    $sql="UPDATE ".PRE."order SET status={$p} WHERE id={$oid}";
    $result=mysqli_query($link,$sql);
    if($result){
        header('location:index.php');
    }
    break;
}
