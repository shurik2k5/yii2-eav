<?php

namespace mirocow\eav\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%eav_attribute_option}}".
 *
 * @property integer $id
 * @property integer $attributeId
 * @property integer $order
 * @property string $value
 * @property string $defaultOptionId
 *
 * @property EavAttribute[] $eavAttributes
 * @property EavAttribute $attribute
 * @property EavAttributeValue[] $eavAttributeValues
 */
class EavAttributeOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav_attribute_option}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attributeId', 'order', 'defaultOptionId'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [
                ['attributeId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => EavAttribute::className(),
                'targetAttribute' => ['attributeId' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order' => Yii::t('eav', 'Sort order'),
            'attributeId' => Yii::t('eav', 'Attribute ID'),
            'value' => Yii::t('eav', 'Value'),
            'defaultOptionId' => Yii::t('eav', 'Default option Id'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
        return $this->hasMany(EavAttribute::className(), ['defaultOptionId' => 'id'])
            ->orderBy(['order' => SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute($name = '')
    {
        return $this->hasOne(EavAttribute::className(), ['id' => 'attributeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(EavAttributeValue::className(), ['optionId' => 'id']);
    }

    public function getListAttributes()
    {

        $models = EavAttribute::find()->select(['id', 'label'])->asArray()->all();

        return ArrayHelper::map($models, 'id', 'label');
    }
}
