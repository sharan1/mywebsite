<?php 
use \yii\helpers\Url;
?>
<aside class="main-sidebar" style="position:fixed">
    <!-- sidebar: CSS can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="nav sidebar-menu">
            <li class="header"><b>Navigation SideBar</b></li>
            <!-- Optionally, you can add icons to the links -->
            <?php if(Yii::$app->user->identity->PrivilegeID == 1) : ?>
                <li><a href=<?= Url::to(['/users/home']) ?>><i class="fa fa-photo"></i> <span>Home</span></a></li>
                <li><a href=<?= Url::to(['/users']) ?>><i class="fa fa-users"></i> <span>Users</span></a></li>
                <li><a href=<?= Url::to(['/area']) ?>><i class="fa fa-building"></i> <span>Areas</span></a></li>
                <li><a href=<?= Url::to(['/workspace']) ?>><i class="fa fa-star"></i> <span>Workspaces</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Booking Requests</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to(['/booking-request']) ?>"><i class="fa fa-columns"></i> <span>Pending Requests</span></a></li>
                        <li><a href="<?= Url::to(['/booking-request/history']) ?>"><i class="fa fa-columns"></i> <span>Completed Requests</span></a></li>
                    </ul>
                </li>
                <li><a href=<?= Url::to(['/privilege']) ?>><i class="fa fa-photo"></i> <span>Privileges</span></a></li>
                <li><a href=<?= Url::to(['/email']) ?>><i class="fa fa-envelope"></i> <span>Email</span></a></li>
            <?php elseif(Yii::$app->user->identity->PrivilegeID == 2) : ?>
                <li><a href=<?= Url::to(['/booking-request/userhistory']) ?>><i class="fa fa-columns"></i> <span>Booking History</span></a></li>
                <li><a href=<?= Url::to(['/booking-request/bookingavail']) ?>><i class="fa fa-columns"></i> <span>New Booking</span></a></li>
            <?php endif ?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
