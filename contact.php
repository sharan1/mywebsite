<?php include 'header.php'; ?>

	<font face="Comic sans MS" color="black" size="3px">

	<!-- Form -->
	<form method="POST" id = "myForm" class="form-horizontal" action = "saveDetails.php" >
	  <div class="form-group">
	    <label for="name" class="col-md-2 control-label">Name:</label>
	    <div class="col-md-4">
	      <input type="text" class="form-control" id="name" name="name" placeholder="Name">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="email" class="col-md-2 control-label">Email-Id:</label>
	    <div class="col-md-4">
	      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="mobile" class="col-md-2 control-label">Mobile Number:</label>
	    <div class="col-md-4">
	      <input type="tel" class="form-control" id="mobile"  name="mobile" placeholder="Mobile No.">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="reason" class="col-md-2 control-label">Reason for contact:</label>
	    <div class="col-md-4">
	      <textarea type="textarea" width="10px" height="10px"  name="reason" class="form-control" id="reason" placeholder="Description..."></textarea>
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-offset-2 col-md-10">
	      <button type="submit" class="btn btn-primary">Submit</button>
	    </div>
	  </div>
	</form>
	</font>

<?php include 'footer.php'; ?>
<script type="text/javascript" src="js/myForm.js"></script>
