<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Article;

/**
 * Site controller
 */
class ArticleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'index','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $article = new Article();
        $article = $article::find()->limit(5)->all();
        return $this->render('index',['article' => $article]);
    }
    public function actionCreate(){
        $post_data = Yii::$app->request->post();
        if(!empty($post_data)){
            $article = new Article();
            $article->setScenario($article::CREATE_ARTICLE);
            $res = $article->saveArticle($post_data);
            return $res;
        }
        return $this->render('create');
    }
    public function actionUpdate(){
        $post_data = Yii::$app->request->post();
        if(!empty($post_data)){
            $article = Article::find()->where('id=:id',[':id' => $post_data['id']])->limit(1)->one();
            $article->setScenario($article::UPDATE_ARTICLE);
            $res = $article->saveArticle($post_data);
            return $res;
        }
        $get_data = Yii::$app->request->get();
        if(empty($get_data)){
            return Yii::$app->runAction('article/index');
        }
        $article = Article::find()->where('id=:id',[':id' => $get_data['id']])->with('articleDetail')->limit(1)->one();
        if(empty($article)){
            return Yii::$app->runAction('article/index');
        }
        return $this->render('update',['article'=>$article]);
    }

}
