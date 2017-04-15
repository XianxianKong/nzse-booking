<div class="col-3 col-m-3 menu">
	<ul>
		<li>View / Edit</li>
		<?php
		if(isset($_SESSION["usertype"]))
		{
		if($_SESSION["usertype"]==1)
		{
		echo "<li><a href='../admin_home/admin_editroom.php' class='hvr-back-pulse'>Room</a></li>";
		echo "<li><a href='../admin_home/admin_edituser.php' class='hvr-back-pulse'>User</a></li>";
		echo "<li><a href='../admin_home/admin_editcampus.php' class='hvr-back-pulse'>Campus</a></li>";
		echo "<li><a href='../admin_home/admin_editbuilding.php' class='hvr-back-pulse'>Building</a></li>";
		echo "<li><a href='../admin_home/admin_editholiday.php' class='hvr-back-pulse'>Holiday</a></li>";
		echo "<li><a href='../admin_home/admin_edittutor.php' class='hvr-back-pulse'>Tutor</a></li>";
		echo "</ul>";
		echo "<ul>";
		echo "<li>Adhoc Booking</li>";
		echo "<li><a href='../admin_home/admin_home.php' class='hvr-back-pulse'>Make Booking</a></li>";
		echo "<li><a href='../admin_home/admin_editbooking.php' class='hvr-back-pulse'>View Booking</a></li>";
		echo "</ul>";
		echo "<ul>";
		echo "<li>Recurring Booking</li>";
		echo "<li><a href='../admin_home/admin_recurring.php' class='hvr-back-pulse'>Make Booking</a></li>";
		echo "<li><a href='../admin_home/admin_editrecurring.php' class='hvr-back-pulse'>Edit Booking</a></li>";
		echo "<li><a href='../admin_home/admin_view_recurring.php' class='hvr-back-pulse'>View Booking</a></li>";
		echo "</ul>";
		}
		elseif($_SESSION["usertype"]==0)
		{
			echo "<li><a href='../user_home/user_home.php' class='hvr-back-pulse'>Adhoc booking</a></li>";
			echo "<li><a href='../user_home/user_editbooking.php' class='hvr-back-pulse'>View Own Booking</a></li>";
			echo "<li><a href='../user_home/user_view_recurring.php' class='hvr-back-pulse'>View All Booking</a></li>";
		}
		elseif($_SESSION["usertype"]==2)
		{
			echo "<li><a href='../manager_home/manager_home.php' class='hvr-back-pulse'>Adhoc booking</a></li>";
			echo "<li><a href='../manager_home/manager_recurring.php' class='hvr-back-pulse'>Recurring Booking</a></li>";
			echo "<li><a href='../manager_home/manager_editbooking.php' class='hvr-back-pulse'>View My Adhoc Booking</a></li>";
			echo "<li><a href='../manager_home/manager_view_recurring.php' class='hvr-back-pulse'>View All Booking</a></li>";
		}
		}
		?>
	</ul>
</div>