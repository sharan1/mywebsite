<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\MapConstants;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookingRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Completed Booking Requests';
$this->params['breadcrumbs'][] = $this->title;
$statuses = MapConstants::getBookingStatus();
?>
<div class="booking-request-history">
    <div class="row">  
        <div class="col-sm-12">  
            <section class="panel panel-default">  
                <header class="panel-heading font-bold">Completed Bookings(<?=sizeof($all_bookings);?>)</header>  
                <div class="panel-body">
                    <?php if(isset($all_bookings) && sizeof($all_bookings) > 0) : ?>
                    <table id = "all-bookings" class="table table-striped">
                        <thead>
                            <tr>
                                <th>S. No </th>
                                <th>Event</th>
                                <th>User</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Space</th>
                                <th>Status</th>
                                <th>Requested On</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php $c = 1; ?>           
                                <?php foreach($all_bookings as $l) : ?>
                                <tr>
                                    <td><?= $c++; ?> </td>
                                    <td><?= $l->Reason; ?></td>
                                    <td><?= $l->user->fullName; ?></td>
                                    <td><?= $l->StartTime; ?></td>
                                    <td><?= $l->EndTime; ?></td>
                                    <td><?= implode(', ', $mapping[$l->RequestID]); ?></td>
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
