<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mirocow\eav\widgets;

use mirocow\eav\handlers\AttributeHandler;
use Yii;

class Textarea extends AttributeHandler
{
    static $order = 1;

    static $fieldView = <<<TEMPLATE
    <textarea 
      class='form-control input-sm' type='text'
      rows=<%= rf.get(Formbuilder.options.mappings.AREA_ROWS) %>
      cols=<%= rf.get(Formbuilder.options.mappings.AREA_COLS) %> 
      <% if ( rf.get(Formbuilder.options.mappings.LOCKED) ) { %>disabled readonly<% } %> 
    />
    </textarea>    
TEMPLATE;

    static $fieldSettings = <<<TEMPLATE
    <%= Formbuilder.templates['edit/field_options']() %>
    <%= Formbuilder.templates['edit/text_area']() %>    
TEMPLATE;

    static $fieldButton = <<<TEMPLATE
    <span class='symbol'><span class='fa fa-font'></span></span> <%= Formbuilder.lang('Input textarea') %>    
TEMPLATE;
    
    static $defaultAttributes = <<<TEMPLATE
    function (attrs) {
                attrs.field_options.size = 'large';
                return attrs;
            }   
TEMPLATE;


    public function init()
    {
        parent::init();

        //$this->owner->addRule($this->getAttributeName(), 'string', ['max' => 255]);
    }

    public function run()
    {
        return $this->owner->activeForm->field(
            $this->owner, 
            $this->getAttributeName(), 
            ['template' => "{input}\n{hint}\n{error}"])
            ->textArea($this->options);
    }
}