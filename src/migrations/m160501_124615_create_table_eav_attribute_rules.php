<?php

use yii\db\Migration;

/**
 * Handles the creation for table `table_eav_attribute_rules`.
 */
class m160501_124615_create_table_eav_attribute_rules extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%eav_attribute_rules}}', [
            'id' => $this->primaryKey(),
            'attributeId' => $this->integer(11)->defaultValue(0),
            'rules' => $this->text()->defaultValue('[]'),
        ]);

        $this->addForeignKey('FK_Rules_attributeId',
            '{{%eav_attribute_rules}}', 'attributeId', '{{%eav_attribute}}', 'id', "CASCADE", "NO ACTION");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('eav_attribute_rules');
    }
}
