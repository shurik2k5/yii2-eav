<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mirocow\eav\widgets;

use mirocow\eav\EavModel;
use mirocow\eav\handlers\ValueHandler;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\db\ActiveRecord;

/**
 * Class AttributeHandler
 * @package mirocow\eav
 */
class AttributeHandler extends Widget
{
    const VALUE_HANDLER_CLASS = '\mirocow\eav\handlers\RawValueHandler';

    /** @var EavModel */
    public $owner;

    /** @var ValueHandler */
    public $valueHandler;

    /** @var ActiveRecord */
    public $attributeModel;

    public $nameField = 'name';
    public $labelField = 'label';
    public $options = [];

    /**
     * @param EavModel $owner
     * @param ActiveRecord $attributeModel
     * @return AttributeHandler
     * @throws \yii\base\InvalidConfigException
     */
    public static function load($owner, $attributeModel)
    {
        if (!class_exists($class = $attributeModel->eavType->handlerClass)) {
            throw new InvalidConfigException('Unknown handler class: ' . $class);
        }

        $handler = Yii::createObject([
            'class' => $class,
            'owner' => $owner,
            'attributeModel' => $attributeModel
        ]);
        $handler->init();

        return $handler;
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->valueHandler = Yii::createObject([
            'class' => static::VALUE_HANDLER_CLASS,
            'attributeHandler' => $this,
        ]);
    }

    /**
     * @return string
     */
    public function getAttributeName()
    {
        return (string)($this->attributeModel->{$this->nameField});
    }

    /**
     * @return string
     */
    public function getAttributeLabel()
    {
        return (string)($this->attributeModel->{$this->labelField});
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        $result = [];
        foreach ($this->attributeModel->eavOptions as $option) {
            $result[] = $option->getPrimaryKey();
        }
        return $result;
    }
}
