<?php
include 'init.php';
$name='热门品牌';
$type='is_hot';
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
foreach($glist as $val){
    $gid=$val['id'];
    $sql="SELECT name FROM ".PRE."image WHERE goods_id={$gid}";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)>0){
        $ilist=array();
        while($row=mysqli_fetch_assoc($result)){
            $ilist[]=$row;
        }
//        var_dump($ilist);
        foreach($ilist as $value){
            $iname=$value['name'];
            echo $iname;



        }
    }
}
