<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\itemsoldsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ItemSold';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemsold-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'Item',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->item->ItemName;
                },
            ],
            [
                'attribute' => 'Customer',
                'format' => 'raw',
                'value' => function($model) {
                    return isset($model->buyer) ? $model->buyer->fullName : "Anonymous buyer";
                },
            ],
            'AddedOn',
                        
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
