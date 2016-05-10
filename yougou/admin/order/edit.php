<?php 
include'../init.php';
$id=$_GET['id'];
//var_dump($_GET);
//echo $id;
$sql="SELECT order_num,receiver,address,email,tel,zip,user_id,price_total,status FROM ".PRE."order WHERE id={$id}";
//echo $sql;
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
}
//var_dump($row);
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
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../images/main/add.jpg) no-repeat 0px 6px; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF}
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
.bggray{ background:#f9f9f9; font-size:14px; font-weight:bold; padding:10px 10px 10px 0; width:120px;}
.main-for{ padding:10px;}
.main-for input.text-word{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; padding:0 10px;}
.main-for select{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666;}
.main-for input.text-but{ width:100px; height:40px; line-height:30px; border: 1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
#addinfo a{ font-size:14px; font-weight:bold; background:url(../images/main/addinfoblack.jpg) no-repeat 0 1px; padding:0px 0 0px 20px; line-height:45px;}
#addinfo a:hover{ background:url(../images/main/addinfoblue.jpg) no-repeat 0 1px;}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：订单管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <form method="post" action="action.php?a=edit&id=<?php echo $id?>" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">订单编号：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="order_num" value="<?php echo $row['order_num']?>" class="text-word" readonly>
        </td>
        </tr>


        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品id：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="goods" value="
        <?php
$sql="SELECT goods_id,qty FROM ".PRE."order_goods WHERE order_id={$row['order_num']}";
//echo $sql;
$result=mysqli_query($link,$sql);
if($result&&mysqli_num_rows($result)>0){
    $goodslist=array();
    while($rows=mysqli_fetch_assoc($result)){
        $goodlist[]=$rows;
    }
}
//var_dump($goodlist);
foreach($goodlist as $value){
    echo $value['goods_id'].'x'.$value['qty'].'&nbsp;&nbsp;&nbsp;';
}
        ?>
        " class="text-word" readonly>
        </td>
      </tr>
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">收件人：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="receiver" value="<?php echo $row['receiver']?>" class="text-word" >
        </td>
      </tr>
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">地址：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="address" value="<?php echo $row['address']?>" class="text-word">
        </td>
      </tr>
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">email：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="email" value="<?php echo $row['email']?>" class="text-word">
        </td>
      </tr>
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">电话：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="tel" value="<?php echo $row['tel']?>" class="text-word">
        </td>
      </tr>
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">邮编：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="zip" value="<?php echo $row['zip']?>" class="text-word">
        </td>
      </tr>
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">用户id：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="user_id" value="<?php echo $row['user_id']?>" class="text-word" readonly>
        </td>
      </tr>
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">总价：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="price_total" value="<?php echo $row['price_total']?>" class="text-word">
        </td>
      </tr>
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">订单状态：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <select name="status" >
            <option value="1" <?php echo $row['status']==1?'selected':''?>>未付款</option>
            <option value="2" <?php echo $row['status']==2?'selected':''?>>已付款未发货</option>
            <option value="3" <?php echo $row['status']==3?'selected':''?>>已付款已发货</option>
            <option value="4" <?php echo $row['status']==4?'selected':''?>>收货</option>
            <option value="5" <?php echo $row['status']==5?'selected':''?>>评论</option>
        </select>
        </td>
      </tr>
<?php

?>
<tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input name="" type="submit" value="提交" class="text-but">
        <input name="" type="reset" value="重置" class="text-but"></td>
        </tr>
    </table>
    </form>
    </td>
    </tr>
</table>
</body>
</html>
