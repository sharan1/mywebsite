<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\MapConstants;

/* @var $this yii\web\View */
/* @var $model app\models\Area */

$this->title = "Area #".$model->AreaID.": ".$model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->AreaID;
?>
<div class="area-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Update', ['update', 'id' => $model->AreaID], ['class' => 'btn btn-primary', 'style' => 'margin-right:4px']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->AreaID], [
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
            'AreaID',
            'Name',
            [
                'attribute' => 'Type',
                'format' => 'raw',
                'value' => MapConstants::getAreaType()[$model->Type]
            ],
            'Num_Workspaces',
        ],
    ]) ?>

</div>
