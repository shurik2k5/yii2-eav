<?php

namespace mirocow\eav\admin\controllers;

use mirocow\eav\models\EavAttribute;
use mirocow\eav\models\EavAttributeType;
use mirocow\eav\models\EavAttributeSearch;
use mirocow\eav\models\EavAttributeOption;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * AttributeController implements the CRUD actions for EavAttribute model.
 */
class AjaxController extends Controller
{
  
  public function actionIndex()
  {
    Yii::$app->response->format = 'json';
    
    $status = 'false';
    
    $attribuites = [];
    
    $types = EavAttributeType::find()->all();
    
    if($types){
      foreach($types as $type){
        $attribuites[$type->name] = $type->attributes;
        $attribuites[$type->name]['formBuilder'] = $type->formBuilder;
      }
      
      $status = 'success';
    }
    
    return ['status' => $status, 'types' => $attribuites];
  }
  
  public function actionSave()
  {
     if(Yii::$app->request->isPost){
       
       $post = Yii::$app->request->post();
       
       if($post['payload'] && $post['id'] && $post['entityModel']){
         
         $payload = Json::decode($post['payload']);
         
         if(!isset($payload['fields'])) return;
         
         foreach($payload['fields'] as $order => $field){
           
           list($entityId, $attributeId) = explode('-', $field['cid']);
           
           $attribute = EavAttribute::findOne(['id' => $attributeId, 'entityId' => $entityId]);
           if(!$attribute){
              $attribute = new EavAttribute;
              $lastId = (int) EavAttribute::find()->select(['id'])->orderBy(['id' => SORT_DESC])->limit(1)->scalar() + 1;
              $attribute->name = 'field' . $lastId;
           }
           $attribute->entityId = $entityId;
           $attribute->typeId = EavAttributeType::find()->select(['id'])->where(['name' => $field['field_type']])->scalar();            
           $attribute->label = $field['label'];
           //$attribute->defaultValue = '';
           //$attribute->defaultOptionId = 0;
           $attribute->required = $field['required'];
           $attribute->order = $order;
           $attribute->save(false);
                      
           if(!isset($field['field_options']['options'])) continue;
             
           EavAttributeOption::deleteAll(['attributeId' => $attributeId]);
           
           foreach($field['field_options']['options'] as $o){
              $option = new EavAttributeOption;
              $option->attributeId = $attribute->id;
              $option->value = $o['label'];
              $option->save();
           }
           
         }
         
       }
       
     }
  }
  
}  