<?php
namespace backend\tests\unit\models;

use common\models\Admin;
use common\models\SignupForm;

class SignupFormTest extends \Codeception\Test\Unit
{
    public function testCorrectSignup()
    {
        $admin =  Admin::findIdentity(3);

    }
    public function testAdminSave()
    {
        $model = new SignupForm();
        $model->username = 'test';
        $model->email = 'test@test1.com';
        $model->password = 'test1234';
        expect_that($model->signup());
    }

}
