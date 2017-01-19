<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Itemsold */

$this->title = $model->ItemID;
$this->params['breadcrumbs'][] = ['label' => 'Itemsolds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemsold-view">

    <h1><?= "ItemSold #".Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ItemID',
            [
                'attribute' => 'Item',
                'format' => 'raw',
                'value' => $model->item->ItemName,
            ],
            [
                'attribute' => 'Customer',
                'format' => 'raw',
                'value' => isset($model->buyer) ? $model->buyer->fullName : "Anonymous buyer",
            ],
            [
                'attribute' => 'Image',
                'format' => 'raw',
                'value' => $model->item->getImageUrl(),
            ],
            'AddedOn',

        ],
    ]) ?>

</div>
