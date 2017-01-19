<?php

use yii\helpers\Html;
use app\models\Area;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use app\models\Workspace;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookingRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Booking Availibility';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row"> 
    <div class="col-sm-12"> 
        <section class="panel panel-default"> 
            <section style='overflow-x: auto'> 
            <div class="panel-body"> 
	            <?php $form = ActiveForm::begin(); ?>
                <div class = "row">
                    <div class="col-sm-12">
    				<div class="form-group col-sm-3">
                       <?= '<label>Area</label>'; ?>
    	               <?= Html::dropDownList('AreaID', $area_id, ArrayHelper::map(Area::find()->where(['IsActive' => 1])->all(), 'AreaID', 'Name'), ['prompt' => "Select Area", 'class' => 'select2', 'id' => 'area-avail']) ?>
                    </div>

                    <div class="form-group col-sm-3">
                        <?= '<label>Workspace</label>'; ?>               
                        <?= Html::dropDownList('WorkspaceID', $workspace_id, $workspace_dropdown, ['prompt' => "Select Workspace", 'class' => 'select2', 'id' => 'workspace-avail']) ?>
                    </div>

                    <div class="form-group col-sm-3">
                        <?= '<label>Start Date/Time</label>'; ?>
                        <?= DateTimePicker::widget([
                            'name' => 'start_time',
                            'id' => 'start_time',
                            'options' => ['placeholder' => 'Select start time'],
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $start_time,
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd hh:ii:ss',
                                'autoclose' => true
                            ]
                        ]); ?>
                    </div>
                    <div class="form-group col-sm-3">
                        <?= '<label>End Date/Time</label>'; ?>
                        <?= DateTimePicker::widget([
                            'name' => 'end_time',
                            'id' => 'end_time',
                            'options' => ['placeholder' => 'Select end time'],
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $end_time,
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd hh:ii:ss',
                                'autoclose' => true
                            ]
                        ]); ?>
                    </div>     
                </div>
                <div class = "row">
                    <div class="col-sm-12">
                        <div class="form-group col-md-6" style="margin-left: 1.4%">
                           <?= '<label>Purpose</label><br>'; ?>
                           <?= Html::textInput('Reason', $reason, ['placeholder' => 'Enter your purpose', 'id' => 'reason-avail', 'style'=>'width: 98%']); ?>
                        </div>

                        <div class="form-group col-sm-5">
                           <?= '<label>Additional Requirements(If any)</label><br>'; ?>
                           <?= Html::textInput('Additional_Info', $additional_info, ['placeholder' => 'Additional Requirements', 'id' => 'info-avail', 'style'=>'width: 98%']); ?>
                        </div>
                    </div>
                </div>
                <div class = "row">
                    <div align="center">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-primary' , 'id' => 'submit-avail', 'style' => 'margin-left:20px']); ?>
                    </div>  
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            </div>
        </section>    
    </div>
</div>

<?php if(isset($result) && sizeof($result) > 0) : ?>
<div class="row">  
    <div class="col-sm-12">  
        <section class="panel panel-default">  
            <header class="panel-heading font-bold">Available Spaces:</header>  
            <div class="panel-body">
                <input id="total-size" type="hidden" value="<?=sizeof($result)?>" />
                <table id = "booking-data" class="table table-striped">
                    <thead>
                        <tr>
                            <th>S. No </th>
                            <th>Area</th>
                            <th>Workspace</th>
                            <th>Capacity</th>
                            <th>Book</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php $c = 1; ?>           
                            <?php foreach($result as $l) : ?>
                            <tr class="book-specific">
                                <td><?= $c++; ?> </td>
                                <td><?= $l['AreaName']; ?></td>
                                <td><?= $l['Name']; ?></td>
                                <td><?= $l['Capacity']; ?></td>
                                <td>
                                    <?= Html::checkBox('select_booking', false, [
                                            'id' => $l['WorkspaceID'],
                                        ]);
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach ; ?>
                    </tbody>
                </table>
                <?= Html::a('Reserve', '', ['id' => 'book-room','class' => 'btn btn-sm btn-success', 'style' => 'margin-left:50%']);?>       
            </div>
            <div align="right">
                <?= Html::a('Download','', ['class' => 'btn btn-success btn-sm export-booking-data']); ?>
            </div >
        </section>
    </div>
</div>
<?php else : ?> 
    <center><b><i>There is no record in the selected criteria.</i></b></center>
<?php endif ; ?> 