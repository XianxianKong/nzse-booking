<?php session_start();?>
<?php 
	if(!isset($_SESSION['usertype'])|| $_SESSION['usertype']!= 1){
		header('location:../error_page.php');
	}
	
?>
<!--bring values into form-->
<?php
	if(isset($_GET['copy']) || isset($_GET['edit'])|| isset($_SESSION['errorid']))
	{
		if(isset($_GET['copy']))
		{
		$holidayid=$_GET['copy'];
		}
		elseif(isset($_GET['edit']))
		{
		$holidayid=$_GET['edit'];
		}
		else
		{
			$holidayid=$_SESSION['errorid'];
			unset($_SESSION['errorid']);
		}
	include '../php_script/connectDB.php';
	$result = "SELECT h.* FROM tutor h WHERE h.tutorid='".$holidayid."'";
		if($runquery=mysqli_query($conn,$result))
		{
			while($row = $runquery->fetch_assoc())
			{
				
				$firstname=$row['firstname'];
				$lastname=$row['lastname'];
				$email=$row['email'];
		
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
	<?php $title="Add Tutor"; ?>
	<?php include '../php_includes/head_elements.php'; ?>
	<?php include '../php_includes/alertbox.php'; ?>
</head>
<body>
<div id="page-container">


			<?php include '../php_includes/header.php'; ?>
			<?php include '../php_includes/nav.php'; ?>
			<div class="col-6 col-m-9 content">
				<h1>Tutor</h1>	
	
<div id='error'>
		<?php
				if(isset($_SESSION['error']))
				{	
					print $_SESSION['error'];
					if(isset($_SESSION['lead']))
					{
						print $_SESSION['lead'];
					}
					unset($_SESSION['error']);
					unset($_SESSION['lead']);
				}
				
		?>
</div><!--error--><br />
<div id="container">


<div class="form">
<form id="container" action="./admin_addtutor_script.php">
 <fieldset>

<label for="firstname">First name:</label>
<input type="text" name="firstname" value="<?php if(isset($firstname)) echo $firstname;?>">
<label for="lastname">Last name:</label>
<input type="text" name="lastname" value="<?php if(isset($lastname)) echo $lastname;?>">
<label for="email">Email:</label>
<input type="email" name="email" value="<?php if(isset($email)) echo $email;?>">



<?php
if(isset($_GET['edit'])) {echo "<input type='submit' name='submit' value='submit'>";$_SESSION['updatingid']=$holidayid;} else {echo "<input type='submit' name='new' value='submit' >";}
?>

</form>
</div>
</div>
		</div>
		</div>
<script>
	$("#container").on('submit', function () 
		{	
			var flag;
			var d = 5000;
			
			var buildingname = document.forms["container"]["firstname"].value;
			if (buildingname == null || buildingname == "") 
			{
				d += 500;
				alertify.set({ delay: d });
				alertify.log("first name is required");
				flag=false;
			}
			var campusid = document.forms["container"]["lastname"].value;
			if (campusid == null || campusid == "") 
			{
				d += 500;
				alertify.set({ delay: d });
				alertify.log("last name is required");
				flag=false;
			}
			var email = document.forms["container"]["email"].value;
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

<br><br>

<?php include '../php_includes/footer.php';?>

</body>
</html>