<?php

namespace common\models;

use Yii;
use yii\base\Event;
use vendor\zbcache\Redis;
use yii\db\Exception;

class Article extends \yii\db\ActiveRecord
{
    const CHANGE_INDEX_HTML = 'change index html';
    // 返回错误
    const DATA_ERROR = 'data error！';
    const DATA_SAVE_ERROR = 'data save ERROR';
    const DATA_UPDATE_ERROR = 'data update error';
    const DATA_SAVE_SUCCESS = 'data save success';
    //场景变量
    const CREATE_ARTICLE = 'cretae';
    const UPDATE_ARTICLE = 'update';

    public function __construct()
    {
        if(true) {
            $redis = new Redis();
            Event::on(Article::class, self::CHANGE_INDEX_HTML, [$redis, Redis::Clear_INDEX_HTML_CACHE]);
            return true;
        }
    }
    public static function tableName()
    {
        return 'article';
    }
    public function rules()
    {
        return [
            [['caption', 'summary', 'category_id'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['caption'], 'string', 'max' => 40],
            [['author'], 'string', 'max' => 10],
            [['summary', 'thumbnail'], 'string', 'max' => 255],
            [['category_id'], 'integer'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caption' => 'Caption',
            'author' => 'Author',
            'summary' => 'Summary',
            'status' => 'Status',
            'category_id' => 'Category',
            'thumbnail' => 'Thumbnail',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function scenarios(){
        return [
            self::CREATE_ARTICLE => ['caption','summary','category_id','updated_at','author','status','created_at'],
            self::UPDATE_ARTICLE => ['id','caption','summary','category_id','updated_at','author','status']
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleDetail()
    {
        return $this->hasOne(ArticleDetail::className(), ['article_id' => 'id']);
    }
    public function getArticleList()
    {
        $article_list = $this::find()->limit(5)->orderBy(['id'=>SORT_DESC])->all();
        return $article_list;
    }
    public function getTechnologyList()
    {
        $article_list = $this::find()->where(['category_id'=>'2'])->limit(5)->orderBy(['id'=>SORT_DESC])->all();
        return $article_list;
    }
    public function getLifeList()
    {
        $article_list = $this::find()->where(['category_id'=>'1'])->limit(5)->orderBy(['id'=>SORT_DESC])->all();
        return $article_list;
    }
    public function saveArticle(array $data)
    {
        $this->trigger(self::CHANGE_INDEX_HTML);
        $this->attributes = $data;
        $this->updated_at = time();
        $this->created_at = time();
        if (!$this->validate()){
            return self::DATA_ERROR;
        }
        if ($this->scenario == self::CREATE_ARTICLE) {
            $this->createArticle($data['articleDetail']['content']);
        }
        else if($this->scenario === self::UPDATE_ARTICLE ){
            $this->updateArticle($data['articleDetail']['content']);
        }

        return self::DATA_SAVE_SUCCESS;
    }
    private function createArticle($article_content){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $res = $this->save(false);
            if (!$res) {
                throw new Exception(self::DATA_SAVE_ERROR);
            }
            $article_detail = new ArticleDetail();
            $article_detail->article_id = $this->id;
            $article_detail->content = $article_content;
            $res = $article_detail->save();
            if (!$res) {
                throw new Exception(self::DATA_SAVE_ERROR);
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            return $e->getMessage();
        }
    }
    private function updateArticle($article_content){
        $res = $this->update(false);
        if (!$res) {
            throw new Exception(self::DATA_UPDATE_ERROR);
        }
        $article_detail =  ArticleDetail::find()->where('article_id=:article_id',[':article_id'=>$this->id])->limit(1)->one();
        $article_detail->content = $article_content;
        $article_detail->update(false);
    }
}
