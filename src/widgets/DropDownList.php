<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace blacksesion\eav\widgets;

use blacksesion\eav\widgets\AttributeHandler;
use Yii;
use yii\helpers\ArrayHelper;

class DropDownList extends AttributeHandler
{
    const VALUE_HANDLER_CLASS = '\blacksesion\eav\handlers\OptionValueHandler';

    static $order = 24;

    static $fieldView = <<<TEMPLATE
    <select>
    
      <% if (rf.get(Formbuilder.options.mappings.INCLUDE_BLANK)) { %> 
          <option value=''></option>  
      <% } %>
      
      <% for (i in (rf.get(Formbuilder.options.mappings.OPTIONS) || [])) { %>
        <option 
          <% if ( rf.get(Formbuilder.options.mappings.LOCKED) ) { %><%= Formbuilder.lang('disabled readonly') %><% } %> 
          <%= rf.get(Formbuilder.options.mappings.OPTIONS)[i].checked && 'selected' %> 
        />
        <%= rf.get(Formbuilder.options.mappings.OPTIONS)[i].label %>
        </option>
      <% } %>
      
    </select>
    <%= Formbuilder.templates['edit/options']({ includeBlank: true }) %>    
TEMPLATE;

    static $fieldSettings = <<<TEMPLATE
    <%= Formbuilder.templates['edit/field_options']() %>
    <%= Formbuilder.templates['edit/options']({ 
        includeBlank: true, 
        hideCheckBox: true 
    }) %>    
TEMPLATE;

    static $fieldButton = <<<TEMPLATE
    <span class="symbol"><span class="fa fa-caret-down"></span></span> <%= Formbuilder.lang('Dropdown') %>    
TEMPLATE;

    static $defaultAttributes = <<<TEMPLATE
    function (attrs) {
            attrs.field_options.options = [
                {
                    label: "",
                    checked: false
                }, {
                    label: "",
                    checked: false
                }
            ];
            attrs.field_options.include_blank_option = false;
            return attrs;
        }    
TEMPLATE;


    public function init()
    {
        parent::init();

        /*$this->owner->addRule($this->getAttributeName(), 'in', [
            'range' => $this->getOptions(),
        ]);*/
    }

    public function run()
    {
        $options = $this->attributeModel->getEavOptions()->asArray()->all();

        return $this->owner->activeForm->field(
            $this->owner, 
            $this->getAttributeName(),
            ['template' => "{input}\n{hint}\n{error}"])
            ->dropDownList(
                ArrayHelper::map($options, 'id', 'value')
            );
    }
}