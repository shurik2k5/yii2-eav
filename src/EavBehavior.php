<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mirocow\eav;

use mirocow\eav\EavModel;
use mirocow\eav\models\EavAttribute;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

/**
 * Class EavBehavior
 * @package mirocow\eav
 *
 * @mixin ActiveRecord
 * @property EavModel $eav;
 * @property ActiveRecord $owner
 */
class EavBehavior extends Behavior
{
    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT   => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE   => 'beforeSave',
            ActiveRecord::EVENT_AFTER_INSERT   => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE    => 'afterSave',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
                
    }
    
    /** @var array */
    public $valueClass;

    protected $EavModel;

    public function init()
    {
        assert(isset($this->valueClass));
    }

    /**
     * @return EavModel
     */
    public function __get($name = '')
    {
        if (!$this->EavModel instanceof EavModel) {
            $this->EavModel = EavModel::create([
                'entityModel' => $this->owner,
                'valueClass' => $this->valueClass,
                'attribute' => $name,
            ]);
        }
        return $this->EavModel;
    }      
    
    public function canGetProperty($name, $checkVars = true)
    {
        return EavAttribute::find()->where(['name' => $name])->exists();
    }    
    
    public function beforeValidate() {
        return $this->eav->validate();
    }
    
    public function beforeSave(){
      $i = 1;
    }
    
    public function afterSave() {
        $this->eav->save(false);
    }       
    
}