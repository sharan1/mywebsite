<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestBookingPairing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-booking-pairing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'RequestID')->textInput() ?>

    <?= $form->field($model, 'WorkspaceID')->textInput() ?>

    <?= $form->field($model, 'IsActive')->textInput() ?>

    <div class="form-group" align="center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
