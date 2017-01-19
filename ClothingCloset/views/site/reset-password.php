<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Privilege;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = 'Reset Password';
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php
    echo $form->field($resetpasswordmodel, 'changepassword')->passwordInput(['maxlength' => true]);
    echo $form->field($resetpasswordmodel, 'reenterpassword')->passwordInput(['maxlength' => true]);
    ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>