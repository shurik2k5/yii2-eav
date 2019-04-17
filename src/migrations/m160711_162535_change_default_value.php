<?php

use shurik2k5\eav\migrations\EavMigrationTrait;
use yii\db\Migration;

class m160711_162535_change_default_value extends Migration
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
        $this->alterColumn($this->_tableName, 'description', $this->string(255));
    }

    public function safeDown()
    {
        $this->alterColumn($this->_tableName, 'description', $this->string(255));
    }
}
