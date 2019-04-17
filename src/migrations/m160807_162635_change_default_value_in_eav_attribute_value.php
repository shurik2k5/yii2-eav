<?php

use shurik2k5\eav\migrations\EavMigrationTrait;
use yii\db\Migration;

class m160807_162635_change_default_value_in_eav_attribute_value extends Migration
{
    use EavMigrationTrait;

    public function init()
    {
        parent::init();
        $this->initMigrationParams();
        $this->_tableName = $this->tables['value'];
    }

    public function safeUp()
    {
        $this->alterColumn($this->_tableName, 'value', $this->text());
    }

    public function safeDown()
    {
        $this->alterColumn($this->_tableName, 'value', $this->string(255));
    }
}
