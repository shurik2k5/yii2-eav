yii2-eav
========

EAV Dynamic Attributes for Yii2

[![Latest Stable Version](https://poser.pugx.org/mirocow/yii2-eav/v/stable)](https://packagist.org/packages/mirocow/yii2-eav) [![Latest Unstable Version](https://poser.pugx.org/mirocow/yii2-eav/v/unstable)](https://packagist.org/packages/mirocow/yii2-eav) [![Total Downloads](https://poser.pugx.org/mirocow/yii2-eav/downloads)](https://packagist.org/packages/mirocow/yii2-eav) [![License](https://poser.pugx.org/mirocow/yii2-eav/license)](https://packagist.org/packages/mirocow/yii2-eav)

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
