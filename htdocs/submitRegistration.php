<?php
	session_start();
	$conn = oci_connect('SYSTEM', 'password', '//localhost/project');
        
        $query = "SELECT USERID FROM CUSTOMER WHERE USERID ='".$_POST["userID"]."'";
        $stid=oci_parse($conn, $query);
	$result = oci_execute($stid);
        if (oci_fetch_array($stid)) {
            $_SESSION["success"] = "false";
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
	echo $query;	
        $stid=oci_parse($conn, $query);
	$result = oci_execute($stid);
        
        echo $result;
        oci_close($conn);	
        header('Location: registrationSuccess.html');
	exit;
