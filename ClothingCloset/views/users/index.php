<?php
use yii\helpers\Html;
  $this->title = 'Home';
  $this->params['breadcrumbs'][] = '';
?>
 
<div class="navbar-wrapper">
    <div class="container">
        <!-- ======================================= Carousel ================================================== -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php for($i=1;$i<=3;$i++): ?>
                <div class="item <?= $i== 1 ? 'active' : ''; ?>">
                    <img class="first-slide" src="img/home<?=$i;?>.jpg" style="width:1000px; height:500px;" alt="First slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another Reason to SHOP!!!.</h1>
                            <p>50%-70% off on selected items</p>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><!-- /.carousel -->
        
        <!-- Marketing messaging and featurettes
        ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->
        <div class="container marketing">
            <?php $i=0; ?>
            <?php foreach($item_data as $key => $value) : ?>
            <?php $i++; ?>
            <hr class="featurette-divider">
            <div class="row featurette">
                <div class="col-md-7 <?=$i%2 == 0 ? 'col-md-push-5':'';?>">
                    <h2 class="featurette-heading"><?= Html::a($value->ItemName, ['itemdetails', 'id' => $value->ItemID]) ?></h2>
                    <p class="lead"><?=$value->Description;?></p>
                    <span style="margin-left:250px"><b style="font-size:25px;">Price: $<?=$value->Price;?></b></span>
                </div>
                <div class="col-md-5 <?=$i%2 == 0 ? 'col-md-pull-7':'';?>">
                    <img class="featurette-image img-responsive center-block" src="<?=$value->Image;?>" alt="Generic placeholder image" style="width:200px;height:300px">
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>