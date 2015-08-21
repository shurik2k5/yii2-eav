<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mirocow\eav;

/**
 * Class RawValueHandler
 * @package mirocow\eav
 */
class RawValueHandler extends ValueHandler
{
    /**
     * @inheritdoc
     */
    public function load()
    {
        $valueModel = $this->getValueModel();
        return $valueModel->value;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $dynamicModel = $this->attributeHandler->owner;
        $valueModel = $this->getValueModel();

        $valueModel->value =
            $dynamicModel->attributes[$this->attributeHandler->getAttributeName()];
        if (!$valueModel->save())
            throw new \Exception("Can't save value model");
    }

    public function getTextValue()
    {
        return $this->getValueModel()->value;
    }
}