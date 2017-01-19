<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BookingRequest */

$this->title = 'Update Booking Request: ' . $model->RequestID;
$this->params['breadcrumbs'][] = ['label' => 'Booking Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RequestID, 'url' => ['view', 'id' => $model->RequestID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="booking-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
