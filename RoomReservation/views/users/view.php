<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = "User #".$model->UserID;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->UserID;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Delete', ['delete', 'id' => $model->UserID], [
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
            'UserID',
            'FirstName',
            'LastName',
            'Email:email',
            'UserName',
            'PhoneNum',
            [
                'attribute' => 'PrivilegeID',
                'format' => 'raw',
                'value' => $model->privilege->PrivilegeName,
            ],
        ],
    ]) ?>

</div>
