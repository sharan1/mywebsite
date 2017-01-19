<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Email */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="email-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Type')->textInput() ?>

    <?= $form->field($model, 'ToEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'SentOn')->textInput() ?>

    <div class="form-group" align="center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
