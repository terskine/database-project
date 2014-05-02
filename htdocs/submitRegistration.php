<?php
	session_start();
        include 'header.php';
	$conn = oci_connect('SYSTEM', 'password', '//localhost/project');
        
        $query = "SELECT USERID FROM CUSTOMER WHERE USERID ='".$_POST["userID"]."'";
        $stid=oci_parse($conn, $query);
	$result = oci_execute($stid);
        if (oci_fetch_array($stid)) {
            $_SESSION["success"] = "false";
            oci_close($conn);
            header('Location: register.php');
            exit;
        }

	$query = 	"INSERT INTO CUSTOMER VALUES(	CUSTOMER_PK.NEXTVAL,'"
                        .$_POST["userID"]."', 
                        '".$_POST["password"]."',
                        '".$_POST["name"]."',
                        '".$_POST["address"]."',
                        '".$_POST["homePhone"]."',
                        '".$_POST["mobilePhone"]."',
                        '".$_POST["email"]."',
                        'S',
                        ".$_POST["country"].")";
	
        $stid=oci_parse($conn, $query);
	$result = oci_execute($stid);
        
        oci_close($conn);	?>

        <div>Registration Successful!<br>
            Click below to return home and login.<br>
            <a href="index.php">Home</a></div>
<?php include 'footer.php'; ?>
