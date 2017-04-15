
<div class="col-12 col-m-12"></div>
<?php
if($_SESSION["usertype"]==1)
{
echo "<a href='../admin_home/admin_home.php' class='header'></a>";
}
else
{
	echo "<a href='../user_home/user_home.php' class='header'></a>";
}
?>

<?php include '../php_includes/logoutbutton.php';?>
<div id='username'>
<?php
if($_SESSION["usertype"]==1)
{
echo "<a href='../admin_home/admin_home.php' style='font-size:18px;'>";
}
else
{
	echo "<a href='../user_home/user_home.php' style='font-size:18px;'>";
}
?>
<img src="../pic/username.png" alt="user icon" style="width:37px;height:37px;">
<?php echo $_SESSION["userid"];?></a>
</div>
