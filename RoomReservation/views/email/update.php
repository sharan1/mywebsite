<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Email */

$this->title = 'Update Email: ' . $model->MailID;
$this->params['breadcrumbs'][] = ['label' => 'Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MailID, 'url' => ['view', 'id' => $model->MailID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="email-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
