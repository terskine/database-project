<?php session_start(); 
if ($_SESSION["success"] == "false") {
    echo 'UserID exists! Please return home to login or choose a different UserID<br>';
    session_destroy();
    
}
    ?>

<form id="registration" onsubmit ="return validateForm()" action="submitRegistration.php" method="post">
    *Full Name: 		<input type="text" name="name" maxlength="20" required><br>
    *Address:		<input type="text" name="address" maxlength="30" required><br>
    *Home Phone: 	<input type="text" name="homePhone" maxlength="12" required><br>
        *Mobile Phone: 	<input type="text" name="mobilePhone" maxlength="12" required><br>
	*Email: 			<input type="text" name="email" maxlength="25" required><br>
        *Country: 		<select name="country" required>
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
	*UserID: 			<input type="text" name="userID" maxlength="15" required><br>
	*Password: 			<input type="password" name="password" id="password" required maxlength="15"><br>
	*Confirm Password: 	<input type="password" name="confirmPassword" id="confirmPassword" maxlength="15"><br>
						<span name="passwordMessage" required id="passwordMessage"></span><br>
						<!--<INPUT TYPE="button" NAME="button" Value="Submit" onClick="submitRegistration()">-->
                                                <input type="submit" value="Submit">
                                                <span> * Indicates a required field </span>	
	<script>
		function validateForm() {
                    if (document.getElementById("password").value != document.getElementById("confirmPassword").value)  {
			document.getElementById("passwordMessage").innerHTML = "Passwords do not match!";
                        return false;
                    } else if (document.getElementById("password").value == "") {
                        document.getElementById("passwordMessage").innerHTML = "Please enter a password!";
                        return false;
                    }

                    return true;
		}
	</script>
	
</form>