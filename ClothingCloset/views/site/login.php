<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\Register */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="login-container">
    <div class="title">
        <center><h3 style="color: #000; width: 360px; margin-left: 20px; font-weight: 100;"><b>Welcome to the Clothing Closet</b></h3></center>
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
                <input type="button" value="Send" id="login-button" class = "rp-button"/>          
            </div> <!-- end rp-wrapper div -->
        </div> <!-- end wrapper div -->
    </form>
</div>
</body>
