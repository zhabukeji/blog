<?php
namespace backend\tests\unit\models;

use common\models\Article;

class ArticleTest extends \Codeception\Test\Unit
{
    public function testReadArticle()
    {
        expect_not(Article::findOne(['id' => '0']));
        expect_that(Article::findOne(['id' => '4']));

    }
    public function testSaveArticle()
    {
        $article = new Article();
        $article->setScenario($article::CREATE_ARTICLE);
        $data = [
            'caption' => '这是用来单元测试1',
            'summary' => '这是用来单元测试1',
            'category_id' => '1',
            'articleDetail' => [
                'content' => '这是用来单元测试1'
                ]
        ];
        expect($article->saveArticle($data))->equals($article::DATA_SAVE_SUCCESS);

    }

}
