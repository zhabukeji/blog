<?php

namespace frontend\controllers;

use common\models\Article;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $redis = Yii::$app->redis;
        // 判断是否缓存了index首页
        $key = Yii::$app->params['redis']['html']['index'];
        if($render = $redis->get($key)) {
            return $render;
        } else {
            // 生成首页并加入redis缓存，返回 render数据
            $article = new Article();
            $article_list = $article->getArticleList();
            unset($article);
            $render = $this->render('index',['article_list'=>$article_list]);
            $redis->set($key,$render);
            return $render;
        }
    }
    public function actionClear()
    {
        $article = new Article();
        $article->createArticle();
        return 1;
    }

}
