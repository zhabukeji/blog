<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = '首页-——玩生活，趣科技';
$static = \Yii::$app->params['static_url'];
?>
<div class="am-u-md-8 am-u-sm-12">
    <?php foreach ($article_list as $item): ?>
    <article class="am-g blog-entry-article">
        <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-img">
            <img src="<?= $static.$item->thumbnail; ?>" alt="" class="am-u-sm-12">
        </div>
        <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-text">
            <span><a href="" class="blog-color"><?= $item->category ?> &nbsp;</a></span>
            <span> @<?= $item->author ?>  &nbsp;</span>
            <span><?= date('Y/m/d',$item->created_at) ?> </span>
            <h1><a href="<?= Url::toRoute('article/index') . '?id=' . $item->id?>"><?= $item->caption ?> </a></h1>
            <p><?= $item->summary ?>
            </p>
            <p><a href="" class="blog-continue">continue reading</a></p>
        </div>
    </article>
    <? endforeach; ?>
    <ul class="am-pagination">
        <li class="am-pagination-prev"><a href="">&laquo; Prev</a></li>
        <li class="am-pagination-next"><a href="">Next &raquo;</a></li>
    </ul>
</div>
