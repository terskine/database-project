

<?php 


    session_start();



	if ($_SESSION['user'] == 'error')
	{
		echo 'ERROR LOGGING IN. Please try again';
		printLoginForm();
	}
	else if ($_SESSION['user'] == 'CUSTOMER')
	{
		echo 'welcome customer '.$_SESSION['NAME'].'<br>';
		echo '<a href="logout.php">Logout</a><br>';
		echo '<a href="enrollCustomer.php">Enroll Customer</a><br>';
		echo '<a href="editProfile.php">Edit Profile</a><br>';
		echo '<a href="proposeProduct.php">Propose Product</a><br>';
	}
	// Assume ROLEID 1 corrosponds to Order Manager
	else if ($_SESSION['ROLEID'] == '1')
	{
		echo 'welcome Order Manager '.$_SESSION['NAME'].'<br>';
		echo '<a href="logout.php">Logout</a><br>';
		echo '<a href="analyzeProposal.php">Analyze Product</a><br>';
		echo '<a href="procureProduct.php">Procure Product</a><br>';
		echo '<a href="viewAllOrders.php">Clear Orders</a><br>';
	}
	
	// Assume ROLEID 2 is Customer Relationship Manager
	else if ($_SESSION['ROLEID'] == '2')
	{
		echo 'Welcome Customer Relationship Manager '.$_SESSION['NAME'].'<br>';
		echo '<a href="logout.php">Logout</a><br>';
		echo '<a href="releaseOffer.php">Release Offer</a><br>';
		echo '<a href="upgradeCustomer.php">Upgrade Customer</a><br>';
	}
	
	// Assume ROLEID 3 is Product Manager
	else if ($_SESSION['ROLEID'] == '3')
	{
		echo 'Welcome Product Manager '.$_SESSION['NAME'].'<br>';
		echo '<a href="logout.php">Logout</a><br>';
		echo '<a href="launchProduct.php">Launch Product</a><br>';
		echo '<a href="retireProduct.php">Retire Product</a><br>';
	}
	
	// Otherwise no login has been attempted
	else
	{
		printLoginForm();
	}
	
	function printLoginForm()
	{
		echo'	<form action="validateLogin.php" method="post">
					Username: <input type="text" name="username"><br>
					Password: <input type="password" name="password"><br>
					<input type="submit" value="Submit">
				</form>
				<a href="register.php">Register</a>';	
	}

?>	
