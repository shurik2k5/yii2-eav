<?php

use shurik2k5\eav\handlers\ValueHandler;
use shurik2k5\eav\migrations\EavMigrationTrait;
use yii\db\Migration;

class m150821_133232_init extends Migration
{
    use EavMigrationTrait;

    public $attributeTypes = [];

    public function init()
    {
        $this->initMigrationParams();

        $this->attributeTypes = [
            [
                'name' => 'text',
                'storeType' => ValueHandler::STORE_TYPE_RAW,
                'handlerClass' => '\shurik2k5\eav\widgets\TextInput',
            ],
            [
                'name' => 'option',
                'storeType' => ValueHandler::STORE_TYPE_OPTION,
                'handlerClass' => '\shurik2k5\eav\widgets\DropDownList',
            ],
            [
                'name' => 'checkbox',
                'storeType' => ValueHandler::STORE_TYPE_MULTIPLE_OPTIONS,
                'handlerClass' => '\shurik2k5\eav\widgets\CheckBoxList',
            ],
            [
                'name' => 'array',
                'storeType' => ValueHandler::STORE_TYPE_ARRAY,
                'handlerClass' => '\shurik2k5\eav\widgets\EncodedTextInput',
            ],
            [
                'name' => 'radio',
                'storeType' => ValueHandler::STORE_TYPE_OPTION,
                'handlerClass' => '\shurik2k5\eav\widgets\RadioList',
            ],
            [
                'name' => 'area',
                'storeType' => ValueHandler::STORE_TYPE_RAW,
                'handlerClass' => '\shurik2k5\eav\widgets\Textarea',
            ],
        ];
    }

    public function safeUp()
    {
        $options = $this->db->driverName == 'mysql'
            ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB'
            : null;

        $this->createTable($this->tables['entity'], [
            'id' => $this->primaryKey(11),
            'entityName' => $this->string(50),
            'entityModel' => $this->string(100),
            'categoryId' => $this->integer(11),
        ], $options);

        $this->createTable($this->tables['attribute'], [
            'id' => $this->primaryKey(11),
            'entityId' => $this->integer(11)->defaultValue(null),
            'typeId' => $this->integer(11)->defaultValue(null),
            'type' => $this->string(50)->defaultValue(''),
            'name' => $this->string(255)->defaultValue('NULL'),
            'label' => $this->string(255)->defaultValue('NULL'),
            'defaultValue' => $this->string(255)->defaultValue('NULL'),
            'defaultOptionId' => $this->integer(11)->defaultValue(0),
            'description' => $this->string(255)->defaultValue('NULL'),
            'required' => $this->smallInteger(1)->defaultValue(0),
            'order' => $this->integer(11)->defaultValue(0),
        ], $options);

        $this->createTable($this->tables['attribute_type'], [
            'id' => $this->primaryKey(11),
            'name' => $this->string(255)->defaultValue('NULL'),
            'handlerClass' => $this->string(255)->defaultValue('NULL'),
            'storeType' => $this->smallInteger(6)->defaultValue(0),
        ], $options);

        $this->createTable($this->tables['value'], [
            'id' => $this->primaryKey(11),
            'entityId' => $this->integer(11)->defaultValue(0),
            'attributeId' => $this->integer(11)->defaultValue(0),
            'value' => $this->string(255)->defaultValue('NULL'),
            'optionId' => $this->integer(11)->defaultValue(0),
        ], $options);

        $this->createTable($this->tables['option'], [
            'id' => $this->primaryKey(11),
            'attributeId' => $this->integer(11)->defaultValue(0),
            'value' => $this->string(255)->defaultValue('NULL'),
            'defaultOptionId' => $this->smallInteger(1)->defaultValue(0),
        ], $options);

        $this->createIndex(
            $this->getIndexName('typeId', $this->tables['attribute']),
            $this->tables['attribute'],
            'typeId'
        );

        $this->createIndex(
            $this->getIndexName('entityId', $this->tables['attribute']),
            $this->tables['attribute'],
            'entityId'
        );

        $this->createIndex(
            $this->getIndexName('entityId', $this->tables['value']),
            $this->tables['value'],
            'entityId'
        );

        $this->createIndex(
            $this->getIndexName('attributeId', $this->tables['value']),
            $this->tables['value'],
            'attributeId'
        );

        $this->createIndex(
            $this->getIndexName('optionId', $this->tables['value']),
            $this->tables['value'],
            'optionId'
        );

        $this->createIndex(
            $this->getIndexName('attributeId', $this->tables['option']),
            $this->tables['option'],
            'attributeId'
        );

        if ($this->db->driverName != 'sqlite') {
            $this->addForeignKey(
                $this->getForeignKeyName('typeID', $this->tables['attribute']),
                $this->tables['attribute'],
                'typeId',
                $this->tables['attribute_type'],
                'id',
                'CASCADE',
                'NO ACTION'
            );

            $this->addForeignKey(
                $this->getForeignKeyName('entityId', $this->tables['attribute']),
                $this->tables['attribute'],
                'entityId',
                $this->tables['entity'],
                'id',
                'CASCADE',
                'NO ACTION'
            );

            $this->addForeignKey(
                $this->getForeignKeyName('entityId', $this->tables['value']),
                $this->tables['value'],
                'entityId',
                $this->tables['entity'],
                'id',
                'CASCADE',
                'NO ACTION'
            );

            $this->addForeignKey(
                $this->getForeignKeyName('attributeId', $this->tables['value']),
                $this->tables['value'],
                'attributeId',
                $this->tables['attribute'],
                'id',
                'CASCADE',
                'NO ACTION'
            );

            $this->addForeignKey(
                $this->getForeignKeyName('optionId', $this->tables['value']),
                $this->tables['value'],
                'optionId',
                $this->tables['option'],
                'id',
                'CASCADE',
                'NO ACTION'
            );

            $this->addForeignKey(
                $this->getForeignKeyName('attributeId', $this->tables['option']),
                $this->tables['option'],
                'attributeId',
                $this->tables['attribute'],
                'id',
                'CASCADE',
                'NO ACTION'
            );
        }

        foreach ($this->attributeTypes as $columns) {
            $this->insert($this->tables['attribute_type'], $columns);
        }
    }

    public function safeDown()
    {
        if ($this->db->driverName != 'sqlite') {
            $this->dropForeignKey($this->getForeignKeyName('typeID', $this->tables['attribute']), $this->tables['attribute']);
            $this->dropForeignKey($this->getForeignKeyName('entityId', $this->tables['attribute']), $this->tables['attribute']);
            $this->dropForeignKey($this->getForeignKeyName('entityId', $this->tables['value']), $this->tables['value']);
            $this->dropForeignKey($this->getForeignKeyName('attributeId', $this->tables['value']), $this->tables['value']);
            $this->dropForeignKey($this->getForeignKeyName('optionId', $this->tables['value']), $this->tables['value']);
            $this->dropForeignKey($this->getForeignKeyName('attributeId', $this->tables['option']), $this->tables['option']);
        }

        $this->dropTable($this->tables['attribute']);
        $this->dropTable($this->tables['attribute_type']);
        $this->dropTable($this->tables['value']);
        $this->dropTable($this->tables['option']);
        $this->dropTable($this->tables['entity']);
    }
}
