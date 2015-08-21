<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mirocow\eav;

use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

/**
 * Class EavBehavior
 * @package mirocow\eav
 *
 * @mixin ActiveRecord
 * @property DynamicModel $eav;
 * @property ActiveRecord $owner
 */
class EavBehavior extends Behavior
{
    public $fieldPrefix = 'eav';

    public function events() {
        return [
            ActiveRecord::EVENT_AFTER_INSERT   => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE    => 'afterSave',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
                
    }
    
    /** @var array */
    public $valueClass;

    protected $dynamicModel;

    public function init()
    {
        assert(isset($this->valueClass));
    }

    /**
     * @return DynamicModel
     */
    public function getEav()
    {
        if (!$this->dynamicModel instanceof DynamicModel) {
            $this->dynamicModel = DynamicModel::create([
                'entityModel' => $this->owner,
                'valueClass' => $this->valueClass,
                'fieldPrefix' => $this->fieldPrefix,
            ]);
        }
        return $this->dynamicModel;
    }
    
    public function beforeValidate() {
        return $this->eav->validate();
    }
    
    public function afterSave() {
        $this->eav->save(false);
    }
    
}