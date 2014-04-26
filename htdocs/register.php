
// Validation to be done: Data in required fields, unique fields are unique
<form id="registration" action="submitRegistration.php" method="post">
	Full Name: 		<input type="text" name="name" maxlength="20"><br>
	Address:		<input type="text" name="address" maxlength="30"><br>
	Home Phone: 	<input type="text" name="homePhone" maxlength="12"><br>
	Mobile Phone: 	<input type="text" name="mobilePhone" maxlength="12"><br>
	Email: 			<input type="text" name="email" maxlength="25"><br>
	Country: 		<select name="country">
						<?php 
						$conn = oci_connect('SYSTEM', 'password', '//localhost/project');
						$stid=oci_parse($conn, "SELECT * FROM COUNTRY");
						oci_execute($stid);
						while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
							echo "<option value=".$row['COUNTRYID'].">".$row['COUNTRYNAME']."</option>";
						}
						oci_close($conn);
						?>
					</select><br>
	UserID: 			<input type="text" name="userID" maxlength="15"><br>
	Password: 			<input type="password" name="password" id="password" maxlength="15"><br>
	Confirm Password: 	<input type="password" name="confirmPassword" id="confirmPassword" maxlength="15"><br>
						<span name="passwordMessage" id="passwordMessage"></span><br>
						<INPUT TYPE="button" NAME="button" Value="Submit" onClick="submitRegistration()">
		
	<script>
		function submitRegistration() {
			if (document.getElementById("password").value != document.getElementById("confirmPassword").value)  {
				document.getElementById("passwordMessage").innerHTML = "Passwords do not match!";
			} else if (document.getElementById("password").value == "") {
				document.getElementById("passwordMessage").innerHTML = "Please enter a password!";
			} else {
				document.getElementById("registration").submit();
			}
		}
	</script>
	
</form>