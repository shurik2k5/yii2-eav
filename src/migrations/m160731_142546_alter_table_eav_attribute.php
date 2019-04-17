<?php

use shurik2k5\eav\migrations\EavMigrationTrait;
use yii\db\Migration;

class m160731_142546_alter_table_eav_attribute extends Migration
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
        $this->addColumn($this->_tableName, 'categoryId', $this->integer(11)->null());
    }

    public function safeDown()
    {
        $this->dropColumn($this->_tableName, 'categoryId');
    }
}
