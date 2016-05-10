<?php
include 'header.php';
$gid=$_GET['gid'];
$sql="SELECT g.name gname,g.price,g.stock,g.describe,g.visit,i.name iname FROM ".PRE."goods g,".PRE."image i WHERE g.id=i.goods_id AND i.is_face=1 AND g.id={$gid}";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $glist=mysqli_fetch_assoc($result);
}
//var_dump($glist);
$visit=$glist['visit'];
$visit+=1;
//echo $visit;
$sql="UPDATE ".PRE."goods SET visit={$visit} WHERE id={$gid}";
//echo $sql;exit;
$result=mysqli_query($link,$sql);
if($result&&mysqli_affected_rows($link)>0){
    
}
$sql="SELECT name FROM ".PRE."image WHERE goods_id={$gid} AND is_face=0 LIMIT 4";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $ilist=array();
    while($row=mysqli_fetch_assoc($result)){
        $ilist[]=$row;
    }
}
//var_dump($ilist);
$img_url=URL.'uploads/';
$img_url .=substr($glist['iname'],0,4).'/';
$img_url .=substr($glist['iname'],4,2).'/';
$img_url .=substr($glist['iname'],6,2).'/';
$img_url .='350_'.$glist['iname'];
?>
<div style="width:1192px;height:450px;margin:0 auto;margin-top:10px;">
    <div style="width:350px;height:450px;float:left">
        <div>
        <img src="<?php echo $img_url?>">
        </div>



<?php
if(!empty($ilist)){
    foreach($ilist as $val){
        $simg_url=URL.'uploads/';
        $simg_url .=substr($val['name'],0,4).'/';
        $simg_url .=substr($val['name'],4,2).'/';
        $simg_url .=substr($val['name'],6,2).'/';
        $simg_url .='80_'.$val['name'];
?>
    <img src="<?php echo $simg_url?>">
<?php
    }
} 
?>
    </div>
    <div style="width:800px;height:450px;border:1px solid pink;float:right">
        <div style="font-size:20px;color:#666666;margin:10px 10px;"><?php echo $glist['gname']?></div>
        <div style="width:500px;height:80px;background:;">
            <div style="line-height:30px;font-size:"><?php echo $glist['describe']?></div>
            <div style="font-size:20px;color:red;">&yen;<?php echo $glist['price']?></div>
        </div>
        <form action="docart.php?a=add" method="post">
        <input type="hidden" name="id" value="<?php echo $gid?>">
        <p>配送至: <select><option>上海徐汇区城区</option><option>上海闵行区城区</option><option>上海普陀区城区</option></select>有货 剩余库存: <?php echo $glist['stock']?></p><br/>
        <div style="width:49px;height:34px;border:1px solid #CCCCCC">
            <div style="width:31px;height:34px;border-right:1px solid #CCCCCC;float:left">
<?php 
$i=$_GET['s'];
if(empty($i)){$i=1;}
?>
<!-- shuliang -->
<div style="float:left;line-height:16px;"><input type="text" name="num" style="width:27px;height:31px;text-align:center" value="<?php echo $i?>"></div>
            </div>
            <div style="width:17px;height:18px;border-bottom:1px solid #CCCCCC;float:right">
<!-- jia -->
<div style="float:left;line-height:16px;margin-left:4px;"><a href="detail.php?s=<?php echo $i<$glist['stock']?$i+1:$glist['stock']?>&gid=<?php echo $gid?>">+</a></div>                
            </div>
<!-- jian -->
<div style="float:left;line-height:16px;margin-left:5px;"><a href="detail.php?s=<?php echo $i==1?1:$i-1;?>&gid=<?php echo $gid?>">-</a></div>
        </div>
            
            
            <div style="float:left"><input type="submit" value="加入购物车"></div>
    <div style="clear:both"></div>
<br/>评价:<br/>
<?php
$sql="SELECT word,user_name FROM ".PRE."goods_comment WHERE goods_id={$gid} LIMIT 5";
//echo $sql;
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $words=array();
    while($rowc=mysqli_fetch_assoc($result)){
        $words[]=$rowc;
    }
}
//var_dump($words);
if(!empty($words)){
foreach($words as $val){
    echo $val['user_name'].': '.$val['word'].'<br/>';
}}
?>
        </form>
    </div>
</div>





<?php
include 'footer.php';
?>
