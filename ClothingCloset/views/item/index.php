<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\itemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="allitem-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ItemName',
            [
                'attribute' => 'DonatedBy',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->donation->person->fullName;
                },
            ],
            'Price',
            [
                'attribute' => 'BrandName',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->brand->BrandName;
                },
            ],
            [
                'attribute' => 'IsPriceDec',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->IsPriceDec == 1 ? "Yes": "No";
                },
                'filter' => [1 => "Yes", 0 => "No"],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
