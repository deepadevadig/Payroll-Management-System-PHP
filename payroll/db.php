<?php
$database="payroll";
	$connection = mysqli_connect('localhost', 'root', '','payroll');

	if (!$connection)
	{
		die("Database Connection Failed" . mysqli_error());
	}

	$select_db = mysqli_select_db($connection,$database);
	if (!$select_db)
	{
		die("Database Selection Failed" . mysqli_error());
	}
?>