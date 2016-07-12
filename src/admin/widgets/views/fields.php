<?php

use mirocow\eav\admin\assets\FbAsset;
use mirocow\eav\admin\assets\I18NextAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
FbAsset::register($this);
I18NextAsset::register($this);
?>

    <div class="form-builder fb-main">
    </div>
<?php
$language = Yii::$app->language;
$this->registerJs("i18n.init({ lng: '$language', resGetPath: '/locales/__lng__/__ns__.json', fallbackLng: 'en' });", yii\web\View::POS_READY, 'js_form_builder');

$js_form_builder = <<<JS
  $(function(){
  
    fb = new Formbuilder({
      uri: '$url',
      selector: '.fb-main',
      bootstrapData: '$bootstrapData'
    });

    fb.on('save', function(payload){
      $.ajax({
        url: '$urlSave',
        type: 'post',
        data: {
          categoryId: $categoryId, 
          entityModel: '$entityModel', 
          entityName: '$entityName', 
          payload: payload, _csrf: yii.getCsrfToken()
        },        
        dataType: 'json',
      }).success(function(response) {
      });
    });
    
  });
JS;

$this->registerJs($js_form_builder, yii\web\View::POS_READY, 'js_form_builder');
?>