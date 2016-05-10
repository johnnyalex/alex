<?php
include './init.php';
//var_dump($_SESSION);
$sql="SELECT id,name FROM ".PRE."category WHERE display='0' and pid=0 limit 8 ";
$result = mysqli_query($link,$sql);
if($result && mysqli_num_rows($result)>0){
    $cate_list = array();
    while($row = mysqli_fetch_assoc($result)){
        $cate_list[]=$row;
    }
}
//var_dump($cate_list);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>优购时尚商城-时尚服饰鞋包网购首选-优生活，购时尚！</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>
    <!-- shishangshangcheng -->
    <div id="header" class="w border_sssc h1">
        <div class="sssc fl center"><a class="sssc_w" href="index.html">时尚商城</a></div>
        <div class="sez h1 fl center"><a class="sez_w" href=""><b>首尔站</b></a></div>
        <div class="sjyg fl center border_sssc"><a href="">
            <div class="sjyg_sj fl"></div>
            <div class="sjyg_wr fl">手机优购</div>
            <div class="sjyg_jt fl"></div></a>
        <div class="clear"></div>
        </div>
        <div class="fl_gd h2 fr center"><a href="">
            <div class="fl_gd_w h2 fl">更多</div>
            <div class="sjyg_jt fl"></div></a>
            <div class="clear"></div>
        </div>
        <div class="fl_gg h2 fr center"><a href="">
            <div class="fl_gg_w h2 fl">公告</div>
            <div class="sjyg_jt fl"></div></a>
            <div class="clear"></div>
        </div>
        <div class="fl_wddd h2 fr center"><a href="">
                我的订单
        </a></div>
        <div class="fl_wdyg h2 fr center"><a href="">
                <div class="fl_wdyg_w h2 fl">我的优购</div>
                <div class="sjyg_jt fl"></div></a>
                <div class="clear"></div>
        </div>
        <div class="fl_shu h2 fr center">|</div>
        <!-- zhuce  denglu -->
        <div class="zhuce h2 fr">
        <?php if(empty($_SESSION['home']['name'])){ ?>
        <a class="fl_zc" href="register.php">注册</a>
        <?php }else{ ?>
        <a class="fl_zc" href="login.php">退出</a><?php } ?>        
        </div>
        <div class="denglu h2 fr">
        <?php if(empty($_SESSION['home']['name'])){ ?>
        <a class="fl_dengl" href="login.php">登录</a>
        <?php }else{ ?>
        <a href="personal.php"><span class="fl_hygl">个人中心</span></a><?php } ?>
        </div>
        <div class="clear"></div>
    </div>
    <div id="second" class="w1">
        <div class="fl"><a href="">
                <div class="sec_logl"></div>
        </a></div>
    <div class="search fl">
        <form action="" method="get">
            <input type="text" class="ssk"><input type="submit" class="tjan"value=".">
        </form>
    </div>
    <div class="fl_gwc fr">
        <div class="fl_gwc_gwc fl"></div>
        <a href="cart.php"><div class="fl_gwc_w fl">购物车(<a class="red" href="cart.php"><?php echo count($_SESSION['cart']) ?></a>)件</div></a>
        <div class="fl_gwc_jt fl"></div>
    </div>
    <div class="fl_ss_dh fl">
        <ul class="fl_ss_dh_w">

<?php
$sql="SELECT id,name FROM ".PRE."category WHERE path LIKE '0,%' AND pid!=0 AND display=0 ORDER BY id DESC LIMIT 8"; 
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $goodlist=array();
    while($row=mysqli_fetch_assoc($result)){
        $goodlist[]=$row;
    }
}
foreach($goodlist as $val){
    echo '<li><a class="header_dh" href="">'.$val['name'].'</a></li>';
}
?>

        </ul>
        <div class="clear"></div>
    </div>
    <div class="fl_xgss fl">
香港上市公司百丽国际旗下购物网站
    </div>
    <div class="clear"></div>
</div>
<div id="spfl" class="w">
    <div class="qsfl fl">
        <a class="qsfl_w" href="index.php"><b>全部商品分类</b></a>
    </div>
    <div class="qsfl_dh fl">
        <ul>
            <b>
        <?php foreach($cate_list as $val){ ?>
            <li><a href="catelist.php?cid=<?php echo $val['id']?>">&nbsp;<?php echo $val['name']?></a></li>
        <?php } ?>
            </b>
    </ul>
         <div class="clear"></div>
     </div>
     <div class="qsfl_ms fl">
         <ul>
             <b>
<?php
$sql="SELECT id,name FROM ".PRE."category WHERE display='0' and pid=0 limit 8,3 ";
$result = mysqli_query($link,$sql);
if($result && mysqli_num_rows($result)>0){
    $cate_list = array();
    while($row = mysqli_fetch_assoc($result)){
        $cate_list[]=$row;
    }
}
//var_dump($cate_list);
?>
<?php foreach($cate_list as $val){ ?>
                 <li><a href="catelist.php?cid=<?php echo $val['id']?>">&nbsp;<?php echo $val['name']?></a></li>
<?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</body>
</html>
