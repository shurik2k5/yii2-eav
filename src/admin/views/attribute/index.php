<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel mirocow\eav\models\EavAttributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fields';
$this->params['breadcrumbs'][] = ['label' => 'EAV', 'url' => ['/eav']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eav-attribute-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eav Attribute', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'entityId',
            'typeId',
            'name',
            'label',
            // 'defaultValue',
            // 'defaultOptionId',
            // 'required',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
