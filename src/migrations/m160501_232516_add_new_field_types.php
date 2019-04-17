<?php

use shurik2k5\eav\handlers\ValueHandler;
use shurik2k5\eav\migrations\EavMigrationTrait;
use yii\db\Migration;

class m160501_232516_add_new_field_types extends Migration
{
    use EavMigrationTrait;

    public function init()
    {
        parent::init();
        $this->initMigrationParams();
        $this->_tableName = $this->tables['attribute_type'];
    }

    public function safeUp()
    {

        $this->insert($this->_tableName, [
            'name' => 'numeric',
            'storeType' => ValueHandler::STORE_TYPE_RAW,
            'handlerClass' => '\shurik2k5\eav\widgets\NumericInput',
        ]);
    }

    public function safeDown()
    {
        $this->delete($this->_tableName, ['name' => 'numeric']);
    }
}
