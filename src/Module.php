<?php

namespace shurik2k5\eav;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'shurik2k5\eav\controllers';

    public $defaultRoute = 'default';

    public function init()
    {
        parent::init();

        $this->setModule('admin', 'shurik2k5\eav\admin\Module');
        $this->registerTranslations();
    }

    public function createController($route)
    {

        if (strpos($route, 'admin/') !== false) {
            return $this->getModule('admin')->createController(str_replace('admin/', '', $route));
        } else {
            return parent::createController($route);
        }
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['eav'] =
            [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@shurik2k5/eav/messages',
                'forceTranslation' => true
            ];
    }
}
