<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Allitem */


$this->title = "View Item #".$model->ItemID;
$this->params['breadcrumbs'][] = ['label' => 'Allitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="allitem-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Update', ['update', 'id' => $model->ItemID], ['class' => 'btn btn-primary', 'style' => 'margin-right:4px']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ItemID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ItemID',
            [
                'attribute' => 'DonationBy',
                'format' => 'raw',
                'value' => $model->donation->person->fullName,
            ],
            'Price',
            [
                'attribute' => 'BrandID',
                'format' => 'raw',
                'value' => $model->brand->BrandName,
            ],
            [
                'attribute' => 'IsPriceDec',
                'format' => 'raw',
                'value' => $model->IsPriceDec == 1 ? "Yes":"No",
            ],
            'AddedOn',
            [
                'attribute' => 'AddedBy',
                'format' => 'raw',
                'value' => $model->addedBy->fullName,
            ],
            //'size',
            [
                'attribute' => 'size',
                'format' => 'raw',
                'value' => $model->size->Size,
            ],
            [
                'attribute' => 'Image',
                'format' => 'raw',
                'value' => $model->getImageUrl(),
            ]
        ],
    ]) ?>

</div>
