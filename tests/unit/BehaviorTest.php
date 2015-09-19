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
                'name' => 'AttrCategory1',
                'label' => 'Attr1',
                'defaultValue' => 'attr1',
                'entityModel' => data\EavEntity::className(),
                //'defaultOptionId' =>
                'required'=>false,
            ],
            [
                'typeId' => 2,
                'categoryId' => 2,
                'name' => 'AttrCategory2',
                'label' => 'Attr2',
                'defaultValue' => 'attr2',
                'entityModel' => data\EavEntity::className(),
                //'defaultOptionId' =>
                'required'=>false,
            ],
            [
                'typeId' => 3,
                'categoryId' => 3,
                'name' => 'AttrCategory3',
                'label' => 'Attr3',
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
            foreach($values as $key=>$value)
                $attr->$key = $value;
            $attr->save();
        }

        $this->assertEquals(EavAttribute::find()->count(), 3);
    }

    /**
     * @depends testCreateAttributes
     */
    public function testGetAttrFromEntity()
    {
        $entity = \data\EavEntity::find()->where(['id'=>1])->one();

        $this->assertEquals($entity->categoryId, 1);

        $this->assertEquals(1, count($entity->eavAttributes));
    }

    /**
     * @depends testCreateAttributes
     */
    public function testSetAttrValue()
    {
        $entity = \data\EavEntity::find()->where(['id'=>1])->one();
        $this->assertTrue($entity->getBehavior('eav')->canGetProperty('AttrCategory1'));

        $entity->getBehavior('eav')->AttrCategory1 = 'myValue';
        $entity->save();

        $this->assertEquals('myValue', $entity->getBehavior('eav')->AttrCategory1);

        $entity = \data\EavEntity::find()->where(['id'=>2])->one();
        $entity->getBehavior('eav')->AttrCategory2 = 'myValueNew';
        $entity->save();

        $entity = \data\EavEntity::find()->where(['id'=>1])->one();
        $this->assertEquals('myValue', $entity->getBehavior('eav')->AttrCategory1);
    }
} 