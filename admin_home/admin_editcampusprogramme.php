<?php session_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
	<?php $title="Edit Room"; ?>
	<?php include '../php_includes/head_elements.php'; ?>
	<?php include '../php_includes/alertbox.php'; ?>
	<link rel="stylesheet" type="text/css" href="../css/stickyheader.css">
	<link rel="stylesheet" type="text/css" href="../css/sidebar.css">
   </head>
	<body>
	<div id="page-container">
		<?php include '../php_includes/header.php'; ?>
		<?php include '../php_includes/nav.php'; ?>
			<div class="col-6 col-m-9 content">
				<h1>Edit Cohort</h1>
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
					<a class='add' href='./admin_addcampusprogramme.php'><img src='../pic/Add.png' /></a>
				</div>
			</div>
	</div>
		<?php include '../php_includes/footer.php';?>
	</body>
</html>
