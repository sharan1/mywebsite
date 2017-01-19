<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\MapConstants;

/* @var $this yii\web\View */
/* @var $model app\models\BookingRequest */

$this->title = "Request #".$model->RequestID;
$this->params['breadcrumbs'][] = ['label' => 'Booking Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->RequestID;
?>
<div class="booking-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Confirm', ['confirm', 'id' => $model->RequestID], ['class' => 'btn btn-success', 'style' => 'margin-right:4px']) ?>
        <?= Html::a('Cancel', ['cancel', 'id' => $model->RequestID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to cancel this booking?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'RequestID',
            [
                'attribute' => 'UserID',
                'format' => 'raw',
                'value' => $model->user->fullName,
            ],
            'RequestedOn',
            'StartTime',
            'EndTime',
            'Reason:ntext',
            [
                'attribute' => 'Booking_Status',
                'format' => 'raw',
                'value' => MapConstants::getBookingStatus()[$model->Booking_Status],
            ],
            'Additional_Info:ntext',
            'Last_Updated',
        ],
    ]) ?>

</div>
