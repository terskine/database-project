<?php session_start();
include 'header.php';?>
<form action="validateRetire.php" method="post">
    Product to Retire:<select name="product" required>
        <?php 
            $conn = oci_connect('SYSTEM', 'password', '//localhost/project');
            $stid=oci_parse($conn, "SELECT PRODUCTID, NAME FROM PRODUCTS WHERE STATUS = 'A'");
            oci_execute($stid);
            while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    echo "<option value=".$row['PRODUCTID'].">".$row['NAME']."</option>";
            }
            oci_close($conn);
        ?>
    </select><br>
    <input type="submit" value="Submit">
</form>
<?php include 'footer.php';?>


