<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PersonID') ?>

    <?= $form->field($model, 'FirstName') ?>

    <?= $form->field($model, 'LastName') ?>

    <?= $form->field($model, 'Type') ?>

    <?= $form->field($model, 'ContactNum') ?>

    <?php // echo $form->field($model, 'Address') ?>

    <?php // echo $form->field($model, 'UserName') ?>

    <?php // echo $form->field($model, 'Password') ?>

    <?php // echo $form->field($model, 'PasswordHash') ?>

    <?php // echo $form->field($model, 'Email') ?>

    <?php // echo $form->field($model, 'PrivilegeID') ?>

    <?php // echo $form->field($model, 'IsSubscribed') ?>

    <?php // echo $form->field($model, 'IsActive') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
