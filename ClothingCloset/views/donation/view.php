<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Donation */

$this->title = "Donation #".$model->DonationID;
$this->params['breadcrumbs'][] = ['label' => 'Donations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="donation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Update', ['update', 'id' => $model->DonationID], ['class' => 'btn btn-primary']) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'PersonID',
                'format' => 'raw',
                'value' => $model->person->fullName,
            ],
            'TaxDocLoc:ntext',
            'NumItems',
            'AddedOn',
            [
                'attribute' => 'AddedBy',
                'format' => 'raw',
                'value' => $model->addedBy->fullName,
            ],
        ],
    ]) ?>

</div>
