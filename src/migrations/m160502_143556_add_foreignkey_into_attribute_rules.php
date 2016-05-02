<?php

use yii\db\Migration;

class m160502_143556_add_foreignkey_into_attribute_rules extends Migration
{
    public function up()
    {

        $this->addForeignKey('FK_Rules_attributeId',
            '{{%eav_attribute_rules}}', 'attributeId', '{{%eav_attribute}}', 'id', "CASCADE", "NO ACTION");

    }

    public function down()
    {
        $this->dropForeignKey('FK_Rules_attributeId', '{{%eav_attribute_rules}}');
    }

}
