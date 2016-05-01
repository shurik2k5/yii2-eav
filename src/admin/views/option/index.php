<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel mirocow\eav\models\EavAttributeOptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eav Attribute Options';
$this->params['breadcrumbs'][] = ['label' => 'EAV', 'url' => ['/eav']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eav-attribute-option-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eav Attribute Option', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'attributeId',
            'value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
