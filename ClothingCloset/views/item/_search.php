<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\itemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="allitem-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ItemID') ?>

    <?= $form->field($model, 'DonationID') ?>

    <?= $form->field($model, 'Price') ?>

    <?= $form->field($model, 'BrandID') ?>

    <?= $form->field($model, 'IsPriceDec') ?>

    <?php // echo $form->field($model, 'IsActive') ?>

    <?php // echo $form->field($model, 'AddedOn') ?>

    <?php // echo $form->field($model, 'AddedBy') ?>

    <?php // echo $form->field($model, 'size') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
