<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Area;


/* @var $this yii\web\View */
/* @var $model app\models\Workspace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workspace-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AreaID')->dropdownList(Area::find()->select(['Name', 'AreaID'])->indexBy('AreaID')->column(), ['prompt' => "Select Area", 'class' => 'select2']); ?>

    <?= $form->field($model, 'Capacity')->textInput() ?>

    <?= $form->field($model, 'AdditionalInfo')->textarea(['rows' => 6]) ?>

    <div class="form-group" align="center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
