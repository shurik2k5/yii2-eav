EAV Atributos Dinamicos para Yii2
========
EAV(Enity-Attribute-Value)
Tomado del trabajo de mirocow

# Screenshots

## Edit attributes

### List of attributes

![](http://images.mirocow.com/2016-05-02-23-29-39-3hcha.png)

### Edit attribute

![](http://images.mirocow.com/2016-05-02-23-39-41-5ih6u.png)

## Edit form

![](http://images.mirocow.com/2016-05-02-23-32-34-m98o1.png)

## Active field rules

![](https://3.downloader.disk.yandex.ru/disk/10a3a56403c2e68fb7015558a5726e77f55997e297a5bb10a049c2310e958adb/579e3f2e/7Uq-nT7n8J_UvagtYjGAdVJy-672zFbMtuTz_nljHO3WGxqO97gRtqBPi2MhYlZNqPVxmnju-Ql7kYbAYo_30w%3D%3D?uid=0&filename=2016-07-31_17-09-39.png&disposition=inline&hash=&limit=0&content_type=image%2Fpng&fsize=44963&hid=fa2fbf41997fff40765a1776174712e8&media_type=image&tknv=v2&etag=d0e3447225f0d4757107744f9774ba28)

# Install

## Add github repository

```json
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/blacksesion/yii2-eav.git"
        }
    ]
```
and then

```
php composer.phar require --prefer-dist "blacksesion/yii2-eav" "*"
```

## Configure

``` sh
php ./yii migrate/up -p=@blacksesion/eav/migrations
```

or

``` sh
php ./yii migrate/up -p=@vendor/blacksesion/yii2-eav/src/migrations
```

## Use

### Model

#### Simple

``` php
class Product extends \yii\db\ActiveRecord
{

    /**
     *
     *
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255], // Product field
            [['c1'], 'required'], // Attribute field
            [['c1'], 'string', 'max' => 255], // Attribute field
        ];
    }
    
    /**
     * create_time, update_time to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            'eav' => [
                'class' => \blacksesion\eav\EavBehavior::className(),
                'valueClass' => \blacksesion\eav\models\EavAttributeValue::className(),
            ]           
        ];
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
        return \blacksesion\eav\models\EavAttribute::find()
          ->joinWith('entity')
          ->where([
            'categoryId' => $this->categories[0]->id,
            'entityModel' => $this::className()
        ]);
    }
    
}
```

#### Advanced

``` php
class Product extends \yii\db\ActiveRecord
{

    /**
     *
     *
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255], // Product field
            [['c1'], 'required'], // Attribute field
            [['c1'], 'string', 'max' => 255], // Attribute field
        ];
    }

    /**
     * create_time, update_time to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            'eav' => [
                'class' => \blacksesion\eav\EavBehavior::className(),
                'valueClass' => \blacksesion\eav\models\EavAttributeValue::className(),
            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes($attributes = [])
    {
        return \blacksesion\eav\models\EavAttribute::find()
          ->joinWith('entity')
          ->where([
            //'categoryId' => $entityId,
            'entityModel' => $this::className()
        ])->andWhere($attributes);
    }

}

### View

Insert this code for create widget or load all EAV inputs fields for model

### Form edit

fo load selected field 

``` php
    <?=$form->field($model,'test5', ['class' => '\blacksesion\eav\widgets\ActiveField'])->eavInput(); ?>
```
or for load all fields

#### Simple

``` php
    <?php
    foreach($model->getEavAttributes()->all() as $attr){
        echo $form->field($model, $attr->name, ['class' => '\blacksesion\eav\widgets\ActiveField'])->eavInput();
    }        
    ?>
```

or add sorted


``` php
    <?php
    foreach($model->getEavAttributes()->orderBy(['order' => SORT_ASC])->all() as $attr){
        echo $form->field($model, $attr->name, ['class' => '\blacksesion\eav\widgets\ActiveField'])->eavInput();
    }
    ?>
```

### Advanced

``` php
    <?php
    foreach($model->getEavAttributes(['entityId' => 8, 'typeId' => 3])->all() as $attr){
        echo $form->field($model, $attr->name, ['class' => '\blacksesion\eav\widgets\ActiveField'])->eavInput();
    }
    ?>
```

### Partial template

``` php
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

### Add attribute

```php
$attr = new blacksesion\eav\models\EavAttribute();
$attr->attributes = [
        'entityId' => 1, // Category ID
        'name' => 'AttrCategory1',  // service name field
        'label' => 'Attr1',         // label text for form
        'defaultValue' => 'attr1',  // default value
        'entityModel' => SampleModel::className(), // work model
        'required'=>false           // add rule "required field"
    ];
$attr->save();
```

## Administrate GUI

## Config module EAV for managment of fields
In main config file:
```php
$modules = [
    ...,
    'eav' => [
        'class' => 'blacksesion\eav\Module',
    ],
];
```

## Form


## Add / Edit attribute


``` php
<?= \blacksesion\eav\admin\widgets\Fields::widget([
                      'model' => $model,
                      'categoryId' => $model->id,
                      'entityName' => 'Entidad',
                      'entityModel' => 'common\models\Product',
                  ])?>
```
