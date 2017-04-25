<?php session_start();?>
<?php 
	if(!isset($_SESSION['usertype'])|| $_SESSION['usertype']!= 1){
		header('location:../error_page.php');
	}
	
?>
<!--bring values into form-->
<?php
	if(isset($_GET['copy']) || isset($_GET['edit']) || isset($_SESSION['errorid']))
	{
		if(isset($_GET['copy']))
		{
		$userid=$_GET['copy'];
		}
		elseif(isset($_GET['edit']))
		{
		$userid=$_GET['edit'];
		}
		else
		{
			$userid=$_SESSION['errorid'];
			unset($_SESSION['errorid']);
		}
	include '../php_script/connectDB.php';
	$result = "SELECT u.* FROM user u WHERE u.userid='".$userid."'";
		if($runquery=mysqli_query($conn,$result))
		{
			while($row = $runquery->fetch_assoc())
			{
				$_SESSION['uid']=$row['userid'];
				$_SESSION['email']=$row['email'];
				
			}
		}
		else
		{
			$_SESSION['error']="couldnt bring copied data";
		}
		mysqli_close($conn);
	}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<?php $title="Add user"; ?>
	<?php include '../php_includes/head_elements.php'; ?>
	<?php include '../php_includes/alertbox.php'; ?>
</head>
<body>
<div id="page-container">
			<?php include '../php_includes/header.php'; ?>
			<?php include '../php_includes/nav.php'; ?>
			<div class="col-6 col-m-9 content">
				<h1>User</h1>	
		
<div id='error'>
		<?php
				if(isset($_SESSION['error']))
				{	
					print $_SESSION['error'];	
					unset($_SESSION['error']);
				}
				
		?>
</div><!--error--><br />
<div id="container">
<div class="form">
<form id="form1" action="./admin_adduser_script.php">
<fieldset>
<label for="userid">User Name</label>
<?php if(!isset($_GET['edit'])) {echo "<input type='text' name='userid' value='";}
if(isset($_SESSION['uid'])) {echo $_SESSION['uid'];}
if(!isset($_GET['edit'])) {echo "'>";}
?>
User type: 
<label for='usertype'>
<input type="radio" name="usertype" value="1" >Admin</label>
<label><input type="radio" name="usertype" value="2" >Manager</label>
<label><input type="radio" name="usertype" value="0" checked>User</label>
<label for="email">Email:</label>
<input type="email" name="email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>">

</fieldset>

<?php if(isset($_GET['edit'])) {echo "<input type='submit' name='submit' value='submit'>";$_SESSION['updatingid']=$_SESSION['uid'];} 
else {echo "<input type='submit' name='new' value='submit'>";}
  ?>

</form>
</div>
</div>
		</div>
		</div>
<script>
	$("#form1").on('submit', function () 
		{	
			var flag;
			var d = 5000;
			var userid = document.forms["form1"]["userid"].value;
			if (userid == null || userid == "") 
			{
				d += 500;
				alertify.set({ delay: d });
				alertify.log("user id is required");
				flag=false;
			}
			var email = document.forms["form1"]["email"].value;
			if (email == null || email == "") 
			{
				d += 500;
				alertify.set({ delay: d });
				alertify.log("email is required");
				flag=false;
			}
		
			return flag;
		});
		</script>

<?php
	unset($_SESSION['uid'],$_SESSION['email']);
?>
<br><br>

<?php include '../php_includes/footer.php';?>

</body>
</html>