<?php session_start(); 
include 'header.php';
    include './utilityFunctions.php';
    
if ($_SESSION["success"] == "false") {
    echo 'UserID exists! Please choose a different UserID<br>';
    session_destroy();
    
}
    ?>
Edit Profile<br>
<form id="profile" action="submitEdits.php" method="post">
    *Full Name: 		<input type="text" name="name" maxlength="20" required value="<?php echo getValue("NAME")?>"><br>
    *Address:		<input type="text" name="address" maxlength="30" required value="<?php echo getValue("ADDRESS")?>"><br>
    *Home Phone: 	<input type="text" name="homePhone" maxlength="12" required value="<?php echo getValue("RESIDENTPHONENUMBER")?>"><br>
        *Mobile Phone: 	<input type="text" name="mobilePhone" maxlength="12" required value="<?php echo getValue("MOBILENUMBER")?>"><br>
	*Email: 			<input type="text" name="email" maxlength="25" required value="<?php echo getValue("EMAILID")?>"><br>
        *Country: 		<?php getCountries(getValue("COUNTRYID"))?><br>
	*UserID: 			<input type="text" name="userID" maxlength="15" required value="<?php echo getValue("USERID")?>"><br>
                                                <input type="submit" value="Submit">
                                                <span> * Indicates a required field </span>	
        
        <?php function getValue($value) {
            //echo $_SESSION["NAME"];
            return $_SESSION[$value];
            
        }
	?>
</form>

<?php include 'footer.php';?>

