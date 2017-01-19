<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Privilege */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="privilege-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PrivilegeName')->textInput(['maxlength' => true]) ?>

    <div class="form-group" align="center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
