<?php

namespace mirocow\eav\models;

use Yii;

/**
 * This is the model class for table "{{%eav_entity}}".
 *
 * @property integer $id
 * @property string $entityModel
 *
 * @property EavAttribute[] $eavAttributes
 */
class EavEntity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav_entity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entityModel'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entityModel' => 'Entity Model',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
        return $this->hasMany(EavAttribute::className(), ['entityId' => 'id']);
    }
}