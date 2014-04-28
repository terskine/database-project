<?php session_start(); 
if ($_SESSION["success"] == "false") {
    echo 'UserID exists! Please choose a different UserID<br>';
    session_destroy();
    
}
    ?>
<form id="profile" action="submitEdits.php" method="post">
    *Full Name: 		<input type="text" name="name" maxlength="20" required value=<?php getValue("NAME")?>><br>
    *Address:		<input type="text" name="address" maxlength="30" required value=<?php getValue("ADDRESS")?>><br>
    *Home Phone: 	<input type="text" name="homePhone" maxlength="12" required value=<?php getValue("RESIDENTPHONENUMBER")?>><br>
        *Mobile Phone: 	<input type="text" name="mobilePhone" maxlength="12" required value=<?php getValue("MOBILENUMBER")?>><br>
	*Email: 			<input type="text" name="email" maxlength="25" required value=<?php getValue("EMAILID")?>><br>
        *Country: 		<select name="country" required value=<?php getValue("NAME")?>>
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
	*UserID: 			<input type="text" name="userID" maxlength="15" required value=<?php getValue("USERID")?>><br>
                                                <input type="submit" value="Submit">
                                                <span> * Indicates a required field </span>	
        
        <?php function getValue($value) {
            //echo $_SESSION["NAME"];
            echo '"'.$_SESSION[$value].'"';
        }
	?>
</form>

