<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Create Person', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'FirstName',
            'LastName',
            //'Type',
            'ContactNum',
            // 'Address:ntext',
            'UserName',
            // 'Password',
            // 'PasswordHash',
            'Email:email',
            // 'PrivilegeID',
            // 'IsSubscribed',
            // 'IsActive',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
