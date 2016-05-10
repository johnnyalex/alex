<?php
include '../init.php';
$num=5;
$name=$_GET['name'];
$cate=$_GET['cate'];
$url="&name={$name}&cate={$cate}";
$sql="SELECT count(id) total FROM ".PRE."goods";
if(!empty($name)&&empty($cate)){
    $sql="SELECT count(id) total FROM ".PRE."goods WHERE name LIKE '%{$name}%'";
}elseif(!empty($cate)&&empty($name)){
    $sql="SELECT id FROM ".PRE."category WHERE name='{$cate}'";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $id=$row['id'];
    }
    $sql="SELECT count(id) total FROM ".PRE."goods WHERE cate_id={$id}";
}elseif(!empty($name)&&!empty($cate)){
    $sql="SELECT count(g.id) total FROM ".PRE."category c,".PRE."goods g WHERE c.name LIKE '%{$cate}%' AND c.id=g.cate_id AND g.name LIKE '%{$name}%'";
}
//echo $sql;
$result=mysqli_query($link,$sql);
if($result && mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
}
$total=$row['total'];
$amount=ceil($total/$num);
$page=(int)$_GET['page'];
if($page<=0){
    $page=1;
}
if($page>=$amount){
    $page=$amount;
}
if(empty($page)){$page=1;}
$offset=($page -1)*$num;

$where="WHERE g.id=i.goods_id AND i.is_face=1 LIMIT {$offset},{$num}";
if(!empty($name)&&empty($cate)){
$where="WHERE g.id=i.goods_id AND i.is_face=1 AND g.name LIKE '%{$name}%' LIMIT {$offset},{$num}";
}
if(!empty($cate)&&empty($name)){
    $sql="SELECT id FROM ".PRE."category WHERE name={$cate}";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows){
        $row=mysqli_fetch_assoc($result);
    }
    $id=$row['id'];
$where="WHERE g.id=i.goods_id AND i.is_face=1 AND g.cate_id LIKE '%{$id}%' LIMIT {$offset},{$num}";
}
if(!empty($name)&&!empty($cate)){
    $sql="SELECT id FROM ".PRE."category WHERE name='{$cate}'";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows){
        $row=mysqli_fetch_assoc($result);
    }
    $id=$row['id'];
$where="WHERE g.id=i.goods_id AND g.name LIKE '%{$name}%' AND g.cate_id LIKE '%{$id}%' AND i.is_face=1 LIMIT {$offset},{$num}";
}
    $sql="SELECT g.id gid,g.name gname,g.price,g.stock,g.is_hot,g.is_new,g.is_best,g.addtime,g.status,g.cate_id,g.visit,i.name iname FROM ".PRE."goods g,".PRE."image i {$where}";
//echo $sql;exit;
$result=mysqli_query($link,$sql);
if($result && mysqli_num_rows($result)){
    $goodlist=array();
    while($row=mysqli_fetch_assoc($result)){
        $goodlist[]=$row;
    }
}
//var_dump($goodlist);

//var_dump($goodlist);
for($i=0;$i<count($goodlist);$i++){
    $sql="SELECT name FROM ".PRE."category WHERE id={$goodlist[$i]['cate_id']}";
    $result=mysqli_query($link,$sql);
    if($result && mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $goodlist[$i]['cate_name']=$row['name'];
    }
    //var_dump($row);
}
//var_dump($goodlist);
$next=$page+1;
$prev=$page-1;
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
    <td width="99%" align="left" valign="top">您的位置：商品管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="30%" align="left" valign="middle">
	         <form method="get" action="index.php">
	         <span>管理员：</span>
	         <input type="text" name="name" placeholder="商品名称" class="text-word">
	         <input type="text" name="cate" placeholder="分类名称" class="text-word">
	         <input name="" type="submit" value="查询" class="text-but">
	         </form>
         </td>
  		  <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="add.php" target="mainFrame" onFocus="this.blur()" class="add">新增商品</a></td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">商品名称</th>
        <th align="center" valign="middle" class="borderright">分类名称</th>
        <th align="center" valign="middle" class="borderright">商品价格</th>
        <th align="center" valign="middle" class="borderright">商品图片</th>
        <th align="center" valign="middle" class="borderright">商品库存</th>
        <th align="center" valign="middle" class="borderright">是否上架</th>
        <th align="center" valign="middle" class="borderright">是否热销</th>
        <th align="center" valign="middle" class="borderright">是否精品</th>
        <th align="center" valign="middle" class="borderright">是否新品</th>
        <th align="center" valign="middle" class="borderright">浏览次数</th>
        <th align="center" valign="middle">操作</th>
      </tr>
<?php if(!empty($goodlist)){ ?>
<?php $i=1; foreach($goodlist as $value){ ?>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $i;$i++;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $value['gname'] ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $value['cate_name'] ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $value['price'] ?></td>
        <td align="center" valign="middle" class="borderright borderbottom">
            <?php
            $filename=$value['iname'];
            $img_url= URL.'uploads/';
            $img_url .= substr($filename,0,4).'/';
            $img_url .= substr($filename,4,2).'/';
            $img_url .= substr($filename,6,2).'/';
            $img_url .='50_'.$filename;
        //   echo $img_url;
?>
            <img src="<?php echo $img_url?>">
</td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $value['stock']?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $value['status']==0?'<a href="action.php?a=status&gid='.$value['gid'].'&type=1">×</a>':'<a href="action.php?a=status&gid='.$value['gid'].'&type=0">√</a>'?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $value['is_hot']==0?'<a href="action.php?a=is_hot&gid='.$value['gid'].'&type=1">×</a>':'<a href="action.php?a=is_hot&gid='.$value['gid'].'&type=0">√</a>'?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $value['is_best']==0?'<a href="action.php?a=is_best&gid='.$value['gid'].'&type=1">×</a>':'<a href="action.php?a=is_best&gid='.$value['gid'].'&type=0">√</a>'?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $value['is_new']==0?'<a href="action.php?a=is_new&gid='.$value['gid'].'&type=1">×</a>':'<a href="action.php?a=is_new&gid='.$value['gid'].'&type=0">√</a>'?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $value['visit']?></td>
        <td align="center" valign="middle" class="borderbottom"><a href="image.php?gid=<?php echo $value['gid']?>&gname=<?php echo $value['gname']?>" target="mainFrame" onFocus="this.blur()" class="add">图片管理</a><span class="gray">&nbsp;|&nbsp;</span><a href="comment.php?gid=<?php echo $value['gid']?>&gname=<?php echo $value['gname']?>" target="mainFrame" onFocus="this.blur()" class="add">评论管理</a><span class="gray">&nbsp;|&nbsp;</span><a href="edit.php?id=<?php echo $value['gid'] ?>" target="mainFrame" onFocus="this.blur()" class="add">编辑</a><span class="gray">&nbsp;|&nbsp;</span><a href="action.php?a=del&gid=<?php echo $value['gid']?>" target="mainFrame" onFocus="this.blur()" class="add">删除</a></td>
      </tr>
<?php } }?>
    </table></td>
    </tr>
  <tr>
  <td align="left" valign="top" class="fenye"><?php echo $total ?>条数据 <?php echo $page ?>/<?php echo $amount ?> 页&nbsp;&nbsp;<a href="index.php?page=1<?php echo $url?>" target="mainFrame" onFocus="this.blur()">首页</a>&nbsp;&nbsp;<a href="index.php?page=<?php echo $prev.$url ?>" target="mainFrame" onFocus="this.blur()">上一页</a>&nbsp;&nbsp;<a href="index.php?page=<?php echo $next.$url ?>" target="mainFrame" onFocus="this.blur()">下一页</a>&nbsp;&nbsp;<a href="index.php?page=<?php echo $amount.$url ?>" target="mainFrame" onFocus="this.blur()">尾页</a></td>
  </tr>
</table>
</body>
</html>
