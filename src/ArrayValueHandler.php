<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mirocow\eav;

/**
 * Class RawValueHandler
 * @package mirocow\eav
 */
class ArrayValueHandler extends RawValueHandler
{
    /**
     * @inheritdoc
     */
    public function load()
    {
        $value = parent::load();
        return json_decode($value, true);
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $EavModel = $this->attributeHandler->owner;
        $valueModel = $this->getValueModel();

        $value = $EavModel->attributes[$this->attributeHandler->getAttributeName()];
        
        
        $valueModel->value = json_encode($value);
        if (!$valueModel->save())
            throw new \Exception("Can't save value model");
    }

    public function getTextValue()
    {
        return json_encode(parent::getTextValue());
    }
}