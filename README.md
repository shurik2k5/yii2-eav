EAV Dynamic Attributes for Yii2
========



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
php yii migrate/up --migrationPath=@eav/migrations
```

Usage
-----
Attach behaviour to your model
```
  public function behaviors()
  {
      return [
          'eav' => [
              'class' => EavBehavior::className(),
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
<?=$form->field($model,'eav')->dropDownList(['1' => '10', '2' => '20']); ?>
```
