<?php
include '../init.php';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="../css/css.css" type="text/css" rel="stylesheet" />
<link href="../css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="../images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../images/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(../images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：用户管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	         <form method="get" action="index.php">
	         <span>管理员：</span>
	         <input type="text" name="select" class="text-word">
	         <input name="" type="submit" value="查询" class="text-but">
	         </form>
         </td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">订单编号</th>
        <th align="center" valign="middle" class="borderright">商品id</th>
        <th align="center" valign="middle" class="borderright">收件人</th>
        <th align="center" valign="middle" class="borderright">地址</th>
        <th align="center" valign="middle" class="borderright">email</th>
        <th align="center" valign="middle" class="borderright">电话</th>
        <th align="center" valign="middle" class="borderright">邮编</th>
        <th align="center" valign="middle" class="borderright">用户id</th>
        <th align="center" valign="middle" class="borderright">总价</th>
        <th align="center" valign="middle" class="borderright">订单状态</th>
        <th align="center" valign="middle">操作</th>
      </tr>
<?php 
//var_dump($_GET);
$select=$_GET['select'];
$page=$_GET['page'];
$num=5;
$where="WHERE order_num LIKE '%{$select}%'";
$url="&select={$select}";
//echo $url;
$sql="SELECT count(id) as total FROM ".PRE."order {$where}";
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $fetch=mysqli_fetch_assoc($result);
}
//var_dump($fetch);
$total=$fetch['total'];
//echo $total;
$every=ceil($total/$num);
if(empty($page)){
    $page=1;
}
if($page<1){
    $page=1;
}
if($page>$every){
    $page=$every;
}
//echo $every;
$offset=($page-1)*$num;
if(empty($select)){
    $sql="SELECT id,order_num,receiver,address,email,tel,zip,user_id,price_total,status FROM ".PRE."order LIMIT {$offset},{$num}";
}else{
    $sql="SELECT id,order_num,receiver,address,email,tel,zip,user_id,price_total,status FROM ".PRE."order $where LIMIT {$offset},{$num}";
}
//echo $sql;
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $orderlist=array();
    while($row=mysqli_fetch_assoc($result)){
        $orderlist[]=$row;
    }
}

//var_dump($orderlist);
if(empty($orderlist)){echo '无相关结果';exit;}
foreach($orderlist as $key=>$val){
    $id=$val['id'];
    $order_num=$val['order_num'];
    $receiver=$val['receiver'];
    $address=$val['address'];
    $email=$val['email'];
    $tel=$val['tel'];
    $zip=$val['zip'];
    $user_id=$val['user_id'];
    $price_total=$val['price_total'];
    $status=$val['status'];
   
   // var_dump($goodlist);
?>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $key+1+($page-1)*5?></td>
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $order_num?></td>
      <td align="center" valign="middle" class="borderright borderbottom">
<?php 
 $sql="SELECT goods_id,qty FROM ".PRE."order_goods WHERE order_id={$order_num}";
    //echo $sql;
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)>0){
        $goodslist=array();
        while($row=mysqli_fetch_assoc($result)){
            $goodlist[]=$row;
        }
    }

        foreach($goodlist as $value){
            echo $value['goods_id'].'x'.$value['qty'].'&nbsp;';
            unset($goodlist);
        }



?>
</td>
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $receiver?></td>
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $address?></td>
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $email?></td>
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $tel?></td>
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $zip?></td>
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $user_id?></td>
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $price_total?></td>
      <td align="center" valign="middle" class="borderright borderbottom">
<?php

    switch($status){
    case '1':
        echo '未付款';
        break;
    case '2':
        echo '<a href="action.php?p=3&oid='.$val['id'].'">发货</a>';
        break;
    case '3':
        echo '已付款已发货';
        break;
    case '4':
        echo '收货';
        break;
    case '5':
        echo '评论';
        break;
    }

?></td>
        <td align="center" valign="middle" class="borderbottom"><a href="edit.php?id=<?php echo $id?>" target="mainFrame" onFocus="this.blur()" class="add">编辑</a><span class="gray">&nbsp;|&nbsp;</span><a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">删除</a></td>
      </tr>

<?php 

}?>
<?php 
    $prev=$page-1;
    $next=$page+1;
?>

    </table></td>
    </tr>
  <tr>
  <td align="left" valign="top" class="fenye"><?php echo $total?> 条数据 <?php echo $page?>/<?php echo $every?> 页&nbsp;&nbsp;<a href="index.php?page=1<?php echo $url?>" target="mainFrame" onFocus="this.blur()">首页</a>&nbsp;&nbsp;<a href="index.php?page=<?php echo $prev.$url?>" target="mainFrame" onFocus="this.blur()">上一页</a>&nbsp;&nbsp;<a href="index.php?page=<?php echo $next.$url?>" target="mainFrame" onFocus="this.blur()">下一页</a>&nbsp;&nbsp;<a href="index.php?page=<?php echo $every.$url?>" target="mainFrame" onFocus="this.blur()">尾页</a></td>
  </tr>
</table>
</body>
</html>
