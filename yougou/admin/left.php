<?php
include './init.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧导航menu</title>
<link href="css/css.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/sdmenu.js"></script>
<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>
<style type=text/css>
html{ SCROLLBAR-FACE-COLOR: #538ec6; SCROLLBAR-HIGHLIGHT-COLOR: #dce5f0; SCROLLBAR-SHADOW-COLOR: #2c6daa; SCROLLBAR-3DLIGHT-COLOR: #dce5f0; SCROLLBAR-ARROW-COLOR: #2c6daa;  SCROLLBAR-TRACK-COLOR: #dce5f0;  SCROLLBAR-DARKSHADOW-COLOR: #dce5f0; overflow-x:hidden;}
body{overflow-x:hidden; background:url(images/main/leftbg.jpg) left top repeat-y #f2f0f5; width:194px;}
</style>
</head>
<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
<div id="left-top">
<?php //var_dump($_SESSION)['admin'] ?>
	<div><img src="images/main/member.gif" width="44" height="44" /></div>
    <span>用户：<?php echo $_SESSION['admin']['name'] ?><br>角色：<?php $type=$_SESSION['admin']['type'];switch($type){case 0:echo '普通用户';break;case 1:echo '普通管理员';break;case 2:echo '超级管理员';break;} ?></span>
</div>
    <div style="float: left" id="my_menu" class="sdmenu">
      <div class="collapsed">
        <span>用户管理</span>
        <a href="./user/index.php" target="mainFrame" onFocus="this.blur()">用户列表</a>
        <a href="./user/add.php" target="mainFrame" onFocus="this.blur()">添加用户</a>
      </div>
      <div>
        <span>分类管理</span>
        <a href="./category/index.php" target="mainFrame" onFocus="this.blur()">分组列表</a>
        <a href="./category/add.php" target="mainFrame" onFocus="this.blur()">添加一级分类</a>
      </div>
      <div>
        <span>商品管理</span>
        <a href="./goods/index.php" target="mainFrame" onFocus="this.blur()">商品列表</a>
        <a href="./goods/add.php" target="mainFrame" onFocus="this.blur()">新增商品</a>

      </div>
      <div>
        <span>系统设置</span>
        <a href="./order/index.php" target="mainFrame" onFocus="this.blur()">订单管理</a>
        <a href="./user/main_list.html" target="mainFrame" onFocus="this.blur()">级别权限</a>
        <a href="./user/main_info.html" target="mainFrame" onFocus="this.blur()">角色管理</a>
        <a href="main.php" target="mainFrame" onFocus="this.blur()">自定义权限</a>
      </div>
    </div>
</body>
</html>
