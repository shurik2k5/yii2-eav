<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 24.09.15
 * Time: 0:07
 */

namespace mazurva\eav;

use yii\helpers\ArrayHelper;

trait EavTrait
{
    /**
     * @inheritdoc
     */
    public function getAttributeLabel($attribute)
    {
        $labels = ArrayHelper::merge($this->attributeLabels(), $this->getLabels());
        return isset($labels[$attribute]) ? $labels[$attribute] : $this->generateAttributeLabel($attribute);
    }

}