<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mirocow\eav\widgets;

use mirocow\eav\handlers\AttributeHandler;

class EncodedTextInput extends TextInput
{
    const VALUE_HANDLER_CLASS = '\mirocow\eav\handlers\ArrayValueHandler';

    public function init()
    {
        AttributeHandler::init();
    }
    
    public function run()
    {
        return $this->owner->activeForm
          ->field($this->owner, $this->getAttributeName(), ['template' => "{input}\n{hint}\n{error}"])
          ->textArea();        
    }    
}