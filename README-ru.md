EAV Dynamic Attributes for Yii2

Архитектура баз данных EAV(Enity-Attribute-Value, Сущность-Атрибут-Значение)

### Установка
При помощи композера устанавливаем расширение
```
php composer.phar require --prefer-dist "mirocow/yii2-eav" "*"
```
далее выполняем миграции
```
php ./yii migrate/up -p=@mirocow/eav/migrations
```
добавляем настройки сообщений расширения в основной конфиг

``` php
		'i18n' => [
				'translations' => [
						'app*' => [
								'class' => 'yii\i18n\PhpMessageSource',
								//'basePath' => '@app/messages',
								//'sourceLanguage' => 'en-US',
								'fileMap' => [
										'app'       => 'app.php',
										'app/error' => 'error.php',
								],
						],
						'eav' => [
								'class' => 'yii\i18n\PhpMessageSource',
								'basePath' => '@mirocow/eav/messages',
						],
				],
		]
```
### Использование 
Добавляем в модель поведение, которое расширяет ее возможности методами данного расширения

``` php
.........
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

.........
```


