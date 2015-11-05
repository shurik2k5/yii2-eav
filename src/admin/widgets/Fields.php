<?php

namespace mirocow\eav\admin\widgets;

use mirocow\eav\models\EavAttribute;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

class Fields extends Widget
{
    public $url = ['eav/admin/ajax/index'];
    
    public $urlSave = ['eav/admin/ajax/save'];
    
    public $model;
    
    public $entityModel;
    
    public $options = [];
    
    private $bootstrapData = [];
    
    public function init()
    {
        parent::init();
        
        $this->url = Url::to($this->url);
        
        $this->urlSave = Url::to($this->urlSave);
        
        foreach($this->model->getEavAttributes()->all() as $attr) {
          
            $options = [];
            
            foreach($attr->eavOptions as $option){
              $options['options'][] = [
                'label' => $option->value,
                'checked' => false,
              ];
            }
          
            $this->bootstrapData[] = [
              'label' => $attr->label,
              'field_type' => $attr->eavType->name,
              'required' => $attr->required,
              'field_options' => $options,
              'cid' => $attr->entityId . '-' . $attr->id,
            ];
           
        }
        
        $this->bootstrapData = Json::encode($this->bootstrapData);
    }

    public function run()
    {
        return $this->render('fields', [
          'url' => $this->url,
          'urlSave' => $this->urlSave,
          'options' => $this->options,
          'id' => $this->model->id,
          'entityModel' => $this->entityModel? $this->entityModel: $this->model->className(),
          'bootstrapData' => $this->bootstrapData,
        ]);
    }
}