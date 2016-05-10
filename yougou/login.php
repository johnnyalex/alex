<?php
include './init.php';
unset($_SESSION['home']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>优购网_用户登录</title>
    <link rel="stylesheet" href="./css/denglu.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>
    <!-- shishangshangcheng -->
    <div id="header" class="w border_sssc h1">
        <div class="sssc fl center"><a class="sssc_w" href="index.php">时尚商城</a></div>       
        <div class="sjyg fl center"><a href="">
            <div class="sjyg_sj fl"></div>
            <div class="sjyg_wr fl">手机优购</div>
            <div class="sjyg_jt fl"></div></a>
        <div class="clear"></div>
        </div>
        <div class="fl_gd h2 fr center"><a href="">
            <div class="fl_gd_w h2 fl">更多</div>
            <div class="sjyg_jt fl"></div></a>
            <div class="clear"></div>
        </div>
        <div class="fl_gg h2 fr center"><a href="">
            <div class="fl_gg_w h2 fl">公告</div>
            <div class="sjyg_jt fl"></div></a>
            <div class="clear"></div>
        </div>
        <div class="fl_wddd h2 fr center"><a href="">
                我的订单
        </a></div>
        <div class="fl_wdyg h2 fr center"><a href="">
                <div class="fl_wdyg_w h2 fl">我的优购</div>
                <div class="sjyg_jt fl"></div></a>
                <div class="clear"></div>
        </div>
        <div class="fl_shu h2 fr center">|</div>
        <!-- zhuce  denglu -->
        <div class="zhuce h2 fr"><a class="fl_zc" href="">
                注册
        </a></div>
        <div class="denglu h2 fr"><a class="fl_dengl" href="">
                登录
        </a></div>
        <div class="clear"></div>
    </div>
    <div id="yhdl">
        <div class="yhdl">
            <div class="yhdl_w fl"><strong>用户登录</strong></div>
            <div class="yhdl_fh fl"><a href="index.php">返回时尚商城</a></div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="main">
    <div class="main_l fl">
        <form action="dologin.php" method="post">
            账号: <input type="text" name="username" class="main_yh" placeholder="邮箱/用户名/手机号">
            <div class="main_kb"></div>
            密码: <input name="password" class="main_mm" type="password" >
            <p><input type="submit" value="" class="tijiao"></p>
            <a class="" href="">忘记密码？</a>
        </form>
    </div>
    <div class="main_r fr">
        <div class="main_r_t ">
            <strong>还不是优购用户？</strong>
        </div>
        <div class="main_r_c">
现在立即注册成为优购用户，便能立刻享受便宜又放心的购物乐趣。            
        </div>
        <a href="register.php"><div class="main_r_b "></div></a>
    </div>
</div>
</body>
</html>
