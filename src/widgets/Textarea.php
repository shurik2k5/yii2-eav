<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace shurik2k5\eav\widgets;

class Textarea extends AttributeHandler
{
    public static $order = 1;

    public static $fieldView = <<<TEMPLATE
		<textarea
			class='form-control input-sm' type='text'
			rows=<%= rf.get(Formbuilder.names.AREA_ROWS) %>
			cols=<%= rf.get(Formbuilder.names.AREA_COLS) %>
			<% if ( rf.get(Formbuilder.names.LOCKED) ) { %>disabled readonly<% } %>
		/>
		</textarea>
TEMPLATE;

    public static $fieldSettings = <<<TEMPLATE
		<%= Formbuilder.templates['edit/field_options']() %>
		<%= Formbuilder.templates['edit/text_area']() %>
TEMPLATE;

    public static $fieldButton = <<<TEMPLATE
		<span class='symbol'><span class='fa fa-font'></span></span> <%= Formbuilder.lang('Input textarea') %>
TEMPLATE;

    public static $defaultAttributes = <<<TEMPLATE
		function (attrs) {
								attrs.field_options.size = 'large';
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
        ->textArea($this->options);
    }
}
