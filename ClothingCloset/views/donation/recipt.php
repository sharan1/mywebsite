<?php

?>

<div class="recipt-container">
	<div class="recipt-title">
		<h1>Clothing Closet</h1>
		<h6>Phi Beta Lambda Clothing Closet</h6>
		<h6>Ketner School of Business, Catawaba College</h6>
		<h6>2300 W Innes Street</h6>
		<h6>Sailsbury, NC 28144</h6>
		<h6>http://www.catawba.edu</h6>
		<br>
		<h2>Receipt of Charitable Donation</h2>
	</div>
	<br>
	<br>
	<div class="body">
		The Clothing Closet for UNC Charlotte acknowledges and expresses appreciation for the following contribution:
		<br>
		<br>

		<h4>
			Donation of clothing: <b><?=$model->NumItems; ?></b>
		</h4>

		<h4>
			Donation Received from: <b><?=$model->person->fullName; ?></b>
		</h4>

		<h4>
			Date of Donation: <b><?=$model->AddedOn; ?></b>
		</h4>

		<br>
		<br>

		Catawaba College is a recognized 501 (c) (3) not-for-profit orrganization;

		<p>Federal ID number: <u>56-0530251</u></p>

		<br>
		<br>

		<h5><u>Donation Received by: </u><b><?=$model->addedBy->fullName; ?></b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</h5>
		<br>
	</div>
</div>