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
в эту же модель добавляем 
``` php
		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getEavAttributes()
		{
				return \mirocow\eav\models\EavAttribute::find()
					->joinWith('entity')
					->where([
						//'categoryId' => $this->categories[0]->id,
						'entityModel' => $this::className()
				]);
		}
```		
C моделью закончили.

## Создание и редактирование атрибутов
### Создание атрибутов без админки
``` php
$attr = new mirocow\eav\models\EavAttribute();
$attr->attributes = [
				'entityId' => 1, // Category ID
				'typeId' => 1, // ID type from eav_attribute_type
				'name' => 'packing',  // service name field
				'label' => 'Packing',         // label text for form
				'defaultValue' => '10 kg',  // default value
				'entityModel' => Product::className(), // work model
				'required' => false           // add rule "required field"
		];
$attr->save();

$attr->attributes = [
				'entityId' => 1, // Category ID
				'typeId' => 1, // ID type from eav_attribute_type
				'name' => 'color',  // service name field
				'label' => 'Color',         // label text for form
				'defaultValue' => 'white',  // default value
				'entityModel' => Product::className(), // work model
				'required' => false           // add rule "required field"
		];
$attr->save();
```
