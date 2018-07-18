<?php
namespace backend\tests\unit\models;

use common\models\Admin;

class SignupFormTest extends \Codeception\Test\Unit
{
    public function testCorrectSignup()
    {

        $admin =  Admin::findIdentity(3);
        codecept_debug($admin);
    }

}
