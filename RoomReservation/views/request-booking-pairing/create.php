<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RequestBookingPairing */

$this->title = 'Create Request Booking Pairing';
$this->params['breadcrumbs'][] = ['label' => 'Request Booking Pairings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-booking-pairing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
