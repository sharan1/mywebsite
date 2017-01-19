<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Itemsold */

$this->title = 'Update Itemsold: ' . $model->ItemID;
$this->params['breadcrumbs'][] = ['label' => 'Itemsolds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ItemID, 'url' => ['view', 'id' => $model->ItemID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="itemsold-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
