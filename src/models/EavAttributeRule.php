<?php

namespace mirocow\eav\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "eav_attribute_rules".
 *
 * @property integer $id
 * @property integer $attributeId
 * @property string $rules
 */
class EavAttributeRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eav_attribute_rules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attributeId'], 'integer'],
            [['rules'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attributeId' => 'Attribute ID',
            'rules' => 'Rules',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute($name = '')
    {
        return $this->hasOne(EavAttribute::className(), ['id' => 'attributeId']);
    }

    private function getDefaultFields()
    {
        return [
            'id',
            'attributeId',
            'rules'
        ];
    }

    private function getSkipFields()
    {
        return [
            'cid',
        ];
    }

    public function getRules()
    {
        return [];
    }

    public function __get($name)
    {
        if (in_array($name, $this->getDefaultFields())) {
            return parent::__get($name);
        }

        if (in_array($name, $this->getSkipFields())) {

            $rules = Json::decode($this->rules);

            if (isset($rules[$name])) {
                return $rules[$name];
            }

        }

        return [];

    }

    public function __set($name, $value)
    {
        if (in_array($name, $this->getDefaultFields())) {
            return parent::__set($name, $value);
        }

        $rules = Json::decode($this->rules);

        if (!$rules) {
            $rules = [];
        }

        $rules[$name] = $value;

        $this->rules = Json::encode($rules);

    }
}
