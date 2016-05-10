<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>优购网_用户注册</title>
    <link rel="stylesheet" href="./css/zhuce.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>
    <!-- shishangshangcheng -->
    <div id="header" class="w border_sssc h1">
        <div class="sssc fl center"><a class="sssc_w" href="index.html">时尚商城</a></div>       
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
            <div class="yhdl_w fl"><strong>用户注册</strong></div>
            <div class="yhdl_fh fl"><a href="">返回时尚商城</a></div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="main">
    <div class="main_l fl">
        <form action="doregister.php" method="post">
            &nbsp;&nbsp;&nbsp;&nbsp;账号: <input type="text" name="username" class="main_yh" placeholder='4-16位字符,字母开头,支持字母数字及"_"组合'>
            <div class="main_kb"></div>
            &nbsp;&nbsp;&nbsp;&nbsp;密码: <input name="password" class="main_mm" type="password" placeholder='6-16位字符,支持字母数字及"_"组合'>
            <div class="main_kb"></div>
            确认密码: <input name="repassword" class="main_mm" type="password" >
            <div class="main_kb_yz"></div>
            <div>&nbsp;&nbsp;<div class="main_kb_yr fl">验证码:</div><input type="text" class="main_kb_yzm fl" name="code" placeholder="不区分大小写"><img src="./yzmfunc.php" onclick="this.src=this.src+'?i'+Math.random()"></div>
            <p><input type="submit" value="" class="tijiao"></p>
        </form>
    </div>
    <div class="main_r fr">
        <div class="main_r_t ">
        </div>
        <div class="main_r_c">
已有有够账号请登录            
        </div>
        <a href="login.php"><div class="main_r_b "></div></a>
    </div>
</div>
</body>
</html>
