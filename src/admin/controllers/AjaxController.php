<?php

namespace mirocow\eav\admin\controllers;

use mirocow\eav\models\EavAttribute;
use mirocow\eav\models\EavAttributeType;
use mirocow\eav\models\EavAttributeSearch;

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
       
       if($payload = Yii::$app->request->post('payload')){
         
         $payload = Json::decode($payload);
         
         $i = 1;
         
       }
       
     }
  }
  
}  