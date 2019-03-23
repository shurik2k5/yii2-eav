<?php

use yii\db\Migration;

class m160818_102815_add_entityId_index_in_eav_attribute_value extends Migration
{
    public $tableName = '{{%eav_attribute_value}}';

    public function up()
    {
        $this->createIndex('idx_eav_attribute_value_entityId', $this->tableName, 'entityId');
    }

    public function down()
    {
        $this->dropIndex('idx_eav_attribute_value_entityId', $this->tableName);
        return false;
    }
}
