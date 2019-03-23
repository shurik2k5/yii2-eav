<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mirocow\eav\widgets;

use yii\helpers\ArrayHelper;

class CheckBoxList extends AttributeHandler
{
    const VALUE_HANDLER_CLASS = '\mirocow\eav\handlers\MultipleOptionsValueHandler';

    public static $order = 10;

    public static $fieldView = <<<TEMPLATE
		<% for (i in (rf.get(Formbuilder.names.OPTIONS) || [])) { %>
		<div>
		<label class='fb-option'>
		<input type='checkbox'
			<%= rf.get(Formbuilder.names.OPTIONS)[i].checked && 'checked' %>
			<% if ( rf.get(Formbuilder.names.LOCKED) ) { %><%= Formbuilder.lang('disabled readonly') %><% } %>
				onclick="javascript: return false;"
		/>
		<%= rf.get(Formbuilder.names.OPTIONS)[i].label %>
		</label>
		</div>
		<% } %>
		<% if (rf.get(Formbuilder.names.INCLUDE_OTHER)) { %>
		<div class='other-option'>
		<label class='fb-option'><input type='checkbox' /> <%= Formbuilder.lang('Other') %></label>
		<input type='text' />
		</div>
		<% } %>
TEMPLATE;

    public static $fieldSettings = <<<TEMPLATE
		<%= Formbuilder.templates['edit/field_options']() %>
		<%= Formbuilder.templates['edit/options']({
			showCheckBox: true,
			rf: rf
		}) %>
TEMPLATE;

    public static $fieldButton = <<<TEMPLATE
		<span class="symbol"><span class="fa fa-square-o"></span></span> <%= Formbuilder.lang('Checkboxes') %>
TEMPLATE;

    public static $defaultAttributes = <<<TEMPLATE
		function (attrs) {
						attrs.field_options.options = [
								{
										label: "",
										checked: false
								}
						];
						return attrs;
				}
TEMPLATE;

    public function run()
    {
        $options = $this->attributeModel->getEavOptions()->asArray()->all();

        return $this->owner->activeForm->field(
            $this->owner,
            $this->getAttributeName(),
            ['template' => "{input}\n{hint}\n{error}"]
        )
        ->checkboxList(
            ArrayHelper::map($options, 'id', 'value')
        );
    }
}
