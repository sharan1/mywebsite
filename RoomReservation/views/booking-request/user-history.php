<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\MapConstants;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookingRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Booking Record';
$this->params['breadcrumbs'][] = $this->title;
$statuses = MapConstants::getBookingStatus();
?>
<div class="booking-request-index">
    <h2><?= Html::encode($this->title) ?></h2>
    <div class="pull-right" style="padding-bottom:20px">
        <?= Html::a('New Booking Request', ['bookingavail'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="row">  
        <div class="col-sm-12">  
            <section class="panel panel-default">  
                <header class="panel-heading font-bold">Upcoming Bookings</header>  
                <div class="panel-body">
                    <?php if(isset($future_bookings) && sizeof($future_bookings) > 0) : ?>
                    <table id = "future-bookings" class="table table-striped">
                        <thead>
                            <tr>
                                <th>S. No </th>
                                <th>Event</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Space</th>
                                <th>Status</th>
                                <th>Requested On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php $c = 1; ?>           
                                <?php foreach($future_bookings as $l) : ?>
                                <tr>
                                    <td><?= $c++; ?> </td>
                                    <td><?= $l->Reason; ?></td>
                                    <td><?= $l->StartTime; ?></td>
                                    <td><?= $l->EndTime; ?></td>
                                    <td><?= implode(', ', $mapping[$l->RequestID]); ?></td>
                                    <td><?= $statuses[$l->Booking_Status]; ?></td>
                                    <td><?php echo $l->RequestedOn;?></td>
                                    <td>
                                        <?= $l->Booking_Status >= 1 ? Html::a('Cancel', ['cancel', 'id' => $l->RequestID], [
                                            'class' => 'btn btn-sm btn-danger',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to cancel this booking?',
                                                'method' => 'post',
                                            ],
                                        ]) : ''; ?>
                                    </td>
                                </tr>
                                <?php endforeach ; ?>
                           
                        </tbody>
                    </table> 
                    <?php else : ?> 
                        <center><b><i>There is no record in the selected criteria.</i></b></center>
                    <?php endif ; ?>       
                </div>
            </section>
        </div>
    </div>


    <div class="row">  
        <div class="col-sm-12">  
            <section class="panel panel-default">  
                <header class="panel-heading font-bold">Past Bookings</header>  
                <div class="panel-body">
                    <?php if(isset($past_bookings) && sizeof($past_bookings) > 0) : ?>
                    <table id = "past-bookings" class="table table-striped">
                        <thead>
                            <tr>
                                <th>S. No </th>
                                <th>Event</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Space</th>
                                <th>Status</th>
                                <th>Requested On</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php $c = 1; ?>           
                                <?php foreach($past_bookings as $l) : ?>
                                <tr>
                                    <td><?php echo $c++; ?> </td>
                                    <td><?php echo $l->Reason; ?></td>
                                    <td><?php echo $l->StartTime; ?></td>
                                    <td><?php echo $l->EndTime; ?></td>
                                    <td><?php echo implode(', ', $mapping[$l->RequestID]); ?></td>
                                    <td><?= $statuses[$l->Booking_Status]; ?></td>
                                    <td><?php echo $l->RequestedOn;?></td>
                                </tr>
                                <?php endforeach ; ?>
                           
                        </tbody>
                    </table>
                    <?php else : ?> 
                        <center><b><i>There is no record in the selected criteria.</i></b></center>
                    <?php endif ; ?>        
                </div>
            </section>
        </div>
    </div>
</div>
