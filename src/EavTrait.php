<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 24.09.15
 * Time: 0:07
 */

namespace mirocow\eav;

use yii\helpers\ArrayHelper;

trait EavTrait
{
    /**
     * @inheritdoc
     */
    public function getAttributeLabel($attribute)
    {
        $labels = $this->attributeLabels();
        if(!isset($labels[$attribute])){
            $label = $this->getLabel($attribute);
            if($label)
                $labels[$attribute] = $label;
        }
        return isset($labels[$attribute]) ? $labels[$attribute] : $this->generateAttributeLabel($attribute);
    }

}