<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mirocow\eav\inputs;

use mirocow\eav\handlers\AttributeHandler;

class EncodedTextInput extends TextInput
{
    const VALUE_HANDLER_CLASS = '\mirocow\eav\handlers\ArrayValueHandler';

    public function init()
    {
        AttributeHandler::init();
    }
}