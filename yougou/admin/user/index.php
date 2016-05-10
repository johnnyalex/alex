<?php
include '../init.php';
//var_dump($_GET);
if($_GET['name']!=''){
    $name=$_GET['name'];
    $where="WHERE name LIKE '%{$name}%'";
    $url="&$name={$name}";
}
//var_dump($_SESSION['admin']);
$class=($_SESSION['admin']['type']);
//echo $do;
$num=6;
$sql="SELECT count(id) total FROM ".PRE."user {$where}";
$result=mysqli_query($link,$sql);
if($result && mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
}
//var_dump($row);exit;
$total=$row['total'];
$amount=ceil($total/$num);
//echo $amount;exit;
$page=(int)$_GET['page'];
if($page<=0){
    $page=1;
}
if($page>=$amount){
    $page=$amount;
}
if(empty($page)){$page=1;}
$offset=($page -1)*$num;

$sql="SELECT id,name,sex,type,display,login,points FROM ".PRE."user {$where} LIMIT {$offset},{$num}";
//echo $sql;exit;
    $result=mysqli_query($link,$sql);
//   var_dump($result);
    if($result&&mysqli_num_rows($result)>0){
        $userlist=array();
        while($row=mysqli_fetch_assoc($result)){
            $userlist[]=$row;
        }
    }
    if(empty($userlist)){
            echo '无相关用户,请重新查找 <a href="index.php">返回</a>';
            exit;
            }
    //    var_dump($userlist);exit;
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
    <td width="99%" align="left" valign="top">您的位置：用户管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	         <form method="get" action="index.php">
	         <span>管理员：</span>
	         <input type="text" name="name" value="" class="text-word">
	         <input name="" type="submit" value="查询" class="text-but">
	         </form>
         </td>
  		  <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">新增管理员</a></td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">用户名</th>
        <th align="center" valign="middle" class="borderright">性别</th>
        <th align="center" valign="middle" class="borderright">权限</th>
        <th align="center" valign="middle" class="borderright">锁定</th>
        <th align="center" valign="middle" class="borderright">登录次数</th>
        <th align="center" valign="middle" class="borderright">积分</th>
        <th align="center" valign="middle">操作</th>
      </tr>
<?php $i=1;foreach($userlist as $value){ ?>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
          <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($page-1)*$num+$i; ?></td>
          <td align="center" valign="middle" class="borderright borderbottom"><?php echo $value['name'] ?></td>
        <td align="center" valign="middle" class="borderright borderbottom">
        <?php $sex=$value['sex'];
                switch($sex){
                case 0:
                    echo '女';
                    break;
                case 1:
                    echo '男';
                    break;
                case 2:
                    echo '保密';
                    break;
                }
        ?>
</td>
        <td align="center" valign="middle" class="borderright borderbottom">
        <?php 
            $type=$value['type'];
                switch($type){
                case 0:
                    echo '普通用户';
                    break;
                case 1:
                    echo '普通管理员';
                    break;
                case 2:
                    echo '超级管理员';
                    break;
                }
        ?>
</td>
        <td align="center" valign="middle" class="borderright borderbottom">
<?php if($value['type']==2){echo '开启';}else{ ?>
<?php echo $value['display']==0?'<a href="action.php?a=display&id='.$value['id'].'&display=1">开启</a>':'<a href="action.php?a=display&id='.$value['id'].'&display=0">锁定</a>' ?>
<?php } ?>
</td>
 <td align="center" valign="middle" class="borderright borderbottom">
<?php echo $value['login'];?>
</td>
 <td align="center" valign="middle" class="borderright borderbottom">
<?php echo $value['points'];?>
</td>

<td align="center" valign="middle" class="borderbottom">

<?php if($class>0&&$value['type']<$class){?>
<a href="edit.php?id=<?php echo $value['id'] ?>" target="mainFrame" onFocus="this.blur()" class="add">编辑</a><span class="gray">&nbsp;<?php echo $value['type']!=2?'|':''?>&nbsp;</span><a href="action.php?a=del&id=<?php echo $value['id'] ?>" target="mainFrame" onFocus="this.blur()" class="add"><?php echo $value['type']!=2?'删除':''?></a>
<?php }?>

</td>
<?php $i++; ?>
<?php  }?>
      </tr>

    </table></td>
    </tr>
    <tr>
<?php
    $sql="SELECT id FROM ".PRE."user WHERE type=0";
    $result=mysqli_query($link,$sql);
    if($result&&mysqli_num_rows($result)>0){
    $users=array();
        while($rww=mysqli_fetch_assoc($result)){
        $users[]=$rww;
        }
    } 
    $counts=count($users);
?>
  <td align="left" valign="top" class="fenye">普通用户数:&nbsp;<?php echo $counts?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $total ?>条数据 <?php echo $page ?>/<?php echo $amount ?> 页&nbsp;&nbsp;<a href="index.php?page=1<?php echo $url?>" target="mainFrame" onFocus="this.blur()">首页</a>&nbsp;&nbsp;<a href="index.php?page=<?php echo $prev.$url ?>" target="mainFrame" onFocus="this.blur()">上一页</a>&nbsp;&nbsp;<a href="index.php?page=<?php echo $next.$url ?>" target="mainFrame" onFocus="this.blur()">下一页</a>&nbsp;&nbsp;<a href="index.php?page=<?php echo $amount ?>" target="mainFrame" onFocus="this.blur()">尾页</a></td>
  </tr>
</table>
</body>
</html>
