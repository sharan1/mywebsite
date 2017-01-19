<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\color */

$this->title = "Color #".$model->ColorID;
$this->params['breadcrumbs'][] = ['label' => 'Colors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->ColorID;
?>
<div class="color-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Update', ['update', 'id' => $model->ColorID], ['class' => 'btn btn-primary', 'style' => 'margin-right:4px']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ColorID], [
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
            'ColorID',
            'ColorName',
            'HexCode',
        ],
    ]) ?>

</div>
