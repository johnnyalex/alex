<?php
include 'header.php';
//var_dump($_SESSION);
?>
<div style="width:300px;height:400px;margin:0 auto;">
<form action="dosettle.php" method="post">
<?php 
    foreach($_SESSION['cart'] as $key=>$val){
            $img_url=URL.'uploads/';
            $img_url .=substr($val['iname'],0,4).'/';
            $img_url .=substr($val['iname'],4,2).'/';
            $img_url .=substr($val['iname'],6,2).'/';
            $img_url .='80_'.$val['iname'];
?>
<div style="float:left;margin:10px 10px;">
    <img src="<?php echo $img_url?>">            
    <p><?php echo $val['gname']?> </p>
    <p>&yen;<?php echo $val['price']?> </p>
    <p>数量: <?php echo $val['qty']?> </p>
</div>

<?php } ?>
<div style="clear:both"></div>

<?php
            $total=$_SESSION['home']['total'];
?>
    <p>总 价 : <?php echo $total?></p>
    <p>收货人: <input type="text" name="receiver"></p>
    <p>地 址 : <input type="text" name="address"></p>
    <p>email : <input type="text" name="email"></p>
    <p>电 话 : <input type="text" name="tel"></p>
    <p>邮 编 : <input type="text" name="zip"></p>
    <p>&nbsp;<input type="submit" value="提交订单"></p>
</form>
</div>






<?php 
// 订单标号 收货人 地址 email 电话 邮编 用户id 订单总价 订单状态
?>
