<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel mirocow\eav\models\EavAttributeTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eav Attribute Types';
$this->params['breadcrumbs'][] = ['label' => 'EAV', 'url' => ['/eav']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eav-attribute-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eav Attribute Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'handlerClass',
            'storeType',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
