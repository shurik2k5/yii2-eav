<?php

use shurik2k5\eav\migrations\EavMigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation for table `table_eav_attribute_rules`.
 */
class m160501_124615_create_table_eav_attribute_rules extends Migration
{
    use EavMigrationTrait;

    public function init()
    {
        parent::init();
        $this->initMigrationParams();
        $this->_tableName = $this->tables['rules'];
    }
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $options = null;
        if ($this->db->driverName === 'mysql') {
            $options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable($this->_tableName, [
            'id' => $this->primaryKey(),
            'attributeId' => $this->integer(11)->defaultValue(0),
            'rules' => $this->text()->defaultValue(''),
        ], $options);

        $this->addForeignKey(
            $this->getForeignKeyName('attributeId'),
            $this->_tableName,
            'attributeId',
            $this->tables['attribute'],
            'id',
            'CASCADE',
            'NO ACTION'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->_tableName);
    }
}
