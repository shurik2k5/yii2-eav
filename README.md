EAV Dynamic Attributes for Yii2
========

[![Latest Stable Version](https://poser.pugx.org/mirocow/yii2-eav/v/stable)](https://packagist.org/packages/mirocow/yii2-eav) [![Latest Unstable Version](https://poser.pugx.org/mirocow/yii2-eav/v/unstable)](https://packagist.org/packages/mirocow/yii2-eav) [![Total Downloads](https://poser.pugx.org/mirocow/yii2-eav/downloads)](https://packagist.org/packages/mirocow/yii2-eav) [![License](https://poser.pugx.org/mirocow/yii2-eav/license)](https://packagist.org/packages/mirocow/yii2-eav)
[![Join the chat at https://gitter.im/Mirocow/yii2-eav](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/Mirocow/yii2-eav?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Архитектура баз данных EAV(Enity-Attribute-Value, Сущность-Атрибут-Значение)
=======

Install
========

### Add github repository

```json
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/mirocow/yii2-eav.git"
        }
    ]
```
and then

```
php composer.phar require --prefer-dist "mirocow/yii2-eav" "*"
```

Configure
========

``` sh
php yii migrate/up --migrationPath=@mirocow/eav/migrations
```

or

``` sh
php yii migrate/up --migrationPath=vendor/mirocow/yii2-eav/src/migrations
```

Use
========

Model
=======

``` php
class Product extends \yii\db\ActiveRecord
{

    use EavTrait;
    
    /**
     * create_time, update_time to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            'eav' => [
                'class' => \mirocow\eav\EavBehavior::className(),
                // это модель для таблицы object_attribute_value
                'valueClass' => \mirocow\eav\models\EavAttributeValue::className(),
            ]           
        ];
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {       
        return \mirocow\eav\models\EavAttribute::find()
          ->joinWith('entity')
          ->where([
            'categoryId' => isset()? $this->category->id: 0,
            'entityModel' => $this::className()
        ]);  
    }
    
}
```

View
=======

Insert this code for create widget or load all EAV inputs fields for model

Form
======

fo load selected field 

``` html
    <?=$form->field($model,'test5', ['class' => '\mirocow\eav\widgets\ActiveField'])->eavInput(); ?>
```
or for load all fields

``` html
    <?php
    foreach($model->getEavAttributes()->all() as $attr){
        echo $form->field($model, $attr->name, ['class' => '\mirocow\eav\widgets\ActiveField'])->eavInput();
    }        
    ?>
```

Partial template
======

``` html
<p>
Encode

<?php
  foreach($model->getEavAttributes()->all() as $attr){
    print_r($model[$attr->name]['value']);
  }
?>
</p> 

<p>
String

<?php
  foreach($model->getEavAttributes()->all() as $attr){
    echo $model[$attr->name];
  }
?> 
```

Administrate GUI
========

![](https://leto11e.storage.yandex.net/rdisk/ea7a2991d3fe6c8bbcd3e0dcad7465a0e27c6873d849018c4a97045c106af450/inf/I2_HSvy0rl4zZnRWw23cDzVCCdCGCscflHsesyE_019vyeFyKxP5r-9ZqUgmd7CxPrZeKYt1aF9KOBNwHDqKLw==?uid=0&filename=2015-10-23%2017-21-51%20admin.jiajiayoupin.loc%20eav%20-%20Google%20Chrome.png&disposition=inline&hash=&limit=0&content_type=image%2Fpng&tknv=v2&rtoken=c8232271c6f3b63bd82fe2d7bfd172c5&force_default=no&ycrid=na-d57c811c7608fb4f1b727503f1204614-downloader9g)
                  
Form
======

Add / Edit attribute
=====

``` html
<?= \mirocow\eav\admin\widgets\Fields::widget([
                      'model' => $model,
                      'categoryId' => $model->id,
                      'entityName' => 'Продукт',
                      'entityModel' => 'common\models\Product',
                  ])?>
```
