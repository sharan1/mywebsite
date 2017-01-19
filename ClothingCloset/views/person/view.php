<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = "Person #".$model->PersonID;
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->PersonID;
?>
<div class="person-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Update', ['update', 'id' => $model->PersonID], ['class' => 'btn btn-primary', 'style' => 'margin-right:4px']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PersonID], [
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
            'FirstName',
            'LastName',
            'Type',
            'ContactNum',
            'Address:ntext',
            'UserName',
            'Email:email',
            [
                'attribute' => 'PrivilegeID',
                'format' => 'raw',
                'value' => $model->privilege->PrivilegeName,
            ],
        ],
    ]) ?>

</div>
