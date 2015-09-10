<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mazurva\eav\inputs;

use mazurva\eav\handlers\AttributeHandler;

class EncodedTextInput extends TextInput
{
    const VALUE_HANDLER_CLASS = '\mazurva\eav\handlers\ArrayValueHandler';

    public function init()
    {
        AttributeHandler::init();
    }
}