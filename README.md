EAV Dynamic Attributes for Yii2
========

[![Build Status](https://travis-ci.org/mazurva/yii2-eav.svg?branch=master)](https://travis-ci.org/mazurva/yii2-eav)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

``` sh
php composer.phar require --prefer-dist mazurva/yii2-eav "dev-master"
```

or add

```
"mazurva/yii2-eav": "dev-master"
```

to the require section of your `composer.json` file.

``` sh
php yii migrate/up --migrationPath=@vendor/mazurva/yii2-eav/src/migrations
```

Usage
-----
Attach behaviour to your model
```
  use EavTrait; // need for full support label of fields

  public function behaviors()
  {
      return [
          'eav' => [
              'class' => mazurva\eav\EavBehavior::className(),
              'valueClass' => ObjectAttributeValue::className(), // this model for table object_attribute_value
          ]
      ];
  }
  
  /**
   * @return \yii\db\ActiveQuery
   */
  public function getEavAttributes()
  {
      return $this->hasMany(ObjectAttribute::className(), ['categoryId' => 'id']);
  }
```

Sample use in view:

```
<?=$form->field($model->getBehavior('eav'),'eav2'); ?>
```
