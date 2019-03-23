<?php

use mirocow\eav\migrations\EavMigrationTrait;
use yii\db\Migration;

class m160501_014209_add_column_order_into_option extends Migration
{
    use EavMigrationTrait;

    public function init()
    {
        parent::init();
        $this->initMigrationParams();
        $this->_tableName = $this->tables['option'];
    }

    public function up()
    {
        $this->addColumn($this->_tableName, 'order', $this->integer(11)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn($this->_tableName, 'order');
    }
}
