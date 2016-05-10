<?php
include 'header.php';
?>
<?php
//var_dump($_SESSION);
$id=$_SESSION['home']['id'];
//echo $id;
$sql="SELECT id,name,password,sex FROM ".PRE."user WHERE id={$id}";
$result=mysqli_query($link,$sql);
if($result && mysqli_num_rows($result)>0){
    $rows=mysqli_fetch_assoc($result);
}
?>
<div style="width:230px;height:300px;margin:0 auto;font-size:20px;">
<form action="dopersonal.php" method="post" enctype="multipart/form-data">
<?php
$sql="SELECT name FROM ".PRE."user_image WHERE user_id={$id}";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
}
$name=$row['name'];
$img_url=URL.'uploads/';
$img_url .=substr($name,0,4).'/';
$img_url .= substr($name,4,2).'/';
$img_url .= substr($name,6,2).'/';
$img_url .='80_'.$name;
//echo $img_url;
?>
    <img src="<?php echo $img_url?>" value="头像">
<p><input type="file" name="pic"></p>
<p>姓 名 : <?php echo $_SESSION['home']['name']?></p>
<p>积 分 : 
<?php 
$sql="SELECT points FROM ".PRE."user WHERE id={$_SESSION['home']['id']}";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $sss=mysqli_fetch_assoc($result);
}
echo $sss['points'];
?>
</p>
    <p>原密码:<input type="password" name="password"></p>
    <p>新密码:<input type="password" name="newpassword"></p>
    <p>性　别:<input type="radio" name="sex" value="0" <?php echo $rows['sex']==0?'checked':''; ?>>女
    <input type="radio" name="sex" value="1" <?php echo $rows['sex']==1?'checked':''; ?>>男
    <input type="radio" name="sex" value="2" <?php echo $rows['sex']==2?'checked':''; ?>>保密</p>
    <p><input type="submit" value="修改"></p>

</form>
</div>
<table border="1" width="1200px" style="margin:0 auto">
    <tr><th>编号</th><th>商品</th><th>订单编号</th><th>收货人</th><th>地址</th><th>email</th><th>电话</th><th>邮编</th><th>总价</th><th>订单状态</th></tr>
<?php 
$id=$_SESSION['home']['id'];
$sql="SELECT * FROM ".PRE."order WHERE user_id={$id}";
//echo $sql;
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $orderlist=array();
    while($row=mysqli_fetch_assoc($result)){
        $orderlist[]=$row;
    }
}
//var_dump($orderlist);
foreach($orderlist as $key=>$val){
?>
    <tr>

    <th><?php echo $key+1?></th><th>
<?php
    $sql="SELECT name,goods_id,qty FROM ".PRE."order_goods WHERE order_id={$val['order_num']}";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)>0){
        $goodslist=array();
        while($rows=mysqli_fetch_assoc($result)){
            $goodslist[]=$rows;
        }
    }
//    var_dump($goodslist);
    foreach($goodslist as $vals){
        $sql="SELECT name FROM ".PRE."image WHERE goods_id={$vals['goods_id']} AND is_face=1";
        $result=mysqli_query($link,$sql);
        if($result&&mysqli_num_rows($result)){
            $image=mysqli_fetch_assoc($result);
        }
        $imagename=$image['name'];
        $image_url=URL.'uploads/';
        $image_url .=substr($imagename,0,4).'/';
        $image_url .=substr($imagename,4,2).'/';
        $image_url .=substr($imagename,6,2).'/';
        $image_url .='50_'.$imagename;
?>
    <img src="<?php echo $image_url?>"><br/>
<?php
        //        var_dump($orderlist);
//        echo $val['status'];
        echo $vals['name'].'&nbsp;x&nbsp;'.$vals['qty'];echo $val['status']>3?'<a href="comment.php?id='.$vals['goods_id'].'">&nbsp;&nbsp;&nbsp;评论</a><br/>':'<br/>';
    }
?>
</th><th><?php echo $val['order_num']?></th><th><?php echo $val['receiver']?></th><th><?php echo $val['address']?></th><th><?php echo $val['email']?></th><th><?php echo $val['tel']?></th><th><?php echo $val['zip']?></th><th><?php echo $val['price_total']?></th><th>
<?php
    switch($val['status']){
    case '1':
        echo '<a href="action.php?p=2&oid='.$val['id'].'">付款</a>';
        break;
    case '2':
        echo '已付款未发货';
        break;
    case '3':
        echo '<a href="action.php?p=4&oid='.$val['id'].'">收货</a>';
        break;
    case '4':
        echo '已收货';
        break;
    case '5':
        echo '评论';
        break;
    }
?>

</tr>
<?php } ?>
</table>
<?php 
include 'footer.php';
?>
