<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Donation */

$this->title = 'Update Donation: ' . $model->DonationID;
$this->params['breadcrumbs'][] = ['label' => 'Donations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DonationID, 'url' => ['view', 'id' => $model->DonationID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="donation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
