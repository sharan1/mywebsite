<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Itemsold */

$this->title = 'Create Itemsold';
$this->params['breadcrumbs'][] = ['label' => 'Itemsolds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemsold-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
