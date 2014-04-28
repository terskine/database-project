<?php
    session_start();
    
    $conn = oci_connect('SYSTEM', 'password', '//localhost/project');
    
    $query = "INSERT INTO OFFER VALUES (OFFER_PK.NEXTVAL, '"
                .$_POST["type"]."', 
                ".$_POST["country"].",
                ".$_SESSION["EMPLOYEEID"].",
                TO_DATE('".$_POST["date"]."', 'yyyy-mm-dd'),
                ".$_POST["validity"].",
                ".$_POST["discount"].",
                '".$_POST["description"]."')";
    echo $query;          
        $stid=oci_parse($conn, $query);
	$result = oci_execute($stid);
        oci_close($conn);
        header('Location: offerSuccess.php');
	exit;

