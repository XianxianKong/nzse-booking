<?php
	session_start();
	include '../php_script/connectDB.php';
	
	if(isset($_SESSION['updatingid']))
	{
		$updatingid=$_SESSION['updatingid'];
	}
	$usertype=$_GET['usertype'];
	$userid=$_GET['userid'];
	$useraccesslevel=$_GET['useraccesslevel'];
	$email=$_GET['email'];
	
	//checking user id
 $query = "SELECT COUNT(*) as cnt FROM user WHERE userid= '".$userid."'";
$runquery = mysqli_query($conn, ($query));
$row = mysqli_fetch_array($runquery); 
$cnt = $row['cnt'];

if($cnt >= 1)
{
	$_SESSION['errorid'] = $userid;
	$_SESSION['error'] = "The user id already exists.";
	header('location: ./admin_adduser.php');
	exit();
 }
	 //adding new
	if(isset($_GET['new']))
	{
	$password="password";
	$password = sha1($password);
	$result = "INSERT INTO user(usertype,userid,useraccesslevel,password,email)
				VALUES ('$usertype','$userid','$useraccesslevel','$password','$email')";
		
		if ($runquery = $conn->query($result))
	{
	$_SESSION['error'] = "The user added.";
	header('location: ./admin_adduser.php');
	exit();
	}
	else{
		$_SESSION['errorid'] = $userid;
		$_SESSION['error'] = "doesn't work.";
		header('location:./admin_adduser.php');
		exit();
	}
	}
	//editing
	if(isset($_GET['submit']))
	{
	
	$result = "UPDATE user SET usertype='$usertype',useraccesslevel='$useraccesslevel',email='$email' WHERE userid='$updatingid'";
		
		if ($runquery = $conn->query($result))
	{
	$_SESSION['error'] = "The user edited.";
	header('location: ./admin_adduser.php');
	exit();
	}
	else{
		$_SESSION['errorid'] = $updatingid;
		$_SESSION['error'] = "doesn't work.";
		header('location:./admin_adduser.php');
		exit();
	}
	}
  mysqli_close($conn);
?>
