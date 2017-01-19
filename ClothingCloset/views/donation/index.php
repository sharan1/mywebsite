<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DonationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Donations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="donation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Create Donation', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'DonatedBy',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->person->fullName;
                },
            ],
            'NumItems',
            'AddedOn',
            [
                'attribute' => 'AddedByName',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->addedBy->fullName;
                },
            ],
            [  
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {tax}',
                'buttons' => [
                    'tax' => function($url, $model) {
                        return Html::a('Recipt', ['recipt', 'id' => $model->DonationID], [
                            'class' => 'btn btn-xs btn-info'
                            ]);
                    },
                ]
            ]
        ],
    ]); ?>
</div>
