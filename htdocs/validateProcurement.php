<?php session_start();

$conn = oci_connect('SYSTEM', 'password', '//localhost/project');
    
    $query = "INSERT INTO PROCUREMENT VALUES (PROCUREMENT_PK.NEXTVAL, "
                .$_POST["product"].", 
                ".$_SESSION["EMPLOYEEID"].",
                '".$_POST["quantity"]."')";
             
    
    $stid=oci_parse($conn, $query);
    $result = oci_execute($stid);
    oci_close($conn);
    $conn = oci_connect('SYSTEM', 'password', '//localhost/project');
    
    // What if we procure more than the max num of products?
    $query = "UPDATE PRODUCTS "
            . "SET STOCK=STOCK+".$_POST["quantity"].
            " WHERE PRODUCTID=".$_POST["product"];
    echo $query;
    $stid=oci_parse($conn, $query);
    $result = oci_execute($stid);
    
    oci_close($conn);
    // Put procurement id here
    header('Location: procurementSuccess.php?id=5');
    exit;


