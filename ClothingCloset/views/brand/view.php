<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Brand */

$this->title = "Brand #".$model->BrandID;
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->BrandID;
?>
<div class="brand-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Update', ['update', 'id' => $model->BrandID], ['class' => 'btn btn-primary', 'style' => 'margin-right:4px']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->BrandID], [
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
            'BrandID',
            'BrandName',
            'AddedOn',
            [
                'attribute' => 'AddedBy',
                'format' => 'raw',
                'value' => $model->addedBy->fullName,
            ],
        ],
    ]) ?>

</div>
