<?php
	
		require("db.php");
		
		@$epf        	= $_POST['epf'];
		@$esi 			= $_POST['esi'];
		@$mutual_fund 	= $_POST['mutual_fund'];
		@$loans 		= $_POST['loans'];
		@$love 		    = $_POST['nil'];


		$sql = mysqli_query($connection,"UPDATE deductions SET epf='$epf', esi='$esi', mutual_fund='$mutual_fund', loans='$loans', nil='$love' WHERE deduction_id='1'");

		if($sql)
		{
			?>
		        <script>
		            alert('Deductions successfully updated...');
		            window.location.href='home_deductions.php';
		        </script>
		    <?php 
		}
		else {
			echo "Not Successfull!"; 
		}
 ?>