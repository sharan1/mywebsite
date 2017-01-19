<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Privilege;


/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = 'Signup Form';
?>
<div class="person-create">
    <h1><?= "Signup here:" ?></h1>
    <div class="person-form">
    <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>
    <?= $form->field($model, 'FirstName')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'LastName')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ContactNum')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Address')->textarea(['rows' => 4]) ?>
    <?= $form->field($model, 'UserName')->textInput(['maxlength' => true, 'id' => 'available-username']) ?>
    <?= $form->field($model, 'Email')->textInput(['maxlength' => true, 'id' => 'available-email']) ?>
    <?= $form->field($model, 'Password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>
