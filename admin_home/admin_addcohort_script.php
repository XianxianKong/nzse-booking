<?php
	session_start();
	include '../php_script/connectDB.php';
	
	if(isset($_SESSION['updatingid']))
	{
		$updatingid=$_SESSION['updatingid'];
	}
	$cohortid=$_POST['cohortid'];
	$programmeid=$_POST['programmeid'];
	if ($_POST['roomid'] =='') {
    $_POST['roomid'] = 'NULL';
	}
	$roomid=$_POST['roomid'];
	$startdate=$_POST['startdate'];
	$enddate=$_POST['enddate'];
	$starttime=$_POST['starttime'];
	$endtime=$_POST['endtime'];
	
	//adding new
	if(isset($_POST['submit']))
	{
	
	$result = "INSERT INTO cohort(cohortid,programmeid,roomid,startdate,enddate,starttime,endtime)
				VALUES ('$cohortid','$programmeid',$roomid,'$startdate','$enddate','$starttime','$endtime')";
		
		if ($runquery = $conn->query($result))
	{
	$_SESSION['error'] = "The school added.";
	header('location: ./admin_editcohort.php');
	exit();
	}
	else{
		$_SESSION['error'] = "doesn't work.";
		echo mysqli_error($conn);
		echo gettype($roomid);
		echo $result;
		//header('location:./admin_addcohort.php');
		exit();
	}
	}
  mysqli_close($conn);
?>