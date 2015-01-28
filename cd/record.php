<?php
require_once('../connect.php') ;
ini_set('display_errors',1);

$name = $_POST['name'];

mysql_connect('localhost',$username,$password) or die( "Unable to connect");
@mysql_select_db($dbname) or die( "Unable to select database");

$query = "INSERT INTO `CD_Payment`( `Name`, `IsPaid`) VALUES( '$name',1);" ;
mysql_query($query)  or die( "Query Failed");
mysql_close();

header('Location: temp.html');  
?>