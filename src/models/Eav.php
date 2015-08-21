<?php

namespace mirocow\eav\models;

use mirocow\eav\models\EavCategory;
use mirocow\eav\models\EavAttributeValue;
use Yii;

/**
 * This is the model class for table "{{%eav}}".
 *
 * @property integer $id
 * @property integer $categoryId
 *
 * @property EavCategory $category
 * @property EavAttributeValue[] $eavAttributeValues
 */
class Eav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId'], 'integer'],
            //[['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => EavCategory::className(), 'targetAttribute' => ['categoryId' => 'id']],
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
    public function getEavAttributeValues()
    {
        return $this->hasMany(EavAttributeValue::className(), ['entityId' => 'id']);
    }
}