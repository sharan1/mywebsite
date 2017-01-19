<?php
use yii\helpers\Html;
?>
<div class="container">
    <div class="row">
        <div class="col-sm-5" style="400px;margin:0;float:left;padding-right:20px;margin:20px;">
            <img src="<?=$model->Image;?>" width="400" height="400">
            <?= Html::a('Buy this Item', ['buyitem', 'id' => $model->ItemID], ['class' => 'btn btn-success buy-item', 'style' => 'margin-left:150px;margin-top:40px;']) ?>
        </div>

        <div class="col-sm-5" style="float:left;margin:20px">
            <div style="padding:20px;height:130px">
                <h1><?=$model->ItemName;?></h1>
            </div>
            <span><b>Brand: <?=$model->brand->BrandName;?></b></span><br>
            <span><b>Size: <?=$model->size->Size;?></b></span><br>
            <span><b>Price: $<?=$model->Price;?></b></span><br><br>
            <span><?=$model->Description;?></span><br>
        </div>
    </div>
</div>
