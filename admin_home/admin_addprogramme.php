<?php session_start();?>
<?php
	if(!isset($_SESSION['usertype'])|| $_SESSION['usertype']!= 1){
		header('location:../error_page.php');
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<?php $title="Add School"; ?>
	<?php include '../php_includes/head_elements.php'; ?>
	<?php include '../php_includes/alertbox.php'; ?>
</head>
<body>
<div id="page-container">
			<?php include '../php_includes/header.php'; ?>
			<?php include '../php_includes/nav.php'; ?>
			<div class="col-6 col-m-9 content">
				<h1>Add School</h1>
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
						<form id="form1" action="./admin_addprogramme_script.php" method="post">
							<fieldset>
								<?php
								include '../php_script/connectDB.php';
								$sql="SELECT * FROM school";
								$result = mysqli_query($conn,$sql);
								echo "<label for='schoolid'>School name: </label>
								<select name='schoolid' id='schoolid'>";
								echo "<option>Select a School</option>";
								while($row = mysqli_fetch_array($result)) {
									$currentbid = $row['schoolid'];
									echo "<option value=".$currentbid; if(isset($schoolid)) {if($schoolid==$currentbid) {echo " selected";}} echo ">" .$row['name']."</option>";
								}
								echo "</select>";
								mysqli_close($conn);
								?>
								<label for="campusname">duration:</label>
								<input type="number" name="duryear" min="0" max="10" value="0">
								<input type="number" name="durweek" min="0" max="51" value="16">
								<label for="campusname">Programmme name:</label>
								<input type="text" name="programmename" value="">
								<label for="campusname">credits:</label>
								<input type="text" name="credits" value="">
							</fieldset>

							<input type='submit' name='submit' value='submit'>
							
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

			var campusname = document.forms["form1"]["campusname"].value;
			if (campusname == null || campusname == "")
			{
				d += 500;
				alertify.set({ delay: d });
				alertify.log("campus name is required");
				flag=false;
			}
			var address = document.forms["form1"]["address"].value;
			if (address == null || address == "")
			{
				d += 500;
				alertify.set({ delay: d });
				alertify.log("address is required");
				flag=false;
			}
			return flag;
		});
		</script>

<?php
	unset($_SESSION['campusname'],$_SESSION['campusid'],$_SESSION['address']);
?>
<br><br>
<div id = "index_footer">
<?php include '../php_includes/footer.php';?>
</div>
</body>
</html>