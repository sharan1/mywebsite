<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequestBookingPairing */

$this->title = 'Update Request Booking Pairing: ' . $model->PairingID;
$this->params['breadcrumbs'][] = ['label' => 'Request Booking Pairings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PairingID, 'url' => ['view', 'id' => $model->PairingID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="request-booking-pairing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
