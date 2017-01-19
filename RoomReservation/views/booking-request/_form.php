<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
use kartik\datetime\DateTimePicker;
use app\models\Workspace;

/* @var $this yii\web\View */
/* @var $model app\models\BookingRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UserID')->dropdownList(Users::find()->select(['FirstName', 'UserID'])->indexBy('UserID')->column(), ['prompt' => "Select User", 'class' => 'select2']); ?>

    <?= $form->field($model, 'StartTime')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Enter Start Time'],
            'type' => DateTimePicker::TYPE_INPUT,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii:ss'
            ]
        ]); ?>

    <?= $form->field($model, 'EndTime')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Enter End Time'],
            'type' => DateTimePicker::TYPE_INPUT,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii:ss'
            ]
        ]); ?>
    <?= $form->field($model, 'workspace_details')->dropdownList(Workspace::find()->select(['Name', 'WorkspaceID'])->indexBy('WorkspaceID')->column(), ['prompt' => "Select User", 'class' => 'select2', 'multiple' => 'multiple']); ?>
    
    <?= $form->field($model, 'Reason')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'Additional_Info')->textarea(['rows' => 3]) ?>

    <div class="form-group" align="center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
