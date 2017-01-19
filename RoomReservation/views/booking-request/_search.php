<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookingRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'RequestID') ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'RequestedOn') ?>

    <?= $form->field($model, 'StartTime') ?>

    <?= $form->field($model, 'EndTime') ?>

    <?php // echo $form->field($model, 'Reason') ?>

    <?php // echo $form->field($model, 'Booking_Status') ?>

    <?php // echo $form->field($model, 'Additional_Info') ?>

    <?php // echo $form->field($model, 'Last_Updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
