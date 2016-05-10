<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>alex.page</title>
	<style type="text/css">
	body{
		background:#ddd;
	}
	table.usertable {
		font-family:verdana,arial,sans-serif;
		font-size:15px;
		color:#333333;
		border-width: 1px;
		border-color: #999999;
		border-collapse: collapse;
	}
	table.usertable th {
	background:#b5cfd2 url('cell-blue.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
	}
	table.usertable td {
	background:#dcddc0 url('cell-grey.jpg');
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #999999;
	}
	div.daohang {
		margin:10px auto;
		background:red;
	}
	</style>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<table border="1px" width="80%" align="center" cellspacing="0px" cellpadding="0px" class="usertable">
<caption><h3>alex.user</h3></captin>
<tr><th>tid</th><th>name</th><th>age</th><th>sex</th><th>province</th></tr>
<?php 
	define('SERVER','localhost');
	define('USER','root');
	define('PASSWORD','333');
	define('DATABASE','alex');
	define('TABLE','users');
	$link = mysqli_connect(SERVER,USER,PASSWORD) or die('link failed');
	mysqli_select_db($link,DATABASE) or die('select_db failed');
	mysqli_set_charset($link,'utf8') or die('set_charset failed');
	// for($i=0;$i<333;$i++){
	// $sql = "INSERT INTO ".TABLE."(name) VALUES('name{$i}')";
	// echo $sql;
	// $result = mysqli_query($link,$sql);
	// }
	@$page=$_GET['p'];
	if(empty($page))
	$page=1;
	$every=13;
	$start=($page-1)*$every;
	$sql = "SELECT count(id) FROM ".TABLE;
	$result = mysqli_query($link,$sql);
	$countid = mysqli_fetch_assoc($result);
	// var_dump($countid);
	$count = $countid['count(id)'];
	// echo $count;
	$numpage = ceil($count/$every);
	mysqli_free_result($result);

	$sql = "SELECT * FROM ".TABLE." LIMIT {$start},{$every}";
	// echo $sql;
	$result = mysqli_query($link,$sql);
	if($result){
		$userlist = array();
		while($row = mysqli_fetch_assoc($result)){
			$userlist[] = $row;
		}
	}
	// var_dump($userlist);
	foreach($userlist as $value){
		// var_dump($value);
		echo '<tr>';
		foreach($value as $val){
			echo '<td>'.$val.'</td>';
		}
		echo '</tr>';
	}
	mysqli_free_result($result);
	mysqli_close($link);
?>
</table>
<div class="daohang">
<?php
	if($page!=1){
		echo "<a href={$_SERVER['PHP_SELF']}?p=".($page-1).">上一页</a>";
	}else{
		echo '上一页';
	}
	$i = 1;
	if($page<7)
	while($i<$page){
		echo "<a href={$_SERVER['PHP_SELF']}?p=".$i.">".$i."</a>";
		$i++;
	}
	if($page>6){
	echo '...';
	echo "<a href={$_SERVER['PHP_SELF']}?p=".($page-2).">".($page-2)."</a>";
	echo "<a href={$_SERVER['PHP_SELF']}?p=".($page-1).">".($page-1)."</a>";
	}	
	echo $page;
	if($page<$numpage)
	echo "<a href={$_SERVER['PHP_SELF']}?p=".($page+1).">".($page+1)."</a>";
	if($page<$numpage-1)
	echo "<a href={$_SERVER['PHP_SELF']}?p=".($page+2).">".($page+2)."</a>";
	if($page < 3){
		echo "<a href={$_SERVER['PHP_SELF']}?p=".($page+3).">".($page+3)."</a>";
		if($page == 1)
		echo "<a href={$_SERVER['PHP_SELF']}?p=".($page+4).">".($page+4)."</a>";
	}
	if($page<$numpage-2)
	echo '...';
	if($page!=$numpage){
		echo "<a href={$_SERVER['PHP_SELF']}?p=".($page+1).">下一页</a>";
	}else{
		echo '下一页';
	}
	echo " 共{$numpage}页";
// var_dump($_SERVER);
?>
<input class="text" type="text" name="p" maxlength="3" style = "width:33px"><input type="submit">
</div>
</form>
</body>
</html>