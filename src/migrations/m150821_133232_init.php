<?php

namespace mirocow\eav;

use yii\db\Migration;
use yii\db\Schema;
use mirocow\eav\interfaces\AttributeTypeInterface;
use mirocow\eav\ValueHandler;

class m150821_133232_init extends Migration
{

    public $tables;
    public $entityName = 'eav';
    public $useEntity = true;
    
    public $attributeTypes = [];
    
    public function init()
    {
        if (!$entityName = $this->entityName) {
            throw new \yii\console\Exception("Entity name must be set for EAV migration");
        }
        
        $this->tables = [
            'category' => "{{%{$entityName}_category}}",
            'entity' => "{{%{$entityName}}}",
            'attribute' => "{{%{$entityName}_attribute}}",
            'attribute_type' => "{{%{$entityName}_attribute_type}}",
            'value' => "{{%{$entityName}_attribute_value}}",
            'option' => "{{%{$entityName}_attribute_option}}",
        ];
            
        $this->attributeTypes = [
            [
                'id' => AttributeTypeInterface::TYPE_RAW, 
                'name' => 'raw', 
                'storeType' => ValueHandler::STORE_TYPE_RAW, 
                'handlerClass' => '\mirocow\eav\inputs\TextInput',
            ],
            [
                'id' => AttributeTypeInterface::TYPE_ARRAY, 
                'name' => 'array', 
                'storeType' => ValueHandler::STORE_TYPE_ARRAY, 
                'handlerClass' => '\mirocow\eav\inputs\EncodedTextInput',
            ],
            [
                'id' => AttributeTypeInterface::TYPE_OPTION, 
                'name' => 'option', 
                'storeType' => ValueHandler::STORE_TYPE_OPTION, 
                'handlerClass' => '\mirocow\eav\inputs\DropDownList',
            ],
            [
                'id' => AttributeTypeInterface::TYPE_MULTIPLE_OPTIONS, 
                'name' => 'multiple', 
                'storeType' => ValueHandler::STORE_TYPE_MULTIPLE_OPTIONS, 
                'handlerClass' => '\mirocow\eav\inputs\EncodedTextInput',
            ],
        ];
    }

    public function safeUp()
    {
        $options = $this->db->driverName == 'mysql' 
                 ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' 
                 : null;

        if ($this->useEntity) {
            $this->createTable($this->tables['entity'], [
                'id' => Schema::TYPE_PK,
                'categoryId' => Schema::TYPE_INTEGER,
            ], $options);
        }
        
        $this->createTable($this->tables['category'], [
            'id' => Schema::TYPE_PK,
//            'seoName' => Schema::TYPE_STRING,
            'name' => Schema::TYPE_STRING,
        ], $options);

        $this->createTable($this->tables['attribute'], [
            'id' => Schema::TYPE_PK,
            'categoryId' => Schema::TYPE_INTEGER,
            'typeId' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING,
            'defaultValue' => Schema::TYPE_STRING,
            'defaultOptionId' => Schema::TYPE_INTEGER,
            'required' => Schema::TYPE_BOOLEAN . ' DEFAULT 1',
        ], $options);

        $this->createTable($this->tables['attribute_type'], [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'handlerClass' => Schema::TYPE_STRING,
            'storeType' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
        ], $options);

        $this->createTable($this->tables['value'], [
            'id' => Schema::TYPE_PK,
            'entityId' => Schema::TYPE_INTEGER. ' NOT NULL',
            'attributeId' => Schema::TYPE_INTEGER. ' NOT NULL',
            'value' => Schema::TYPE_STRING,
            'optionId' => Schema::TYPE_INTEGER,
        ], $options);

        $this->createTable($this->tables['option'], [
            'id' => Schema::TYPE_PK,
            'attributeId' => Schema::TYPE_INTEGER,
            'value' => Schema::TYPE_STRING,
        ], $options);

        $this->addForeignKey('FK_Entity_categoryId', $this->tables['entity'], 'categoryId', $this->tables['category'], 'id', "CASCADE", "NO ACTION");
        $this->addForeignKey('FK_Attribute_categoryId', $this->tables['attribute'], 'categoryId', $this->tables['category'], 'id', "CASCADE", "NO ACTION");
        $this->addForeignKey('FK_Attribute_typeId', $this->tables['attribute'], 'typeId', $this->tables['attribute_type'], 'id', "CASCADE", "NO ACTION");
        $this->addForeignKey('FK_Attribute_defaultOptionId', $this->tables['attribute'], 'defaultOptionId', $this->tables['option'], 'id', "CASCADE", "NO ACTION");
        $this->addForeignKey('FK_Value_entityId', $this->tables['value'], 'entityId', $this->tables['entity'], 'id', "CASCADE", "NO ACTION");
        $this->addForeignKey('FK_Value_attributeId', $this->tables['value'], 'attributeId', $this->tables['attribute'], 'id', "CASCADE", "NO ACTION");
        $this->addForeignKey('FK_Value_optionId', $this->tables['value'], 'optionId', $this->tables['option'], 'id', "CASCADE", "NO ACTION");
        $this->addForeignKey('FK_Option_attributeId', $this->tables['option'], 'attributeId', $this->tables['attribute'], 'id', "CASCADE", "NO ACTION");
        
        
        foreach ($this->attributeTypes as $columns) {
            $this->insert($this->tables['attribute_type'], $columns);
        }
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_Entity_categoryId', $this->tables['entity']);
        $this->dropForeignKey('FK_Attribute_categoryId', $this->tables['attribute']);
        $this->dropForeignKey('FK_Attribute_typeId', $this->tables['attribute']);
        $this->dropForeignKey('FK_Attribute_defaultOptionId', $this->tables['attribute']);
        $this->dropForeignKey('FK_Value_entityId', $this->tables['value']);
        $this->dropForeignKey('FK_Value_attributeId', $this->tables['value']);
        $this->dropForeignKey('FK_Value_optionId', $this->tables['value']);
        $this->dropForeignKey('FK_Option_attributeId', $this->tables['option']);

        if ($this->useEntity) {
            $this->dropTable($this->tables['entity']);
        }
        
        $this->dropTable($this->tables['category']);
        $this->dropTable($this->tables['attribute']);
        $this->dropTable($this->tables['attribute_type']);
        $this->dropTable($this->tables['value']);
        $this->dropTable($this->tables['option']);
    }
    
}
