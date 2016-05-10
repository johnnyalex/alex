<?php
include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>优购时尚商城-时尚服饰鞋包网购首选-优生活，购时尚！</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>

<div id="dtdh">
    <div class="dtdh_dh fl border_sssc">
        <div class="dtdh_left_t fl">
<?php for($i=0;$i<9;$i++){ ?>
            <div class="dtdh_left_t<?php echo $i?>"></div>
<?php } ?>
        </div>


<ul>
<?php
$sql="SELECT id,name FROM ".PRE."category WHERE display='0' AND pid=0 LIMIT 9";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $goodlist=array();
    while($row=mysqli_fetch_assoc($result)){
        $goodlist[]=$row;
    }
}
//var_dump($goodlist);
if(!empty($goodlist)){
foreach($goodlist as $val){
//    var_dump($val);
    $sql="SELECT name FROM ".PRE."category WHERE display='0' AND pid=".$val['id']."";
//    echo $sql;
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)){
        $goodlists=array();
        while($row=mysqli_fetch_assoc($result)){
            $goodlists[]=$row;
        }  
    }
echo '<li><div class="dt_zd_s"><b><a class="dt_zd_b" href="">'.$val['name'].'</a></b><br/>';
    foreach($goodlists as $value){
        echo '<a class="dt_zd_d" href="catelist.php?cid='.$val['id'].'">'.$value['name'].' </a>';
    } 
    echo '</div></li>';
//            var_dump($goodlists);
}}
?>
</ul>



        <div class="clear"></div>
    </div>
<div class="dtdh_dt_tp fl"><img src="./image/datu.jpg"></div>
    <div class="clear"></div>
</div>

<!-- remen pinpai -->
<?php $name='热门品牌';$type='is_hot' ?>
<div id="rmpp" class="w1">
    <div class="rmpp fl"><?php echo $name?></div>
    <div class="rm_more fr"><a href="">more ></a></div>
</div>
<div class="rmpp_tp w1 border_sssc">
    <ul class="rmpp_tp_z">


<?php


$sql="SELECT id FROM ".PRE."category WHERE name='{$name}' AND display=0 AND pid=0";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $cid=$row['id'];
}
$sql="SELECT id FROM ".PRE."goods WHERE cate_id={$cid} AND {$type}=1 LIMIT 4";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $glist=array();
    while($row=mysqli_fetch_assoc($result)){
        $glist[]=$row;
    }
}
if(!empty($glist)){
foreach($glist as $val){
    $gid=$val['id'];
    $sql="SELECT name FROM ".PRE."image WHERE goods_id={$gid} AND is_face=1 LIMIT 1";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)>0){
        $ilist=array();
        while($row=mysqli_fetch_assoc($result)){
            $ilist[]=$row;
        }
//        var_dump($ilist);
        foreach($ilist as $value){
            $iname=$value['name'];
            $img_url=URL.'uploads'.'/';
            $img_url .=substr($iname,0,4).'/';
            $img_url .=substr($iname,4,2).'/';
            $img_url .=substr($iname,6,2).'/';
            $img_url .=$iname;
?>
<li><a href="detail.php?gid=<?php echo $gid?>"><img src="<?php echo $img_url?>"></a></li>
<?php        }
    }
}}
?>

    </ul>
    <div class="clear"></div>
    <div class="rmpp_pp w1">
        <div class="rmpp_jt fl"></div>
        <div class="rmpp_pinp fl">
            <ul>
            <li><a href=""><img src="./image/5.jpg"></a></li>
            <li><a href=""><img src="./image/6.jpg"></a></li>
            <li><a href=""><img src="./image/7.jpg"></a></li>
            <li><a href=""><img src="./image/8.jpg"></a></li>
            <li><a href=""><img src="./image/9.jpg"></a></li>
            <li><a href=""><img src="./image/10.jpg"></a></li>
            <li><a href=""><img src="./image/11.jpg"></a></li>
            <li><a href=""><img src="./image/12.jpg"></a></li>
            <li><a href=""><img src="./image/13.jpg"></a></li>
            <li><a href=""><img src="./image/14.jpg"></a></li>
            <li><a href=""><img src="./image/15.jpg"></a></li>
            <li><a href=""><img src="./image/16.jpg"></a></li>
            <li><a href=""><img src="./image/17.jpg"></a></li>
            <li><a href=""><img src="./image/18.jpg"></a></li>
            <li><a href=""><img src="./image/19.jpg"></a></li>
            <li><a href=""><img src="./image/20.jpg"></a></li>
            <li><a href=""><img src="./image/21.jpg"></a></li>
            <li><a href=""><img src="./image/22.jpg"></a></li>
            <li><a href=""><img src="./image/23.jpg"></a></li>
            <li><a href=""><img src="./image/24.jpg"></a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="rmpp_jtr fl"></div>
        <div class="clear"></div>
    </div>
</div>
<?php $name='新品';$type='is_new' ?>
<div id="rmpp" class="w1">
    <div class="rmpp fl"><?php echo $name?></div>
    <div class="rm_more fr"><a href="">more ></a></div>
</div>
<div class="rmpp_tp w1 border_sssc">
    <ul class="rmpp_tp_z">


<?php


$sql="SELECT id FROM ".PRE."category WHERE name='{$name}' AND display=0 AND pid=0";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $cid=$row['id'];
}
$sql="SELECT id FROM ".PRE."goods WHERE cate_id={$cid} AND {$type}=1 LIMIT 4";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $glist=array();
    while($row=mysqli_fetch_assoc($result)){
        $glist[]=$row;
    }
}
if(!empty($glist)){
foreach($glist as $val){
    $gid=$val['id'];
    $sql="SELECT name FROM ".PRE."image WHERE goods_id={$gid}  AND is_face=1 LIMIT 1";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)>0){
        $ilist=array();
        while($row=mysqli_fetch_assoc($result)){
            $ilist[]=$row;
        }
//        var_dump($ilist);
        foreach($ilist as $value){
            $iname=$value['name'];
            $img_url=URL.'uploads'.'/';
            $img_url .=substr($iname,0,4).'/';
            $img_url .=substr($iname,4,2).'/';
            $img_url .=substr($iname,6,2).'/';
            $img_url .=$iname;
?>
<li><a href="detail.php?gid=<?php echo $gid?>"><img src="<?php echo $img_url?>"></a></li>
<?php        }
    }
}}
?>

    </ul>
    <div class="clear"></div>
    <div class="rmpp_pp w1">
        <div class="rmpp_jt fl"></div>
        <div class="rmpp_pinp fl">
            <ul>
            <li><a href=""><img src="./image/5.jpg"></a></li>
            <li><a href=""><img src="./image/6.jpg"></a></li>
            <li><a href=""><img src="./image/7.jpg"></a></li>
            <li><a href=""><img src="./image/8.jpg"></a></li>
            <li><a href=""><img src="./image/9.jpg"></a></li>
            <li><a href=""><img src="./image/10.jpg"></a></li>
            <li><a href=""><img src="./image/11.jpg"></a></li>
            <li><a href=""><img src="./image/12.jpg"></a></li>
            <li><a href=""><img src="./image/13.jpg"></a></li>
            <li><a href=""><img src="./image/14.jpg"></a></li>
            <li><a href=""><img src="./image/15.jpg"></a></li>
            <li><a href=""><img src="./image/16.jpg"></a></li>
            <li><a href=""><img src="./image/17.jpg"></a></li>
            <li><a href=""><img src="./image/18.jpg"></a></li>
            <li><a href=""><img src="./image/19.jpg"></a></li>
            <li><a href=""><img src="./image/20.jpg"></a></li>
            <li><a href=""><img src="./image/21.jpg"></a></li>
            <li><a href=""><img src="./image/22.jpg"></a></li>
            <li><a href=""><img src="./image/23.jpg"></a></li>
            <li><a href=""><img src="./image/24.jpg"></a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="rmpp_jtr fl"></div>
        <div class="clear"></div>
    </div>
</div>
<?php $name='精品';$type='is_best' ?>
<div id="rmpp" class="w1">
    <div class="rmpp fl"><?php echo $name?></div>
    <div class="rm_more fr"><a href="">more ></a></div>
</div>
<div class="rmpp_tp w1 border_sssc">
    <ul class="rmpp_tp_z">


<?php


$sql="SELECT id FROM ".PRE."category WHERE name='{$name}' AND display=0 AND pid=0";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $cid=$row['id'];
}
$sql="SELECT id FROM ".PRE."goods WHERE cate_id={$cid} AND {$type}=1 LIMIT 4";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $glist=array();
    while($row=mysqli_fetch_assoc($result)){
        $glist[]=$row;
    }
}
if(!empty($glist)){
foreach($glist as $val){
    $gid=$val['id'];
    $sql="SELECT name FROM ".PRE."image WHERE goods_id={$gid}  AND is_face=1 LIMIT 1";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)>0){
        $ilist=array();
        while($row=mysqli_fetch_assoc($result)){
            $ilist[]=$row;
        }
//        var_dump($ilist);
        foreach($ilist as $value){
            $iname=$value['name'];
            $img_url=URL.'uploads'.'/';
            $img_url .=substr($iname,0,4).'/';
            $img_url .=substr($iname,4,2).'/';
            $img_url .=substr($iname,6,2).'/';
            $img_url .=$iname;
?>
<li><a href="detail.php?gid=<?php echo $gid?>"><img src="<?php echo $img_url?>"></a></li>
<?php        }
    }
}}
?>

    </ul>
    <div class="clear"></div>
    <div class="rmpp_pp w1">
        <div class="rmpp_jt fl"></div>
        <div class="rmpp_pinp fl">
            <ul>
            <li><a href=""><img src="./image/5.jpg"></a></li>
            <li><a href=""><img src="./image/6.jpg"></a></li>
            <li><a href=""><img src="./image/7.jpg"></a></li>
            <li><a href=""><img src="./image/8.jpg"></a></li>
            <li><a href=""><img src="./image/9.jpg"></a></li>
            <li><a href=""><img src="./image/10.jpg"></a></li>
            <li><a href=""><img src="./image/11.jpg"></a></li>
            <li><a href=""><img src="./image/12.jpg"></a></li>
            <li><a href=""><img src="./image/13.jpg"></a></li>
            <li><a href=""><img src="./image/14.jpg"></a></li>
            <li><a href=""><img src="./image/15.jpg"></a></li>
            <li><a href=""><img src="./image/16.jpg"></a></li>
            <li><a href=""><img src="./image/17.jpg"></a></li>
            <li><a href=""><img src="./image/18.jpg"></a></li>
            <li><a href=""><img src="./image/19.jpg"></a></li>
            <li><a href=""><img src="./image/20.jpg"></a></li>
            <li><a href=""><img src="./image/21.jpg"></a></li>
            <li><a href=""><img src="./image/22.jpg"></a></li>
            <li><a href=""><img src="./image/23.jpg"></a></li>
            <li><a href=""><img src="./image/24.jpg"></a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="rmpp_jtr fl"></div>
        <div class="clear"></div>
    </div>
</div>
<!-- yundongguan -->
<div class="ydg w1">
        <div class="ydg_bt_l fl"><b><a href="">运动馆</a></b></div>
        <div class="ydg_bt_r fr">MORE >></div>
        <div class="clear"></div>
    </div>
</div>
<div id="ydg" class="w1 border_sssc">
    <div class="ydg_l fl">
        <div class="ydg_l_w">
            <a class="ydg_l_w_l" href=""><b>运动鞋</b></a>
            |
            <a class="ydg_l_w_r" href=""><b>运动服</b></a>
        </div>
        <div class="ydg_l_tp">
            <ul>
            <li><a href=""><img src="./image/5.jpg"></a></li>
            <li><a href=""><img src="./image/6.jpg"></a></li>
            <li><a href=""><img src="./image/7.jpg"></a></li>
            <li><a href=""><img src="./image/8.jpg"></a></li>
            <li><a href=""><img src="./image/9.jpg"></a></li>
            <li><a href=""><img src="./image/10.jpg"></a></li>
            <li><a href=""><img src="./image/11.jpg"></a></li>
            <li><a href=""><img src="./image/12.jpg"></a></li>
            <li><a href=""><img src="./image/13.jpg"></a></li>
            <li><a href=""><img src="./image/14.jpg"></a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <div class="ydg_c fl"><a href=""><img src="./image/05.jpg"></a></div>
    <div class="ydg_r fl">
        <ul>
            <li><a href=""><img src="./image/25.jpg"></a></li>
            <li><a href=""><img src="./image/26.jpg"></a></li>
            <li><a href=""><img src="./image/27.jpg"></a></li>
            <li><a href=""><img src="./image/28.jpg"></a></li>
            <li><a href=""><img src="./image/29.jpg"></a></li>
            <li><a href=""><img src="./image/30.jpg"></a></li>
        </ul>
    </div>
    <div class="clear"></div>
</div>



<!-- temai zhuanqu -->
<div class="tmzq w1">
        <div class="tmzq_bt">特卖专区</div>
</div>
<div id="tmzq" class="w1 border_sssc">
    <div class="tmzq_l fl">
        <ul>

<?php
$sql="SELECT id,name FROM ".PRE."category WHERE pid=0 AND display=0 LIMIT 9"; 
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $goodlist=array();
    while($row=mysqli_fetch_assoc($result)){
        $goodlist[]=$row;
    }
}
foreach($goodlist as $val){
    echo '<li><a href="">'.$val['name'].' </a></li>';
}
?>

        </ul>
    </div>
    <div class="tmzq_r fl">
            <a href=""><img src="./image/39.jpg"></a>
    </div>
</div>
<div class="ygdg w1">
    <div class="tmzq_bt"><b>优购导购</b></div>
</div>
<div id="ygdg" class="w1 border_sssc">
    <a href=""><div class="ygdg_jt_l fl"></div></a>
    <div class="ygdg_sb fl border_sssc">
        <ul>
            <li><a href=""><img src="./image/40.jpg"></a><br/><a class="white1" href="">耐克</a></li>
            <li><a href=""><img src="./image/41.jpg"></a><br/><a class="white1" href="">阿迪达斯</a></li>
            <li><a href=""><img src="./image/42.jpg"></a><br/><a class="white1"  href="">阿迪三叶草</a></li>
            <li><a href=""><img src="./image/43.jpg"></a><br/><a class="white1" href="">New Balance</a></li>
            <li><a href=""><img src="./image/44.jpg"></a><br/><a class="white1" href="">百丽</a></li>
            <li><a href=""><img src="./image/45.jpg"></a><br/><a class="white1"  href="">他她</a></li>
            <li><a href=""><img src="./image/46.jpg"></a><br/><a class="white1" href="">天美意</a></li>
            <li><a href=""><img src="./image/47.jpg"></a><br/><a class="white1"  href="">森达</a></li>
            <li><a href=""><img src="./image/48.jpg"></a><br/><a class="white1"  href="">莱尔斯丹</a></li>
            <li><a href=""><img src="./image/49.jpg"></a><br/><a class="white1"  href="">棉花共和国</a></li>
            <li><a href=""><img src="./image/50.jpg"></a><br/><a class="white1"  href="">彪马</a></li>
            <li><a href=""><img src="./image/51.jpg"></a><br/><a class="white1"  href="">水星家纺</a></li>
            <li><a href=""><img src="./image/52.jpg"></a><br/><a class="white1"  href="">匡威</a></li>
            <li><a href=""><img src="./image/53.jpg"></a><br/><a  class="white1" href="">斯凯奇</a></li>
            <li><a href=""><img src="./image/54.jpg"></a><br/><a class="white1"  href="">百思图</a></li>
            <li><a href=""><img src="./image/55.jpg"></a><br/><a class="white1"  href="">马克华菲</a></li>
            <li><a href=""><img src="./image/56.jpg"></a><br/><a class="white1"  href="">虎牌</a></li>
            <li><a href=""><img src="./image/57.jpg"></a><br/><a class="white1"  href="">思加图</a></li>
            <li><a href=""><img src="./image/58.jpg"></a><br/><a class="white1"  href="">WOLFSKIN</a></li>
            <li><a href=""><img src="./image/59.jpg"></a><br/><a class="white1"  href="">LEE</a></li>
            <li><a href=""><img src="./image/60.jpg"></a><br/><a class="white1"  href="">卡特</a></li>
            <li><a href=""><img src="./image/61.jpg"></a><br/><a class="white1"  href="">拔佳</a></li>
            <li><a href=""><img src="./image/62.jpg"></a><br/><a class="white1"  href="">万斯</a></li>
            <li><a href=""><img src="./image/63.jpg"></a><br/><a class="white1"  href="">爱乐</a></li>
            <li><a href=""><img src="./image/64.jpg"></a><br/><a  class="white1" href="">佐丹奴</a></li>
            <li><a href=""><img src="./image/65.jpg"></a><br/><a class="white1"  href="">添柏岚</a></li>
            <li><a href=""><img src="./image/66.jpg"></a><br/><a class="white1"  href="">探路者</a></li>
            <li><a href=""><img src="./image/67.jpg"></a><br/><a class="white1"  href="">暇步士</a></li>
            <li><a href=""><img src="./image/68.jpg"></a><br/><a class="white1"  href="">施华洛世奇</a></li>
            <li><a href=""><img src="./image/69.jpg"></a><br/><a  class="white1" href="">浪莎</a></li>
            <li><a href=""><img src="./image/70.jpg"></a><br/><a class="white1"  href="">ELLE</a></li>
            <li><a href=""><img src="./image/71.jpg"></a><br/><a class="white1"  href="">爱华仕</a></li>
            <li><a href=""><img src="./image/72.jpg"></a><br/><a  class="white1" href="">恐龙纺织</a></li>
            <li><a href=""><img src="./image/73.jpg"></a><br/><a class="white1"  href="">膳魔师</a></li>
            <li><a href=""><img src="./image/74.jpg"></a><br/><a class="white1"  href="">LEVIS</a></li>
            <li><a href=""><img src="./image/75.jpg"></a><br/><a class="white1"  href="">韩都衣舍</a></li>
            <li><a href=""><img src="./image/76.jpg"></a><br/><a class="white1"  href="">乐斯菲斯</a></li>
            <li><a href=""><img src="./image/77.jpg"></a><br/><a class="white1"  href="">哥伦比亚</a></li>
            <li><a href=""><img src="./image/78.jpg"></a><br/><a class="white1"  href="">史努比</a></li>
            <li><a href=""><img src="./image/79.jpg"></a><br/><a class="white1"  href="">杉杉</a></li>
            <li><a href=""><img src="./image/80.jpg"></a><br/><a  class="white1" href="">ICE-WATCH</a></li>
            <li><a href=""><img src="./image/81.jpg"></a><br/><a class="white1"  href="">Dickies</a></li>
            <li><a href=""><img src="./image/82.jpg"></a><br/><a class="white1"  href="">NAUTICA</a></li>
            <li><a href=""><img src="./image/83.jpg"></a><br/><a class="white1"  href="">恒源祥</a></li>
            <li><a href=""><img src="./image/84.jpg"></a><br/><a  class="white1" href="">瑞士军刀</a></li>
            <li><a href=""><img src="./image/85.jpg"></a><br/><a class="white1"  href="">15分钟</a></li>
            <li><a href=""><img src="./image/86.jpg"></a><br/><a class="white1"  href="">奥索卡</a></li>
            <li><a href=""><img src="./image/87.jpg"></a><br/><a class="white1"  href="">茵奈儿</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <a href=""><div class="ygdg_jt_r fl"></div></a>
    <div class="clear"></div>
    <div class="ygdg_dh" class="w1 border">


        <?php
$sql="SELECT id,name FROM ".PRE."category WHERE display='0' AND pid=0 ORDER BY id DESC LIMIT 8";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $goodlist=array();
    while($row=mysqli_fetch_assoc($result)){
        $goodlist[]=$row;
    }
}
//var_dump($goodlist);
foreach($goodlist as $val){
//    var_dump($val);
    $sql="SELECT name FROM ".PRE."category WHERE display='0' AND pid=".$val['id']." ORDER BY id DESC";
//    echo $sql;exit;
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)){
        $goodlists=array();
        while($row=mysqli_fetch_assoc($result)){
            $goodlists[]=$row;
        }  
    }
echo '<div class="last_dh fl" ><a href="">'.$val['name'].'</a>&nbsp;&nbsp;&nbsp;';
    foreach($goodlists as $value){
       echo '<a href="">'.$value['name'].' </a>';
    } 
    echo '<br/></div>';
//            var_dump($goodlists);
}
?>


        <div class="clear"></div>
    </div>
</div>


</body>
</html>
<?php 
include './footer.php';
?>
