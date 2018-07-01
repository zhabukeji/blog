<?php

namespace common\models;

use Yii;
use yii\base\Event;
use vendor\zbcache\Redis;
use yii\db\Exception;

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
            [['caption', 'summary', 'category'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['caption'], 'string', 'max' => 40],
            [['author'], 'string', 'max' => 10],
            [['summary', 'thumbnail'], 'string', 'max' => 255],
            [['category'], 'integer'],
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
            'thumbnail' => 'Thumbnail',
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
    public function createArticle(array $data)
    {
        $this->trigger(self::CHANGE_INDEX_HTML);
        $article_detail = new ArticleDetail();
        $this->caption = $data['caption'];
        $this->summary = $data['summary'];
        $this->category = $data['category'];
        $this->updated_at = time();
        $this->created_at = time();

        $article_detail->text = $data['content'];
        $transaction = Yii::$app->getDb()->beginTransaction();
        try{
            $res = $this->save();
            if(!$res){
                throw new Exception("文章保存失败");
            }
            $article_detail->article_id = $this->id;
            $article_detail->save();
            $transaction->commit();
        }
        catch (\Exception $e){
            $transaction->rollBack();
            return $e->getMessage();
        }
        return '文章保存成功';
    }
}
