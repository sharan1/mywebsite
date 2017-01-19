<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Size;
use app\models\Brand;
use app\models\Person;
use app\models\Donation;
use yii\web\UploadedFile;
use app\models\Category;
use app\models\Color;

$data = Donation::find()->all();

$array_data = [];

foreach ($data as $value) 
{
    $array_data[$value->DonationID] = $value->person->fullName." - ".$value->AddedOn;
}
/* @var $this yii\web\View */
/* @var $model app\models\Allitem */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="allitem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ItemName')->textInput() ?>
    
    <?= $form->field($model, 'Description')->textInput() ?>
    
    <?= $form->field($model, 'DonationID')->dropdownList($array_data, ['prompt' => "Select Donation", 'class'=>'select2']); ?>
    
    <?= $form->field($model, 'Price')->textInput() ?>

    <?= $form->field($model, 'BrandID')->dropdownList(Brand::find()->select(['BrandName', 'BrandID'])->indexBy('BrandID')->column(), ['prompt' => "Select Brand", 'class'=>'select2']); ?>

    <?= $form->field($model, 'category_details')->dropdownList(Category::find()->select(['CategoryName', 'CategoryID'])->indexBy('CategoryID')->column(), ['prompt' => "Select Categories", 'class' => 'select2', 'multiple' => 'multiple']); ?>

    <?= $form->field($model, 'color_details')->dropdownList(Color::find()->select(['ColorName', 'ColorID'])->indexBy('ColorID')->column(), ['prompt' => "Select Colors", 'class' => 'select2', 'multiple' => 'multiple']); ?>
    
    <?= $form->field($model, 'IsPriceDec')->dropdownList([1 => "Yes", 0 => "No"], ['prompt' => "Select", 'class'=>'select2']);?>

    <?= $form->field($model, 'SizeID')->dropdownList(Size::find()->select(['Size', 'ID'])->indexBy('ID')->column(), ['prompt' => "Select Size", 'class'=>'select2']); ?>

    <?= $form->field($model, 'Image')->fileInput(); ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
