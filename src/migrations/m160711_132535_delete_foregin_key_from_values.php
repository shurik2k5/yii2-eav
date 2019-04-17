<?php

use shurik2k5\eav\migrations\EavMigrationTrait;
use yii\db\Migration;

class m160711_132535_delete_foregin_key_from_values extends Migration
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
        $this->dropForeignKey(
            $this->getForeignKeyName('optionId'),
            $this->_tableName
        );

        $this->dropIndex(
            $this->getIndexName('optionId'),
            $this->_tableName
        );
        
        $this->dropForeignKey(
            $this->getForeignKeyName('entityId'),
            $this->_tableName
        );

        $this->dropIndex(
            $this->getIndexName('entityId'),
            $this->_tableName
        );
    }

    public function safeDown()
    {
        $this->addForeignKey(
            $this->getForeignKeyName('optionId'),
            $this->_tableName,
            'optionId',
            $this->tables['option'],
            'id',
            'CASCADE',
            'NO ACTION'
        );
        
        $this->addForeignKey(
            $this->getForeignKeyName('entityId'),
            $this->_tableName,
            'entityId',
            $this->tables['entity'],
            'id',
            'CASCADE',
            'NO ACTION'
        );
    }
}
