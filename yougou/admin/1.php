<?php
include '../init.php';
for($i=0;$i<50;$i++){
    $name = $i.'admin';
    $password=md5('123');
    $type= 1;
    $sql="INSERT INTO ".PRE."user(id,name,password,type) VALUES(NULL,'{$name}','{$password}','{$type}')";
       // echo $sql;exit;
        $result = mysqli_query($link,$sql);
        if($result && mysqli_affected_rows($link)>0){
            echo '添加成功<a href="index.php">返回</a>';
        
        }else{
            echo '添加失败<a href="add.php">返回</a>';
        }

    }
