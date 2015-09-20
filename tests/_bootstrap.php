<?php
// This is global bootstrap for autoloading
defined('VENDOR_DIR') or define('VENDOR_DIR', __DIR__ . '/../vendor');
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require_once __DIR__ . implode(DIRECTORY_SEPARATOR, ['', '..', 'vendor', 'autoload.php']);
require_once __DIR__ . implode(DIRECTORY_SEPARATOR, ['', '..', 'vendor', 'yiisoft', 'yii2', 'Yii.php']);
Yii::setAlias('@tests', __DIR__);
Yii::setAlias('@data', __DIR__ . DIRECTORY_SEPARATOR . '_data');
Yii::setAlias('@yii/debug', VENDOR_DIR . '/yiisoft/yii2-debug'); // needed for hhvm
