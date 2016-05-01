<?php

namespace mirocow\eav;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'mirocow\eav\controllers';

    public $defaultRoute = 'default';

    public function init()
    {
        parent::init();

        $this->setModule('admin', 'mirocow\eav\admin\Module');
    }

    public function createController($route)
    {

        if (strpos($route, 'admin/') !== false) {
            return $this->getModule('admin')->createController(str_replace('admin/', '', $route));
        } else {
            return parent::createController($route);
        }

    }
}
