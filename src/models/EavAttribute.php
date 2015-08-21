<?php

namespace mirocow\eav\models;

use mirocow\eav\models\EavCategory;
use mirocow\eav\models\EavAttributeValue;
use mirocow\eav\models\EavAttributeOption;
use mirocow\eav\models\EavAttributeType;
use Yii;

/**
 * This is the model class for table "{{%eav_attribute}}".
 *
 * @property integer $id
 * @property integer $categoryId
 * @property integer $typeId
 * @property string $name
 * @property string $defaultValue
 * @property integer $defaultOptionId
 * @property integer $required
 *
 * @property EavCategory $category
 * @property EavAttributeOption $defaultOption
 * @property EavAttributeType $type
 * @property EavAttributeOption[] $eavAttributeOptions
 * @property EavAttributeValue[] $eavAttributeValues
 */
class EavAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav_attribute}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId', 'typeId', 'defaultOptionId', 'required'], 'integer'],
            [['name', 'defaultValue'], 'string', 'max' => 255],
            //[['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => EavCategory::className(), 'targetAttribute' => ['categoryId' => 'id']],
            //[['defaultOptionId'], 'exist', 'skipOnError' => true, 'targetClass' => EavAttributeOption::className(), 'targetAttribute' => ['defaultOptionId' => 'id']],
            //[['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => EavAttributeType::className(), 'targetAttribute' => ['typeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryId' => 'Category ID',
            'typeId' => 'Type ID',
            'name' => 'Name',
            'defaultValue' => 'Default Value',
            'defaultOptionId' => 'Default Option ID',
            'required' => 'Required',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(EavCategory::className(), ['id' => 'categoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultOption()
    {
        return $this->hasOne(EavAttributeOption::className(), ['id' => 'defaultOptionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(EavAttributeType::className(), ['id' => 'typeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributeOptions()
    {
        return $this->hasMany(EavAttributeOption::className(), ['attributeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributeValues()
    {
        return $this->hasMany(EavAttributeValue::className(), ['attributeId' => 'id']);
    }
}