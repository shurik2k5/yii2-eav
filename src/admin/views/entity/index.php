<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel mirocow\eav\models\EavEntitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eav Entities';
$this->params['breadcrumbs'][] = ['label' => 'EAV', 'url' => ['/eav']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eav-entity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eav Entity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'entityName',
            'entityModel',
            'categoryId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
