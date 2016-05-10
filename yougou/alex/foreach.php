<?php
include './init.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Alex</title>
<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>
<ul>
<?php
$sql="SELECT id,name FROM ".PRE."category WHERE display='0' AND pid=0 ORDER BY id DESC LIMIT 9";
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
echo '<li><div class="dt_zd_s"><b><a class="dt_zd_b" href="">'.$val['name'].'</a></b><br/>';
    foreach($goodlists as $value){
       echo '<a class="dt_zd_d" href="">'.$value['name'].' </a>';
    } 
    echo '</div></li>';
//            var_dump($goodlists);
}
?>
</ul>
</body>
</html>
