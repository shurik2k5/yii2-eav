<?php

use mirocow\eav\migrations\EavMigrationTrait;
use yii\db\Migration;

class m160501_234949_remove_column_required_from_attribute extends Migration
{
    use EavMigrationTrait;

    public function init()
    {
        parent::init();
        $this->initMigrationParams();
        $this->_tableName = $this->tables['attribute'];
    }

    public function safeUp()
    {
        $this->dropColumn($this->_tableName, 'required');
    }

    public function safeDown()
    {
        $this->addColumn($this->_tableName, 'required', $this->smallInteger(1)->defaultValue(0));
    }
}
