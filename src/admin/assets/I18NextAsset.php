<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mirocow\eav\admin\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class I18NextAsset extends AssetBundle
{

    public $sourcePath = '@bower/i18next';
    public $path = '';
    public $css = [];
    public $js = [
        'i18next.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}