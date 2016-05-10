<?php 
	include './Model.class.php';
	$ax = new Model('users');
	// var_dump($ax);
	// $a = $ax->select();
	// var_dump($a);
	// $b = $ax->find(33);
	// var_dump($b);
	// $arr = array('name'=>'ax','age'=>'13','sex'=>1,'province'=>'shanghai');
	// $c = $ax->add($arr);
	// // var_dump($c);
	// $d = $ax->del($c);	
	// echo $d;
	$arr = array('id'=>37,'name'=>'al','age'=>'3');
	$e = $ax->save($arr);
	var_dump($e);




 ?>