<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Chat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'RequestID')->textInput() ?>

    <?= $form->field($model, 'Message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'AddedOn')->textInput() ?>

    <?= $form->field($model, 'IsAdmin')->textInput() ?>

    <?= $form->field($model, 'IsActive')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
