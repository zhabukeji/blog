<?php

namespace common\models;

use Yii;
use yii\base\Event;
use vendor\zbcache\Redis;

class Article extends \yii\db\ActiveRecord
{
    const CHANGE_INDEX_HTML = 'changeIndexHtml';
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
            [['caption', 'summary', 'category', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['caption'], 'string', 'max' => 40],
            [['author'], 'string', 'max' => 10],
            [['summary', 'Thumbnail'], 'string', 'max' => 255],
            [['category'], 'string', 'max' => 20],
            [['caption'], 'unique'],
            [['summary'], 'unique'],
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
            'Thumbnail' => 'Thumbnail',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function createArticle()
    {
        $this->trigger(self::CHANGE_INDEX_HTML);

    }
}
