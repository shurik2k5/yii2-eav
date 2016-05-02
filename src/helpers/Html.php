<?php

namespace mirocow\eav\helpers;

use mirocow\eav\models\EavAttribute;
use mirocow\eav\widgets\ActiveField;

class Html extends \yii\helpers\Html
{
    public static function activeEavInput($model, $attribute, $options = [])
    {
        $eavModel = static::getAttributeValue($model, $attribute);
        $handler = $eavModel->handlers[$attribute];
        $handler->owner->activeForm = $options['form'];

        /** @var EavAttribute $attributeModel */
        $attributeModel = $handler->attributeModel;

        /** @var ActiveField $model */
        $model = $handler->run();
        $model->label($attributeModel->label);
        $model->hint($attributeModel->description);

        return $model->parts;
    }

}