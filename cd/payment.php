<?php
require_once('../connect.php') ;
ini_set('display_errors',1);

mysql_connect('localhost',$username,$password) or die( "Unable to connect");
@mysql_select_db($dbname) or die( "Unable to select database");

$query = "Select * from CD_Payment";
$result = mysql_query($query)  or die( "Query Failed");
$count = mysql_num_rows($result);
mysql_close();
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
	    opacity: 0.25;
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

<h1> Payment Collection - CD Monthly Lunch (25/-)</h1>


	<!-- Form -->
	<form method="POST" id = "cdForm" class="form-horizontal" action = "record.php" >
	  <div class="form-group">
	    <label for="name" class="col-md-2 control-label">Name:</label>
	    <div class="col-md-4">
	      <input type="text" class="form-control" id="name" name="name" placeholder="Name">
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-md-4 control-label">Paid Amount: 25/-</label>
	  </div>

	  <div class="form-group">
	    <label class="col-md-5 control-label">Total No. of People Paid Till Now : <?php print_r($count); ?>/27</label>
	  </div>
	  <div class="form-group">
	    <div class="col-md-offset-2 col-md-10">
	      <button type="submit" class="btn btn-primary">Submit</button>
	    </div>
	  </div>
	</form>


	<div class = "container">
		<h4>People who paid already : </h4>

		<table class="table">
			<?php while ($row = mysql_fetch_assoc($result)) { ?>
			<tr><td ><font color="orange" ><?php echo $row['Name'];?></font></td></tr>
    	<?php } ?>
		</table>
		
			
		
	</div>

</font>
</div>
</div>
	<script src="../js/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/cdForm.js"></script>

</body>

</html>
