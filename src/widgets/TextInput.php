<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mirocow\eav\widgets;

class TextInput extends AttributeHandler
{
    public static $order = 0;

    public static $fieldView = <<<TEMPLATE
		<input type='text'
			class='form-control input-sm rf-size-<%= rf.get(Formbuilder.names.SIZE) %>'
			<% if ( rf.get(Formbuilder.names.LOCKED) ) { %>disabled readonly<% } %>
		/>
TEMPLATE;

    public static $fieldSettings = <<<TEMPLATE
		<%= Formbuilder.templates['edit/field_options']() %>
		<%= Formbuilder.templates['edit/size']() %>
		<%= Formbuilder.templates['edit/min_max_length']() %>
TEMPLATE;

    public static $fieldButton = <<<TEMPLATE
		<span class='symbol'><span class='fa fa-font'></span></span> <%= Formbuilder.lang('Input textfield') %>
TEMPLATE;

    public static $defaultAttributes = <<<TEMPLATE
function (attrs) {
						attrs.field_options.size = 'small';
						return attrs;
				}
TEMPLATE;

    public function run()
    {
        return $this->owner->activeForm->field(
            $this->owner,
            $this->getAttributeName(),
            ['template' => "{input}\n{hint}\n{error}"]
        )
        ->textInput($this->options);
    }
}
