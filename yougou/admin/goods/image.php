<?php
include '../init.php';
$gid=$_GET['gid'];
$gname=$_GET['gname'];
$sql="SELECT id,name,goods_id,is_face FROM ".PRE."image WHERE goods_id={$gid}";
//echo $sql;
$result=mysqli_query($link,$sql);
if($result && mysqli_num_rows($result)>0){
    $imglist=array();
    while($row=mysqli_fetch_assoc($result)){
        $imglist[]=$row;
    }
}
//var_dump($imglist);exit;

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
    <td width="99%" align="left" valign="top">您的位置：图片管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="40%" align="left" valign="middle">
	         <form method="post" action="action.php?a=addimg" enctype="multipart/form-data">
             <span>上传图片：</span>
             <input type="file" name="pic" class="text-word">
             <input type="hidden" name="gid" value="<?php echo $gid?>">
             <input type="hidden" name="gname" value="<?php echo $gname?>">
	         <input name="" type="submit" value="上传" class="text-but">
	         </form>
         </td>
  		  <td width="60%" align="center" valign="middle" style="text-align:right; width:150px;">你正在管理的是<font size="4" color="green"><?php echo $gname?></font>的图片</td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">图片</th>
        <th align="center" valign="middle" class="borderright">是否封面</th>
        <th align="center" valign="middle">操作</th>
      </tr>
<?php if(!empty($imglist)){  ?>
<?php $i=1;foreach($imglist as $val){?>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $i;$i++;?></td>
        <td align="center" valign="middle" class="borderright borderbottom">
<?php 
            $filename=$val['name'];
            $img_url=URL.'uploads/';
            $img_url .=substr($filename,0,4).'/';
            $img_url .= substr($filename,4,2).'/';
            $img_url .= substr($filename,6,2).'/';
            $img_url .='80_'.$filename;

            ?><img src="<?php echo $img_url?>"></td>

             <td align="center" valign="middle" class="borderright borderbottom"><?php echo $val['is_face']==0?'<a href="action.php?a=is_face&iid='.$val['id'].'&gid='.$gid.'"><font size="5" color="red">×</font></a>':'<a href="action.php?a=is_face&iid='.$val['id'].'&gid='.$gid.'"><font size="6" color="green">√</font></a>'?></td>
             <td align="center" valign="middle" class="borderbottom"><a href="action.php?a=dels&id=<?php echo $val['id']; ?>&gid=<?php echo $gid?>&gname=<?php echo $gname; ?>" target="mainFrame" onFocus="this.blur()" class="add">删除</a></td>
      </tr>
<?php }} ?>

    </table></td>
    </tr>
  <tr>
    <td align="left" valign="top" class="fenye">11 条数据 1/1 页&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">首页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">上一页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">下一页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">尾页</a></td>
  </tr>
</table>
</body>
</html>
