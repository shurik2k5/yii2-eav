<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 30.04.15
 * Time: 1:25
 */

use Codeception\Util\Debug;
use \mazurva\eav\models\EavAttribute;

class BehaviorTest extends \yii\codeception\TestCase
{
    public $appConfig = '@tests/unit/_config.php';

    public static function setUpBeforeClass()
    {
        if (!extension_loaded('pdo') || !extension_loaded('pdo_sqlite')) {
            static::markTestSkipped('PDO and SQLite extensions are required.');
        }
    }


    public function setUp()
    {
        $this->mockApplication(require(Yii::getAlias($this->appConfig)));
    }

    public function tearDown()
    {
        //data\Post::deleteAll();
        parent::tearDown();
    }

    private function dataAttr()
    {
        return [
            [
                'typeId' => 1,
                'categoryId' => 1,
                'name' => 'Name Attr 1',
                'label' => 'Attr 1',
                'defaultValue' => 'attr1',
                'entityModel' => data\EavEntity::className(),
                //'defaultOptionId' =>
                'required'=>false,
            ],
            [
                'typeId' => 2,
                'categoryId' => 2,
                'name' => 'Name Attr 2',
                'label' => 'Attr 2',
                'defaultValue' => 'attr2',
                'entityModel' => data\EavEntity::className(),
                //'defaultOptionId' =>
                'required'=>false,
            ],
            [
                'typeId' => 3,
                'categoryId' => 3,
                'name' => 'Name Attr 3',
                'label' => 'Attr 3',
                'defaultValue' => 'attr3',
                'entityModel' => data\EavEntity::className(),
                //'defaultOptionId' =>
                'required'=>false,
            ]
        ];
    }

    public function testCreateAttributes()
    {
        foreach($this->dataAttr() as $values)
        {
            $attr = new EavAttribute();
            $attr->load($values);
            $attr->save();
        }

        $this->assertEquals(EavAttribute::find()->count(), 3);
    }
} 