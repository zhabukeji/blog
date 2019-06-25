<?php
use yii\helpers\Url;

$app = Yii::$app;
$params = $app->params;
$static =  $params['static_url'] ;
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
  <link rel="icon" type="image/png" href="<?= $static ?>/i/favicon.png">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="<?=$this->title?>"/>
  <meta name="msapplication-TileColor" content="#0e90d2">
  <link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.2/css/amazeui.min.css">
  <link rel="stylesheet" href="<?= $static ?>/css/app.css">
</head>

<body id="blog">

<header class="am-g am-g-fixed blog-fixed blog-text-center blog-header">
    <div class="am-u-sm-8 am-u-sm-centered">
        <img width="250" src="<?= $static ?>/i/logo.png" alt="玩趣 Logo"/>
        <h2 class="am-hide-sm-only"></h2>
    </div>
</header>
<hr>
<nav class="am-g am-g-fixed blog-fixed blog-nav">
<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only blog-button" data-am-collapse="{target: '#blog-collapse'}" ><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="blog-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
        <li class="<? echo (Yii::$app->requestedRoute =='site/index' or Yii::$app->requestedRoute == null)?'am-active':null; ?>"><a href="<?=$app->homeUrl?>">首页</a></li>
        <li class="<? echo Yii::$app->requestedRoute =='site/technology'?'am-active':null; ?>"><a href="<?=Url::toRoute('site/technology')?>">科技</a></li>
        <li class="<? echo Yii::$app->requestedRoute =='site/life'?'am-active':null; ?>"><a href="<?=Url::toRoute('site/life')?>">生活</a></li>
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
            <img src="<?= $static ?>/i/avatar.jpg" alt="about me" class="blog-entry-img" >
            <p><?= $params['name']; ?></p>
            <p>
                <?= $params['shortIntroduction'] ?>
            </p>
            <p>
                <?= $params['longIntroduction'] ?>
            </p>
        </div>
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-title"><span>人生风向标</span></h2>
            <ul class="am-list">
                <?php foreach ($params['saying'] as $item): ?>
                <li><a href="#"><?= $item ?></a></li>
                <?php endforeach;?>
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
