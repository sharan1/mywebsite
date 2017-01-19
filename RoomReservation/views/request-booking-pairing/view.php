<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RequestBookingPairing */

$this->title = $model->PairingID;
$this->params['breadcrumbs'][] = ['label' => 'Request Booking Pairings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-booking-pairing-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PairingID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PairingID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'PairingID',
            'RequestID',
            'WorkspaceID',
            'IsActive',
        ],
    ]) ?>

</div>
