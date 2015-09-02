<?php

namespace mirocow\eav\models;

use mirocow\eav\models\Eav;
use mirocow\eav\models\EavAttribute;
use mirocow\eav\models\EavAttributeOption;
use Yii;

/**
 * This is the model class for table "{{%eav_attribute_value}}".
 *
 * @property integer $id
 * @property integer $entityId
 * @property integer $attributeId
 * @property string $value
 * @property integer $optionId
 *
 * @property EavAttribute $attribute
 * @property Eav $entity
 * @property EavAttributeOption $option
 */
class EavAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav_attribute_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entityId', 'attributeId'], 'required'],
            [['entityId', 'attributeId', 'optionId'], 'integer'],
            [['value'], 'string', 'max' => 255],
            //[['attributeId'], 'exist', 'skipOnError' => true, 'targetClass' => EavAttribute::className(), 'targetAttribute' => ['attributeId' => 'id']],
            //[['entityId'], 'exist', 'skipOnError' => true, 'targetClass' => Eav::className(), 'targetAttribute' => ['entityId' => 'id']],
            //[['optionId'], 'exist', 'skipOnError' => true, 'targetClass' => EavAttributeOption::className(), 'targetAttribute' => ['optionId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entityId' => 'Entity ID',
            'attributeId' => 'Attribute ID',
            'value' => 'Value',
            'optionId' => 'Option ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttribute()
    {
        return $this->hasOne(EavAttribute::className(), ['id' => 'attributeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Eav::className(), ['id' => 'entityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(EavAttributeOption::className(), ['id' => 'optionId']);
    }
}