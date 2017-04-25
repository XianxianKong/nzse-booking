<?php
	session_start();
	include '../php_script/connectDB.php';
	
	if(isset($_SESSION['updatingid']))
	{
		$updatingid=$_SESSION['updatingid'];
	}
	$schoolid=$_POST['schoolid'];
	$programmename=$_POST['programmename'];
	$credits=$_POST['credits'];
	$years=$_POST['duryear'];
	$weeks=$_POST['durweek'];
	$duration = $years*51+$weeks;
	//adding new
	if(isset($_POST['submit']))
	{
	
	$result = "INSERT INTO programme(schoolid,duration,name,credits)
				VALUES ('$schoolid','$duration','$programmename','$credits')";
		
		if ($runquery = $conn->query($result))
	{
	$_SESSION['error'] = "The school added.";
	header('location: ./admin_addprogramme.php');
	exit();
	}
	else{
		$_SESSION['error'] = "doesn't work.";
		header('location:./admin_addprogramme.php');
		exit();
	}
	}
  mysqli_close($conn);
?>