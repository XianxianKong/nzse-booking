<?php session_start(); ?>
<?php
	if(!isset($_SESSION['usertype'])|| $_SESSION['usertype']!= 1){
		header('location:../error_page.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<?php $title="Edit School"; ?>
	<?php include '../php_includes/head_elements.php'; ?>
	<?php include '../php_includes/alertbox.php'; ?>
</head>
<body>
<div id="page-container">
			<?php include '../php_includes/header.php'; ?>
			<?php include '../php_includes/nav.php'; ?>
			<div class="col-6 col-m-9 content">
				<h1>Edit School</h1>

<div id='error'>
		<?php
				if(isset($_SESSION['error']))
				{
					print $_SESSION['error'];
					unset($_SESSION['error']);
				}

		?>
</div><!--error--><br />
<div id="sidebar">
		<a class='add' href='./admin_addschool.php'><img src='../pic/Add.png' /><span></span></a>
	</div>
<div class="tables">
<?php
include '../php_script/connectDB.php';
	if(isset($_GET['deletingid']))
	{
	$deletingid=$_GET['deletingid'];
	unset($_GET['deletingid']);
	$result = "DELETE FROM school WHERE schoolid='".$deletingid."'";
	if($runquery=mysqli_query($conn,$result))
			{
			$_SESSION['error'] = "deleted successfully";
			header('location: ./admin_editschool.php');
			exit();
			}
			else
			{
				$_SESSION['error'] = "query wrong";
			header('location: ./admin_editschool.php');
			exit();
			}
	}
		mysqli_close($conn);
?>
<?php
	include '../php_script/connectDB.php';
	$result = "SELECT h.* FROM school h";
		echo "<table id='student_resit' class='border'>
		<thead>
		<tr>
		<th></th>
		<th>School</th>
		</tr>
		</thead>";
		if ($runquery = $conn->query($result))
		{
			while($row = $runquery->fetch_assoc())
			{
				$schoolid = $row['schoolid'];
				$did = json_encode($row['schoolid']);
				echo "<tr>";
				echo "<td> <!--<a href='./admin_addschool.php?edit=$schoolid'><img src='../pic/edit.png' /></a>--> <a href='javascript:confirmAction($did)'><img src='../pic/delete.png' /></a></td>";
        echo "<td contenteditable=\"true\" data-old-value='".$row['name']."' onBlur=\"saveInlineEdit(this,'name','".$row['schoolid']."','school')\" onClick=\"highlightEdit(this);\">" . $row['name']."</td>";
				echo "</tr>";
			}
		}
		echo "</table>";
		mysqli_close($conn);
		?>
</div>
</div>
		</div>
<script>
function confirmAction (id) {
    var did=id;
	alertify.confirm('Are you sure you wish to remove '+did+'?', function(e) {
        if (e) {

            window.location.href = "./admin_editschool.php?deletingid=" + did;
            }

    });
}
</script>

<br><br><br><br><br>
<?php include '../php_includes/footer.php';?>
</body>
</html>
