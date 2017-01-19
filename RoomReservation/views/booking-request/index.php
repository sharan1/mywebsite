<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookingRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pending Booking Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Create Booking Request', ['create'], ['class' => 'btn btn-warning']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'UserID',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->user->fullName;
                },
            ],
            'Reason:ntext',
            'StartTime',
            'EndTime',

            // 'Additional_Info:ntext',
            // 'Last_Updated',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {confirm} {cancel}',
                'buttons' => [
                    'view' => function($url, $model) {
                        return Html::a('View', ['view', 'id' => $model->RequestID], [
                            'class' => 'btn btn-xs btn-info'
                            ]);
                    }, 
                    'confirm' => function($url, $model) {
                        return Html::a('Confirm', ['confirm', 'id' => $model->RequestID], [
                            'class' => 'btn btn-xs btn-success'
                            ]);
                    },
                    'cancel' => function($url, $model) {
                        return Html::a('Cancel', ['cancel', 'id' => $model->RequestID], [
                            'class' => 'btn btn-xs btn-danger'
                            ]);
                    }  
                ]
                //'confirm' => Html::a('Confirm', 'confirm'), 
            ],

        ],
    ]); ?>
</div>
