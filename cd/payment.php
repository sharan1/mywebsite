<?php
require_once('../connect.php') ;
ini_set('display_errors',1);
$mysqli = new mysqli("localhost", $username, $password, $dbname);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
// mysqli_connect('127.0.0.1',$username,$password) or die( "Unable to connect");
// @mysql_select_db($dbname) or die( "Unable to select database");

$query = "Select * from CD_Payment where `IsPaid` = 1 AND `IsPresent` = 1";
$result = mysqli_query($mysqli, $query)  or die( "Query 1 Failed");
$count = mysqli_num_rows($result);

$query_unpaid = "Select * from CD_Payment where `IsPaid` = 0 AND `IsPresent` = 1";
$result_unpaid = mysqli_query($mysqli, $query_unpaid)  or die( "Query 2 Failed");
mysqli_close($mysqli);
?>


<?php
	$total_people = 33;
?>
<!DOCTYPE html>
<html>

<head>
	<title>CD - Payment</title>
	<meta charset="utf-8">
	<link href="../img/icon.ico" rel="icon" type="img/x-icon"/>
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
	<style>
	#cdForm
	{
		margin-top: 150px;
		margin-left: 250px;
	}

	.background {  position: relative; }

	.background:before {
	    content: "";
	    position: absolute;
	    top: 0;
	    bottom: 0;
	    left: 0;
	    right: 0;
	    z-index: 1;
	    background-image: url('../img/CD_Blue.png');
	    opacity: 0.15;
	}

	.content {
	    position: relative; 
	    z-index: 2;
	}​
	</style>

</head>

<body>
<div class = "background">
	<div class = "content">
<font face="Comic sans MS" color="black" size="3px">

<h1> CD - VASOOLI (April - 2015)</h1>

<?php if($count < $total_people) : ?>
	<!-- Form -->
	<form method="POST" id = "cdForm" class="form-horizontal" action = "record.php" >
	  <div class="form-group">
	    <label for="name" class="col-md-2 control-label">Name:</label>
	    <div class="col-md-4">
	      <input type="text" class="form-control" id="name" name="name" placeholder="Name">
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-md-4 control-label">Paid Amount: 60/-</label>
	  </div>

	  <div class="form-group">
	    <label class="col-md-5 control-label">Total No. of People Paid Till Now : <?php print_r($count); ?>/<?php echo $total_people; ?></label>
	  </div>
	  <div class="form-group">
	    <div class="col-md-offset-2 col-md-10">
	      <button type="submit" class="btn btn-primary">Submit</button>
	    </div>
	  </div>
	</form>
<?php else : ?>
	<center><h2><font color="green">Yayy! Everybody Paid already</font></h2></center>
<?php endif; ?>


	<div class = "container">
		<div class="col-md-6">
		<h4>People who paid already : </h4>

		<table class="table">
			<?php while ($row = mysqli_fetch_assoc($result)) { ?>
			<tr><td ><font color="orange" ><?php echo $row['Name'];?></font></td></tr>
    	<?php } ?>
		</table>
		</div>	

		<div class="col-md-6">
		<h4>People who are yet to pay : </h4>

		<table class="table">
			<?php while ($row1 = mysqli_fetch_assoc($result_unpaid)) { ?>
			<tr><td ><font color="red" ><?php echo $row1['Name'];?></font></td></tr>
    	<?php } ?>
		</table>
		</div>	
	</div>

</font>
</div>
</div>
	<script src="../js/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/cdForm.js"></script>

</body>

</html>
