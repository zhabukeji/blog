<?php
/**
 * Created by PhpStorm.
 * User: zhoujingguang
 * Date: 2018/6/21
 * Time: 下午11:08
 */

namespace vendor\zbcache;

class redis
{
    public $redis;
    const Clear_INDEX_HTML_CACHE = 'clearIndexHtmlCache';
    public function __construct(array $config = [])
    {
        $this->redis = \Yii::$app->redis;
    }

    public function clearIndexHtmlCache()
    {
        $key = \Yii::$app->params['redis']['html']['index'];
        if($this->redis->del($key)) {
            return true;
        }
    }

}