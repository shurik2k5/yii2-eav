<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace lagman\eav\inputs;

use lagman\eav\AttributeHandler;

class EncodedTextInput extends TextInput
{
    const VALUE_HANDLER_CLASS = '\lagman\eav\ArrayValueHandler';

    public function init()
    {
        AttributeHandler::init();
    }
}