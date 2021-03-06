<?php

namespace frontend\controllers;
use common\models\Article;
use Yii;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $get = Yii::$app->request->get();
        if(empty($get)){
            return Yii::$app->runAction('site/index');
        }
        $article = Article::find()->where('id=:id',[':id' => $get['id']])->with('articleDetail')->limit(1)->one();
        if(empty($article)){
            return Yii::$app->runAction('site/index');
        }
        return $this->render('index',['article' => $article]);
    }

}
