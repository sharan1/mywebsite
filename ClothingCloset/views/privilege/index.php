<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrivilegeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Privileges';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="privilege-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('Create Privilege', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PrivilegeName',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
