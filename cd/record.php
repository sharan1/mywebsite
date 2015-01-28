<?php
require_once('../connect.php') ;
ini_set('display_errors',1);

$name = $_POST['name'];

mysql_connect('localhost',$username,$password) or die( "Unable to connect");
@mysql_select_db($dbname) or die( "Unable to select database");

$query_test = "UPDATE CD_Payment SET `IsPaid` = 1 where `Name` LIKE '%".$name."%' ";
mysql_query($query_test)  or die( "Query Failed");
mysql_close();

header('Location: payment.php');  
?>