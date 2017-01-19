<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DonationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="donation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'DonationID') ?>

    <?= $form->field($model, 'TaxDocLoc') ?>

    <?= $form->field($model, 'PersonID') ?>

    <?= $form->field($model, 'NumItems') ?>

    <?= $form->field($model, 'AddedOn') ?>

    <?php // echo $form->field($model, 'AddedBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
