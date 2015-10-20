yii2-eav
========

EAV Dynamic Attributes for Yii2

[![Latest Stable Version](https://poser.pugx.org/mirocow/yii2-eav/v/stable)](https://packagist.org/packages/mirocow/yii2-eav) [![Latest Unstable Version](https://poser.pugx.org/mirocow/yii2-eav/v/unstable)](https://packagist.org/packages/mirocow/yii2-eav) [![Total Downloads](https://poser.pugx.org/mirocow/yii2-eav/downloads)](https://packagist.org/packages/mirocow/yii2-eav) [![License](https://poser.pugx.org/mirocow/yii2-eav/license)](https://packagist.org/packages/mirocow/yii2-eav)

![](https://yadi.sk/i/6CkmwnDZjsdGe)

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
php yii migrate/up --migrationPath=@eav/migrations
```

Use
========

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
            //'categoryId' => $this->category->id,
            'entityModel' => $this::className()
        ]);  
    }
    
}
```
