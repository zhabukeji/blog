<?php
use yii\helpers\Url;

$app = Yii::$app;
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title><?=$this->title?></title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <link rel="icon" type="image/png" href="<?=$app->params['static_url']?>/i/favicon.png">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="<?=$this->title?>"/>
  <meta name="msapplication-TileColor" content="#0e90d2">
  <link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.2/css/amazeui.min.css">
  <link rel="stylesheet" href="<?=$app->params['static_url']?>/css/app.css">
</head>

<body id="blog">

<header class="am-g am-g-fixed blog-fixed blog-text-center blog-header">
    <div class="am-u-sm-8 am-u-sm-centered">
        <img width="250" src="<?=$app->params['static_url']?>/i/logo.png" alt="玩趣 Logo"/>
        <h2 class="am-hide-sm-only"></h2>
    </div>
</header>
<hr>
<nav class="am-g am-g-fixed blog-fixed blog-nav">
<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only blog-button" data-am-collapse="{target: '#blog-collapse'}" ><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="blog-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li class="am-active"><a href="<?=$app->homeUrl?>">首页</a></li>
    </ul>
  </div>
</nav>
<hr>
<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed">
    <?= $content ?>
    <div class="am-u-md-4 am-u-sm-12 blog-sidebar">
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-text-center blog-title"><span>About ME</span></h2>
            <img src="<?=$app->params['static_url']?>/i/avatar.jpg" alt="about me" class="blog-entry-img" >
            <p>渣布</p>
            <p>
                我是渣布。死宅程序员。
            </p><p>路一直在走，但是渐渐发现身边的人都离我越来越远，有些是停下脚步，有些则被我抛弃掉。一个人的路，并不可怖，而更多的是无奈。</p>
        </div>
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-title"><span>人生风向标</span></h2>
            <ul class="am-list">
                <li><a href="#">千秋邈矣独留我,百战归来再读书</a></li>
                <li><a href="#">道德构建的是理想社会，而经济学构建的是现实社会</a></li>
                <li><a href="#">天行健，君子以自强不息。地势坤，君子以厚德载物</a></li>
                <li><a href="#">天地不仁，以万物为刍狗。圣人不仁，以百姓为刍狗</a></li>
            </ul>
        </div>
    </div>
</div>
<footer class="blog-footer">
    <div class="blog-text-center">Made By Abu</div>
</footer>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.min.js"></script>
</body>
</html>
