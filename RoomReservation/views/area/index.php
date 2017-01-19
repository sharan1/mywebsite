<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\MapConstants;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Areas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Create Area', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],            
            'Name',
            [
                'attribute' => 'Type',
                'format' => 'raw',
                'value' => function($model) {
                    return MapConstants::getAreaType()[$model->Type];
                },
                'filter' => MapConstants::getAreaType(),
            ],
            'Num_Workspaces',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
