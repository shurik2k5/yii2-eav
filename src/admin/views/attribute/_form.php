<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model mirocow\eav\models\EavAttribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eav-attribute-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('The name of field') ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true])->hint('The label of field') ?>

    <?= $form->field($model, 'entityId')->dropDownList($model->listEntities, [])->hint('')->label('Entity name') ?>

    <?= $form->field($model, 'typeId')->dropDownList($model->listTypes, [])->hint('he type of entity')->label('Type') ?>

    <?= $form->field($model, 'defaultValue')->textInput(['maxlength' => true])->hint('The default value of field') ?>

    <?= $form->field($model, 'required')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
