<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Person;

/* @var $this yii\web\View */
/* @var $model app\models\Itemsold */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itemsold-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CustomerID')->textInput() ?>

    <?= $form->field($model, 'AddedOn')->textInput() ?>

    <?= $form->field($model, 'AddedBy')->dropdownList(Person::find()->select(['FirstName', 'PersonID'])->indexBy('PersonID')->column(), ['prompt' => "Select Person"]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
