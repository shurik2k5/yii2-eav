<?php

use shurik2k5\eav\migrations\EavMigrationTrait;
use yii\db\Migration;

class m160501_230535_add_columns_into_attribute_rules extends Migration
{
    use EavMigrationTrait;

    public function init()
    {
        parent::init();
        $this->initMigrationParams();
        $this->_tableName = $this->tables['rules'];
    }

    public function safeUp()
    {
        $this->addColumn($this->_tableName, 'required', $this->smallInteger(1)->defaultValue(0));
        $this->addColumn($this->_tableName, 'visible', $this->smallInteger(1)->defaultValue(0));
        $this->addColumn($this->_tableName, 'locked', $this->smallInteger(1)->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn($this->_tableName, 'locked');
        $this->dropColumn($this->_tableName, 'visible');
        $this->dropColumn($this->_tableName, 'required');
    }
}
