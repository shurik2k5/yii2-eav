yii2-eav
========

EAV Dynamic Attributes for Yii2

[![Latest Stable Version](https://poser.pugx.org/mirocow/yii2-eav/v/stable)](https://packagist.org/packages/mirocow/yii2-eav) [![Latest Unstable Version](https://poser.pugx.org/mirocow/yii2-eav/v/unstable)](https://packagist.org/packages/mirocow/yii2-eav) [![Total Downloads](https://poser.pugx.org/mirocow/yii2-eav/downloads)](https://packagist.org/packages/mirocow/yii2-eav) [![License](https://poser.pugx.org/mirocow/yii2-eav/license)](https://packagist.org/packages/mirocow/yii2-eav)

![](https://leto37g.storage.yandex.net/rdisk/39e002d318fd33be41970b967b4303c37a1f4b16403d63682ab886d651ce802a/inf/Hog8_iKY1Wf6sUzNXwwgMSF5sTcPdaFgbR-Kev1KBV5sArQFlpqATaNEgJIrClgwB4eC4zSs9Zb6gn5qKFu2og==?uid=0&filename=2015-10-20%2019-27-25%20Update%20Product%20%D0%93%D0%B5%D0%BD%D0%B5%D1%80%D0%B0%D1%82%D0%BE%D1%80%201%20-%20Google%20Chrome.png&disposition=inline&hash=&limit=0&content_type=image%2Fpng&tknv=v2&rtoken=59fdb448c386267c139e95574b212b70&force_default=no&ycrid=na-867e638af3256a70a221ab782049b1dc-downloader5g)

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
