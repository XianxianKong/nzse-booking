<?php
	session_start();
	include '../php_script/connectDB.php';
	
	if(isset($_SESSION['updatingid']))
	{
		$updatingid=$_SESSION['updatingid'];
	}
	$firstname=$_GET['firstname'];
	$lastname=$_GET['lastname'];
	$email=$_GET['email'];
	

 //adding new
	if(isset($_GET['new']))
	{
	$result = "INSERT INTO tutor(lastname,firstname,email)
				VALUES ('$lastname','$firstname','$email')";
		
		if ($runquery = $conn->query($result))
	{
	$_SESSION['error'] = "The tutor added.";
	header('location: ./admin_addtutor.php');
	exit();
	}
	else{
		$_SESSION['error'] = "add doesn't work.";
		header('location:./admin_addtutor.php');
		exit();
	}
	}
	//editing
	if(isset($_GET['submit']))
	{
	$result = "UPDATE tutor SET firstname='$firstname',lastname='$lastname',email='$email' WHERE tutorid='$updatingid'";
		
		if ($runquery = $conn->query($result))
	{
	$_SESSION['error'] = "The tutor edited.";
	header('location: ./admin_addtutor.php');
	exit();
	}
	else{
		$_SESSION['errorid'] = $updatingid;
		$_SESSION['error'] = "edit doesn't work.";
		header('location:./admin_addtutor.php');
		exit();
	}
	}
  mysqli_close($conn);
?>
