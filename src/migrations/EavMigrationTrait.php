<?php

namespace mirocow\eav\migrations;

trait EavMigrationTrait
{
    public $tables;
    protected $_tableName;

    public function initMigrationParams()
    {
        $this->tables = [
            'entity' => '{{%eav_entity}}',
            'attribute' => '{{%eav_attribute}}',
            'attribute_type' => '{{%eav_attribute_type}}',
            'value' => '{{%eav_attribute_value}}',
            'option' => '{{%eav_attribute_option}}',
            'rules' => '{{%eav_attribute_rules}}'
        ];
    }

    protected function getTableNameWithoutPrefix($table_name = null)
    {
        if ($table_name === null) {
            $table_name = $this->_tableName;
        }

        return str_replace('{{%', '', str_replace('}}', '', $table_name));
    }

    protected function getIndexName($field, $table = null)
    {
        return '{{%idx-' . $this->getTableNameWithoutPrefix($table) . '-' . $field . '}}';
    }

    protected function getForeignKeyName($field, $table = null)
    {
        return '{{%fk-' . $this->getTableNameWithoutPrefix($table) . '-' . $field . '}}';
    }
}
