<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkspaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workspaces';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workspace-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Create Workspace', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Name',
            [
                'attribute' => 'AreaName',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->area->Name;
                },
            ],
            'Capacity',
            // 'AdditionalInfo:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
