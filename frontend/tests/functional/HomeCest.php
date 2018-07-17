<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->canSeeLink('首页');
        $I->see('玩生活，趣科技');
    }
    public function checkPerson(FunctionalTester $I){
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->dontSee('好布');
        $I->see(\Yii::$app->params['saying'][0]);
    }
    public function checkErrorUrl(FunctionalTester $I){
        $I->amOnPage(Url::toRoute('/article/index',['id'=> '0']));
        $I->canSeeLink('首页');
    }
}