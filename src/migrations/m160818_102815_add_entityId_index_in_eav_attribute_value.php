<?php

use mirocow\eav\migrations\EavMigrationTrait;
use yii\db\Migration;

class m160818_102815_add_entityId_index_in_eav_attribute_value extends Migration
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
        $this->createIndex($this->getIndexName('entityId'), $this->_tableName, 'entityId');
    }

    public function safeDown()
    {
        $this->dropIndex($this->getIndexName('entityId'), $this->_tableName);
    }
}
