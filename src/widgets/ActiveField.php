<?php

namespace mirocow\eav\widgets;

use mirocow\eav\helpers\Html;

class ActiveField extends \yii\widgets\ActiveField
{ 
    public function eavInput($options = [])
    {
        $options = array_merge($this->inputOptions, $options);
        $options['form'] = $this->form;
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeEavInput($this->model, $this->attribute, $options);

        return $this;
    } 

}