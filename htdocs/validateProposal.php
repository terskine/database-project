<?php session_start();
include 'header.php'; 


$conn = oci_connect('SYSTEM', 'password', '//localhost/project');
    $query = "SELECT * FROM PROPOSEPRODUCT WHERE PRODUCTNAME='".$_POST["name"]."'";
    $stid=oci_parse($conn, $query);
    $result = oci_execute($stid);
    if($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        header("Location: proposeProduct.php?err=true");
        exit;
    }
    $query = "SELECT * FROM PRODUCTS WHERE NAME='".$_POST["name"]."'";
    $stid=oci_parse($conn, $query);
    $result = oci_execute($stid);
    if($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        header("Location: proposeProduct.php?err=true");
        exit;
    }
    
    $query = "INSERT INTO PROPOSEPRODUCT VALUES(PROPOSEPRODUCT_PK.NEXTVAL,"
            . "'".$_POST["name"]."',"
            . "".$_SESSION["CUSTOMERID"].","
            . "".$_POST["category"].","
            . "1,'P', NULL, NULL)";
    $stid=oci_parse($conn, $query);
    $result = oci_execute($stid);
    
    oci_close($conn);
    ?>


        <div> Proposal successfully added!<br>
            Click below to return home.<br>
            <a href="index.php">Home</a></div>


<?php include 'footer.php';?>


