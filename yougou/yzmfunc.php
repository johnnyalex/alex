<?php
// 宽度 高度
// 个数
//字体大小 $fontsize
//类型
session_start();

//验证码
function yzmfunc($width=100,$height=40,$num=4,$fontsize=18,$type=1){
//1.创建画布
$img = imagecreatetruecolor($width,$height);
//2.分配颜色
//3.填充背景
imagefill($img,0,0,imagecolorallocate($img,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255)));
//4.画画
//画干扰点
for($i=0;$i<mt_rand(100,200);$i++){
    imagesetpixel(
        $img,
        mt_rand(0,$width),
        mt_rand(0,$height),
        imagecolorallocate($img,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120))
    );
}

//画干扰线
for($j=0;$j<mt_rand(0,8);$j++){
    imageline(
        $img,
        mt_rand(0,$width),mt_rand(0,$height),//第一个点坐标
        mt_rand(0,$width),mt_rand(0,$height),//第二个点坐标
        imagecolorallocate($img,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120))
    );
}
switch($type){
    case 1:
        if($num>10){
            $num=10;
        }
        $str='1234567890';
    break;
    case 2:
        if($num>26){
            $num =26;
        }
        $str='qwertyuiopasdfghjklzxcvbnm';
    break;
    case 3:
        if($num>26){
            $num=26;
        }
        $str='QWERTYUIOPASDFGHJKLZXCVBNM';
        break;
    case 4:
        if($num>54){
            $num=54;
        }
        $str='23456789qwertyupasdfghjkzxcvbnmQWERTYUPASDFGHJKZXCVBNM';
        break;
}

//echo $str;
        
//$str='23456789qwertyupasdfghjkzxcvbnm';
$str = str_shuffle($str);
//echo $str;
$str =substr($str,0,$num);
//echo $str;
//这个东西 你也不用明白 项目前回告诉你这个是什么鬼
$_SESSION['vcode']=$str;
$w = $width/$num;
for($i=0;$i<$num;$i++){
    $x = $i*$w+5;
    $y =mt_rand($fontsize,$height);
imagettftext($img,$fontsize,mt_rand(-40,40),$x,$y,imagecolorallocate($img,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120)),'./fonts/4.ttf',$str{$i});
}
//5.保存输出
header('content-type:image/jpeg');
imagejpeg($img);
//6.销毁资源
imagedestroy($img);
}
yzmfunc(100,40,4,18,4);
