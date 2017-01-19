<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestBookingPairingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-booking-pairing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PairingID') ?>

    <?= $form->field($model, 'RequestID') ?>

    <?= $form->field($model, 'WorkspaceID') ?>

    <?= $form->field($model, 'IsActive') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
