<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\Register */
/* @var $form yii\widgets\ActiveForm */
//$this->registerCSSFile()
?>
<!--Background image-
<style type="text/css">
-->

<style type="text/css">
body
 {
     background-image: url(images/room.jpg);
     background-repeat: no-repeat;
     background-size:cover;
 }
 </style>

<div class="login-container">
    <div class="title">
    </div>
    <div id="tabs">
        <ul>
            <li onClick="showLogin()" id="loginbutton">Login</li>
            <li onClick="showRP()" id="rstPass">Forgot Password</li>
        </ul>
    </div> <!-- end tabs div -->
    <form class="login-form" method="post">
        <div id="wrapper">
            <div id="login-wrapper">
                <div id="info">Please enter your username and password to login</div>
                    <input type="text" id="login-text" name = "UserName" placeholder="Username or Email" />
                    <input type="password" id="login-pass" name = "Password" placeholder="Password" />
                <input type="submit" value="Login" id="login-button" />
            </div> <!-- end login-wrapper div -->
            <div id="rp-wrapper">
                <div id="info">Enter your email to reset your password</div>
                <input type="text" class="email-text" id="login-text" name = "Email" placeholder="Email" />
                <div class="empty-space">
                    <b><span id="show-message" style="color:#000"></span></b>
                </div>
                <input type="submit" value="Send" id="login-button" class = "rp-button"/>          
            </div> <!-- end rp-wrapper div -->
        </div> <!-- end wrapper div -->
    </form>
</div>
</body>