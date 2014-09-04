<?php
require_once('connect.php') ;
ini_set('display_errors',1);


$name = $_POST['name'];
$email = $_POST['email'] ;
$mobile= $_POST['mobile'] ;
$reason  = $_POST['reason'] ;

mysql_connect('localhost',$username,$password) or die( "Unable to connect");
@mysql_select_db($dbname) or die( "Unable to select database");

$query = "INSERT INTO `contactPeople`( `name`, `email`, `mobile`, `reason`) VALUES( '$name','$email','$mobile','$reason');" ;
mysql_query($query)  or die( "Query Failed");
mysql_close();

$to = 'sharan.girdhani@gmail.com' ;
$subject = 'MyWebsite: '.$name. ' Mobile No : '.$mobile;
$message = $reason ;
$headers = 'From: MyWebsite <admin@sharangirdhani.com>';
$status = mail($to, $subject, $message, $headers) ;
print_r($status) ;
?>