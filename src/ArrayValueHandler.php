<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace lagman\eav;

/**
 * Class RawValueHandler
 * @package lagman\eav
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
        $dynamicModel = $this->attributeHandler->owner;
        $valueModel = $this->getValueModel();

        $value = $dynamicModel->attributes[$this->attributeHandler->getAttributeName()];
        
        
        $valueModel->value = json_encode($value);
        if (!$valueModel->save())
            throw new \Exception("Can't save value model");
    }

    public function getTextValue()
    {
        return json_encode(parent::getTextValue());
    }
}