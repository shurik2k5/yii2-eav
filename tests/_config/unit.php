<?php
/**
 * Application configuration for unit tests
 */
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../unit/_config.php'),
    [
        'class' => 'yii\console\Application'
    ]
);