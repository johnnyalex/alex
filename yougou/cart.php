<?php 
include 'header.php';

//var_dump($_SESSION);
?>
<div style="width:980px;height:auto;background:pink;margin:10px auto;padding:20px 0;">
        <?php if(!empty($_SESSION['home']['id'])){ ?>
    <table border="1" width="800" style="border:2px white solid;width:800px;margin:0 auto;">

        <tr>
            <th>商品</th>
            <th>图片</th>
            <th>价格</th>
            <th>数量</th>
            <th>操作</th>
        </tr>

        <?php if(!empty($_SESSION['cart'])){
            $num=0;
            $total=0;
        ?>
        <?php foreach($_SESSION['cart'] as $key=>$val){?>
        <tr>
        <td><?php echo $val['gname']?></td>
            <?php
            $img_url=URL.'uploads/';
            $img_url .=substr($val['iname'],0,4).'/';
            $img_url .=substr($val['iname'],4,2).'/';
            $img_url .=substr($val['iname'],6,2).'/';
            $img_url .='50_'.$val['iname']
            ?>
            <td><img src="<?php echo $img_url?>"></td>
            <td>&yen;<?php echo $val['price']?></td>
            <td>
            <a href="docart.php?a=jian&gid=<?php echo $key?>">[-]</a>
            <?php echo $val['qty']?>

            <a href="docart.php?a=jia&gid=<?php echo $key?>">[+]</a>
            </td><td>
            <a href="docart.php?a=del&gid=<?php echo $key?>">删除</a>
            </td>
        </tr>
<?php    
                $num +=$val['qty'];
            $total +=$val['qty']*$val['price'];
?>
<?php } ?>
        </tr>
        <tr>
            <td colspan="5">
                <a href="docart.php?a=delete">清空购物车&nbsp;&nbsp;&nbsp;</a>
                <a>共 <?php echo $num?> 件商品&nbsp;&nbsp;&nbsp;</a>

<?php
            $sql="SELECT points FROM ".PRE."user WHERE id={$_SESSION['home']['id']}";
            $result=mysqli_query($link,$sql);
            if($result&&mysqli_num_rows($result)>0){
                $rcc=mysqli_fetch_assoc($result);
            }
            $yoh=$rcc['points'];

            $total -=$yoh;
            $sql="UPDATE ".PRE."user SET points=0 WHERE id={$_SESSION['home']['id']}";
            $result=mysqli_query($link,$sql);

?>
                <a>总价 RMB:<?php echo $total?>&nbsp;&nbsp;&nbsp;</a>
                已优惠 <?php echo $yoh;?> 元
   &nbsp;&nbsp;&nbsp;
                <?php 
    $_SESSION['home']['total']="$total";
?>
                <a href="settle.php">去结算</a>
            </td>
        </tr>
<?php }else{ ?>
        <td colspan="5">这家伙很懒，什么都没留下...<a href="index.php">去购物</a></td>
        <?php }
        }else{ echo '请登录   <a href="login.php">登录</a>';}

?>
    </table>
</div>



<?php
include 'footer.php';
?>
