<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace lagman\eav\migrations;
use yii\db\Migration;

abstract class InsertDataMigration extends Migration {
    
    public $insertData = [];
    
    public function safeUp() {
        foreach ($this->insertData as $table => $data) {
            foreach ($data as $columns) {
                $this->insert($table, $columns);
            }    
        }
    }
    
    public function safeDown() {
        
        foreach ($this->insertData as $table => $data) {
            foreach ($data as $id => $columns) {
                $this->delete($table, ['id' => $id]);
            }    
        }
    }
}
