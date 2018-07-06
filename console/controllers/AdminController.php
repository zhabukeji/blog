<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;
use common\models\SignupForm;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }
    public function actionCreate($username = 'admin' , $email = 'admin@admin.com' , $password = 'admin'){
        $model = new SignupForm();
        $model->username = ￥username;
        $model->email = $email;
        $model->password = $password;
        $model->signup();
        if($model->signup()){
            echo '缓存清除成功'.PHP_EOL;
        }else{
            echo '用户添加成功'.PHP_EOL;
        }
        return ExitCode::OK;

    }
}
