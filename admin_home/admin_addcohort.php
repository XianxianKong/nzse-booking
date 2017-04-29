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
				<h1>Add Cohort</h1>
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
						<form id="form1" action="./admin_addcohort_script.php" method="post">
							<fieldset>
								<input type="text" name="cohortid" placeholder = "Cohort">
								<?php
								include '../php_script/connectDB.php';
								$sql="SELECT * FROM campus";
								$result = mysqli_query($conn,$sql);
								echo "<select id='campusid' name='campusid'  onchange='changeOptions(this.value)'>";
								echo "<option>Select campus</option>";
								while($row = mysqli_fetch_array($result)) {
									$currentid = $row['campusid'];

									echo "<option value='$currentid'"; if(isset($campusid)) {if($campusid==$currentid) {echo " selected";}} echo ">" .$row['campusname']."</option>";
								}
								echo "</select>";
								mysqli_close($conn);
								?>
								<?php
								include '../php_script/connectDB.php';
								$sql="SELECT * FROM programme";
								$result = mysqli_query($conn,$sql);
								echo "
								<select name='programmeid' id='programmeid'>";
								echo "<option >Select a programme</option>";
								while($row = mysqli_fetch_array($result)) {
									$currentbid = $row['programmeid'];
									echo "<option value=".$currentbid; if(isset($schoolid)) {if($schoolid==$currentbid) {echo " selected";}} echo ">" .$row['name']."</option>";
								}
								echo "</select>";
								mysqli_close($conn);
								?>
								<?php
								include '../php_script/connectDB.php';
								$sql="SELECT * FROM room";
								$result = mysqli_query($conn,$sql);
								echo "
								<select name='roomid' id='roomid'>";
								echo "<option >Select a room</option>";
								echo "</select>";
								mysqli_close($conn);
								?>
								
								
								<label for="campusname" >Start Date:</label>
								<input type="date" name="startdate" >
								<label for="campusname" >End Date:</label>
								<input type="date" name="enddate" >
								<label for="campusname" >Start 	Time:</label>
								<input type="time" name="starttime" >
								<label for="campusname" >End Time:</label>
								<input type="time" name="endtime" >
							</fieldset>

							<input type='submit' name='submit' value='submit'>
							
						</form>
					</div>
				</div>
			</div>
</div>

<script>
function changeOptions(campusid) {
	 
            // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp1 = new XMLHttpRequest();
        xmlhttp1.onreadystatechange = function() {
            if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
                document.getElementById("programmeid").innerHTML = xmlhttp1.responseText;
            }
        }
		
        xmlhttp1.open("GET","../php_script/getprogrammeform_script.php?campusid="+campusid,true);
        xmlhttp1.send();
		xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.onreadystatechange = function() {
            if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
                document.getElementById("roomid").innerHTML = xmlhttp2.responseText;
            }
        }
		
        xmlhttp2.open("GET","../php_script/getroomform_script.php?campusid="+campusid,true);
        xmlhttp2.send();
		
    }
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