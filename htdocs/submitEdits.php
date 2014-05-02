<?php
session_start();
include 'header.php';
include './utilityFunctions.php';
	$conn = oci_connect('SYSTEM', 'password', '//localhost/project');
        
        $query = "SELECT USERID FROM CUSTOMER WHERE USERID ='".$_POST["userID"]."' AND NOT CUSTOMERID = '".$_SESSION["CUSTOMERID"]."'";
        
        $stid=oci_parse($conn, $query);
	$result = oci_execute($stid);
        if (oci_fetch_array($stid)) {
            $_SESSION["success"] = "false";
            header('Location: editProfile.php');
            exit;
        }
        
        
        $query = "UPDATE CUSTOMER SET ".
                "USERID='".$_POST["userID"]."', 
                        NAME='".$_POST["name"]."',
                        ADDRESS='".$_POST["address"]."',
                        RESIDENTPHONENUMBER='".$_POST["homePhone"]."',
                        MOBILENUMBER='".$_POST["mobilePhone"]."',
                        EMAILID='".$_POST["email"]."',
                        COUNTRYID=".$_POST["country"]
                . " WHERE CUSTOMERID='".$_SESSION["CUSTOMERID"]."'";
        
        $stid=oci_parse($conn, $query);
	$result = oci_execute($stid);
        oci_close($conn);
        tryLoginAs("CUSTOMER", $_POST["userID"], $_SESSION["PASSWORD"]); ?>
            <div>Edits Successful!<br>
            Click below to return home<br>
            <a href="index.php">Home</a></div>
<?php include 'footer.php';?>


