<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\itemsoldsearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itemsold-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ItemID') ?>

    <?= $form->field($model, 'CustomerID') ?>

    <?= $form->field($model, 'AddedOn') ?>

    <?= $form->field($model, 'AddedBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
