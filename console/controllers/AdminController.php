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
use common\models\Admin;

/**
 * 这个命令是增加后台管理员账户的.
 *
 *
 * @author Alex Abu <gzhabu@gmail.com>
 * @since 2.0
 */
class AdminController extends Controller
{
    /**
     * 这个命令是用来增加管理员用户 username email password.
     * @param .
     * @return int Exit code
     */
    public function actionCreate($username = 'admin', $email = 'admin@admin.com', $password = 'admin')
    {
        $model = new SignupForm();
        $model->username = $username;
        $model->email = $email;
        $model->password = $password;
        if ($model->signup()) {
            echo $model->username.'用户注册成功' . PHP_EOL;
        } else {
            echo '用户添加失败' . PHP_EOL;
        }
        return ExitCode::OK;

    }
    /**
     * 这个命令是用来重置管理员密码 admin  password.
     * @param
     * @return int Exit code
     */
    public function actionPasswordReset($admin, $password)
    {
        $admin = Admin::findOne(['username' => $admin]);
        $admin->setPassword($password);
        if ($admin->save(false)) {
            echo $admin->username . '用户密码修改成功' . PHP_EOL;
        } else {
            echo '用户密码修改失败' . PHP_EOL;
        }
        return ExitCode::OK;
    }
    /**
     * 这个命令是用来重置管理员邮箱 admin email.
     * @param
     * @return int Exit code
     */
    public function actionEmailReset($admin, $email)
    {
        $admin = Admin::findOne(['username' => $admin]);
        $admin->email = $email;
        if ($admin->save()) {
            echo $admin->username . '用户邮箱修改成功' . PHP_EOL;
        } else {
            echo '邮箱修改失败' . PHP_EOL;
        }
        return ExitCode::OK;
    }
}
