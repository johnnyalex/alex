<?php
include'header.php';

$cid=$_GET['cid'];
$sql="SELECT id,name FROM ".PRE."category WHERE pid={$cid} AND display=0";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $clist=array();
    while($row=mysqli_fetch_assoc($result)){
        $clist[]=$row;
    }
}
//var_dump($clist);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Sss</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>

<?php
foreach($clist as $val){
    $cid=$val['id'];
    $cname=$val['name'];
    $sql="SELECT id,name,price,stock,`describe` FROM ".PRE."goods WHERE status=1 AND cate_id={$cid} LIMIT 4";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)>0){
        $glist=array();
        while($row=mysqli_fetch_assoc($result)){
            $glist[]=$row;
        }
    }
//    var_dump($glist);
?>
    <div class="ejym_all">
    <div class="ejym_bt fl"><?php echo $cname ?></div>
<?php
    if(!empty($glist)){
    foreach($glist as $value){
    $gid=$value['id'];
    $gname=$value['name'];
    $price=$value['price'];
    $stock=$value['stock'];
    $describe=$value['describe'];
    $sql="SELECT name FROM ".PRE."image WHERE goods_id={$gid}";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $iname=$row['name'];
    }
    $img_url=URL.'uploads/';
    $img_url .=substr($iname,0,4).'/';
    $img_url .=substr($iname,4,2).'/';
    $img_url .=substr($iname,6,2).'/';
    $img_url .=$iname;
?>
    <div class="ejym_tp border_sssc fl">
    <a href="detail.php?gid=<?php echo $gid?>"><img src="<?php echo $img_url?>"></a><br/>
    <a href=""><?php echo $gname ?></a><br/>
    <a href=""><?php echo $describe ?></a><br/>
    <a href=""><?php echo $price ?></a>
    </div>


<?php }}?>  </div>  <?php } ?>

</body>
</html>
<?php include 'footer.php' ?>
