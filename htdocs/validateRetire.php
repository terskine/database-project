<?php session_start();
include 'header.php';

    $conn = oci_connect('SYSTEM', 'password', '//localhost/project');
    $stid=oci_parse($conn, "UPDATE PRODUCTS SET STATUS='R' WHERE PRODUCTID = '".$_POST["product"]."'");
    oci_execute($stid);
    oci_close($conn);
?>

        <div>Retire Successful!<br>
            Click below to return home<br>
            <a href="index.php">Home</a></div>
<?php include 'footer.php';?>

