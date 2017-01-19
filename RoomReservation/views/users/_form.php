<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Privilege;


/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FirstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PhoneNum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PrivilegeID')->dropdownList(Privilege::find()->select(['PrivilegeName', 'PrivilegeID'])->indexBy('PrivilegeID')->column(), ['prompt' => "Select Privilege", 'class' => "select2"]); ?>

    <div class="form-group" align="center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
