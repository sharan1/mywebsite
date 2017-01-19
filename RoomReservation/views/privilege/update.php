<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Privilege */

$this->title = 'Update Privilege: ' . $model->PrivilegeID;
$this->params['breadcrumbs'][] = ['label' => 'Privileges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PrivilegeID, 'url' => ['view', 'id' => $model->PrivilegeID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="privilege-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
