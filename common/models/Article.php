<?php

namespace common\models;

use Yii;
use yii\base\Event;
use vendor\zbcache\Redis;
use yii\db\Exception;

class Article extends \yii\db\ActiveRecord
{
    const CHANGE_INDEX_HTML = 'changeIndexHtml';
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
        $redis = new Redis();
        Event::on(Article::class,self::CHANGE_INDEX_HTML,[$redis,Redis::Clear_INDEX_HTML_CACHE]);
        return true;
    }
    public static function tableName()
    {
        return 'article';
    }
    public function rules()
    {
        return [
            [['caption', 'summary', 'category'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['caption'], 'string', 'max' => 40],
            [['author'], 'string', 'max' => 10],
            [['summary', 'thumbnail'], 'string', 'max' => 255],
            [['category'], 'integer'],
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
            'category' => 'Category',
            'thumbnail' => 'Thumbnail',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function scenarios(){
        return [
            self::CREATE_ARTICLE => ['caption','summary','category','updated_at','author','status','created_at'],
            self::UPDATE_ARTICLE => ['id','caption','summary','category','updated_at','author','status']
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
    public function saveArticle(array $data)
    {
        $this->trigger(self::CHANGE_INDEX_HTML);
        $this->attributes = $data;
        $this->updated_at = time();
        $this->created_at = time();
        if (!$this->validate()){
            return self::DATA_ERROR;
        }
        $transaction = Yii::$app->db->beginTransaction();
        try{
            if ($this->scenario === self::CREATE_ARTICLE ) {
                $res = $this->save(false);
                if (!$res) {
                    throw new Exception(self::DATA_SAVE_ERROR);
                }
                $article_detail = new ArticleDetail();
                $article_detail->article_id = $this->id;
                $article_detail->text = $data['articleDetail']['text'];
                $res = $article_detail->save();
                if (!$res) {
                    throw new Exception(self::DATA_SAVE_ERROR);
                }
            }elseif ($this->scenario === self::UPDATE_ARTICLE ){
                $res = $this->update(false);
                if (!$res) {
                    throw new Exception(self::DATA_UPDATE_ERROR);
                }
                $article_detail =  ArticleDetail::find()->where('article_id=:article_id',[':article_id'=>$this->id])->limit(1)->one();
                $article_detail->text = $data['articleDetail']['text'];
                $article_detail->update(false);
            }
            $transaction->commit();
        }
        catch (\Exception $e){
            $transaction->rollBack();
            return $e->getMessage();
        }
        return self::DATA_SAVE_SUCCESS;
    }
    public function test(array $data){
        $this->trigger(self::CHANGE_INDEX_HTML);
        $this->attributes = $data;
        $this->updated_at = time();
        $this->created_at = time();
        if (!$this->validate()){
            return self::DATA_ERROR;
        }
        $article_detail = new ArticleDetail();
        $article_detail->text = $data['content'];
        $transaction = Yii::$app->getDb()->beginTransaction();
        try{

            $res = $this->save(false);
            if(!$res){
                throw new Exception(self::DATA_SAVE_ERROR);
            }
            $article_detail->article_id = $this->id;
            $res = $article_detail->save();
            if(!$res){
                throw new Exception(self::DATA_SAVE_ERROR);
            }
            $transaction->commit();
        }
        catch (\Exception $e){
            $transaction->rollBack();
            return $e->getMessage();
        }
        return self::DATA_SAVE_SUCCESS;
    }
}
