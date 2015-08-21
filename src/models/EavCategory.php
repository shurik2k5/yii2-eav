<?php

namespace mirocow\eav\models;

use mirocow\eav\models\Eav;
use mirocow\eav\models\EavAttribute;
use Yii;

/**
 * This is the model class for table "{{%eav_category}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Eav[] $eavs
 * @property EavAttribute[] $eavAttributes
 */
class EavCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavs()
    {
        return $this->hasMany(Eav::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
        return $this->hasMany(EavAttribute::className(), ['categoryId' => 'id']);
    }
}