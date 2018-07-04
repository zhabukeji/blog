<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = "成长——玩生活，趣科技";
?>

<div class="am-u-md-8 am-u-sm-12">
    <article class="am-article blog-article-p">
        <div class="am-article-hd">
            <h1 class="am-article-title blog-text-center"><?= Html::encode($article->caption) ?></h1>
            <p class="am-article-meta blog-text-center">
                <span><a href="#" class="blog-color"><?= $article->category_id ?> &nbsp;</a></span>-
                <span><a href="#">@<?= Html::encode($article->author) ?> &nbsp;</a></span>-
                <span><a href="#"><?= date('Y/m/d',$article->created_at) ?></a></span>
            </p>
        </div>
        <div class="am-article-bd">
            <?= Html::encode($article->articleDetail->content) ?>
        </div>
    </article>
    <hr>
    <ul class="am-pagination blog-article-margin">
        <li class="am-pagination-prev"><a href="" class="">&laquo; 一切的回顾</a></li>
        <li class="am-pagination-next"><a href="">不远的未来 &raquo;</a></li>
    </ul>
    <hr>
</div>

