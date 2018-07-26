<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;
use vendor\zbcache\Redis;


/**
 * 这个命令是用来清除redis缓存的.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CredisController extends Controller
{
    /**
     * 清除首页缓存.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndexHtml()
    {
        $redis = new Redis();

        if($redis->clearIndexHtmlCache()){
            echo '缓存清除成功'.PHP_EOL;
        }else{
            echo '缓存清除失败'.PHP_EOL;
        }
        return ExitCode::OK;
    }
}
