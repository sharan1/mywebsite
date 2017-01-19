<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MapConstants;

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Type')->dropdownList(MapConstants::getAreaType(), ['prompt' => "Select AreaType", 'class' => 'select2']); ?>

    <?= $form->field($model, 'Num_Workspaces')->textInput() ?>

    <div class="form-group" align="center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
