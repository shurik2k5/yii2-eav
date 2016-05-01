<?php

namespace mirocow\eav\helpers;

use mirocow\eav\models\EavAttribute;

class Html extends \yii\helpers\Html
{
    public static function activeEavInput($model, $attribute, $options = [])
    {
        $handlerClass = EavAttribute::find()
            ->select(['{{%eav_attribute_type}}.handlerClass'])
            ->innerJoin('{{%eav_attribute_type}}', '{{%eav_attribute_type}}.id = {{%eav_attribute}}.typeId')
            ->innerJoin('{{%eav_entity}}', '{{%eav_entity}}.id = {{%eav_attribute}}.entityId')
            ->where([
                '{{%eav_attribute}}.name' => $attribute,
                '{{%eav_entity}}.entityModel' => $model::className()
            ])
            ->scalar();

        $name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);
        $eavModel = static::getAttributeValue($model, $attribute);

        $handler = $eavModel->handlers[$attribute];

        $handler->owner->activeForm = $options['form'];

        return $handler->run();
    }

}