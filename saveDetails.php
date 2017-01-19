<?php

if(empty($_POST))
{
	header('Location: contact.php'); 
}

require_once('connect.php') ;
ini_set('display_errors',1);

$name = $_POST['name'];
$email = $_POST['email'] ;
$mobile= $_POST['mobile'] ;
$reason  = $_POST['reason'] ;

$mysqli = new mysqli("localhost", $username, $password, $dbname);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$query = "INSERT INTO `contactPeople`( `name`, `email`, `mobile`, `reason`) VALUES( '$name','$email','$mobile','$reason');" ;
//mysqli_query($query)  or die( "Query Failed");
$result = mysqli_query($mysqli, $query)  or die( "Query Failed");
mysqli_close($mysqli);

$to = 'sharan.girdhani@gmail.com' ;
$subject = ' Contact - Name: '.$name. ', Mobile No : '.$mobile. ', Email : '.$email;
$message = $reason ;
$headers = 'From: MyWebsite <admin@sharangirdhani.com>';
$status = mail($to, $subject, $message, $headers) ;

$r_to = $email;
$r_subject = 'Contact : sharangirdhani.com';
$r_message = 'Thank You '.$name.' for contacting me. I will get back to you ASAP if your credentials are correct. :P';
$r_headers = 'From: Sharan Girdhani <admin@sharangirdhani.com>';
$recipient_status = mail($r_to, $r_subject, $r_message, $r_headers) ;




header('Location: temp.php');  
?>