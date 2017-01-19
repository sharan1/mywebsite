<?php

use yii\helpers\Html;

  $this->title = 'Kids';
  $this->params['breadcrumbs'][] = $this->title;
?>
 
<div class="container">
    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
            <p class="pull-right visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
            </p>
            <div class="jumbotron">
                <img src="img/kids1.jpg" width="740" height="400">
            </div>

            <h3>Clothing Items for Kids</h3>

            <div class="row">
            <?php foreach($item_data as $key => $value) : ?>
                <div class="col-xs-6 col-lg-4" style="margin-top:30px;">
                    <img src="<?=$value['Image'];?>" width="150" height="120">
                    <h4 style="margin-left:10px;"><?= Html::a($value['ItemName'], ['itemdetails', 'id' => $value['ItemID']]) ?></h4>
                    <p style="margin-left:60px;"><font color="red">$ <?=$value['Price'];?></font></p>
                    <?= Html::a('View Details', ['itemdetails', 'id' => $value['ItemID']], ['class' => 'btn btn-primary', 'style' => 'margin-left:20px']) ?>
                </div>
            <?php endforeach; ?>
            </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->
    </div><!--/row-->
</div><!--/.container-->