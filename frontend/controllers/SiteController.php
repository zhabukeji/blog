<?php

namespace frontend\controllers;

use common\models\Article;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        if(Yii::$app->params['htmlCache']['indexHtmlCache']){
            $redis = Yii::$app->redis;
            // 判断是否缓存了index首页
            $key = Yii::$app->params['redis']['html']['index'];
            if ($render = $redis->get($key)) {
                return $render;
            }
        }

        // 生成首页并加入redis缓存，返回 render数据
        $article = new Article();
        $article_list = $article->getArticleList();
        unset($article);
        $render = $this->render('index', ['article_list' => $article_list]);
        if(Yii::$app->params['htmlCache']['indexHtmlCache']) {
            $redis->set($key, $render);
        }
        return $render;

    }
    public function actionTechnology()
    {
        // 生成首页并加入redis缓存，返回 render数据
        $article = new Article();
        $article_list = $article->getTechnologyList();
        unset($article);
        $render = $this->render('index',['article_list'=>$article_list]);
        return $render;
    }
    public function actionLife()
    {
        // 生成首页并加入redis缓存，返回 render数据
        VarDumper::dump(Yii::$app->requestedRoute=='site/life');
        $article = new Article();
        $article_list = $article->getLifeList();
        unset($article);
        $render = $this->render('index',['article_list'=>$article_list]);
        return $render;
    }


}
