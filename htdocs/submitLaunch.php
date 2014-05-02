<?php session_start();
include 'header.php';

$conn = oci_connect('SYSTEM', 'password', '//localhost/project');
$stid=oci_parse($conn, "SELECT * FROM PROPOSEPRODUCT NATURAL JOIN CATEGORY WHERE STATUS='A'");
oci_execute($stid);
$numLaunched = 0;
while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    if(isset($_POST[$row["PROPOSALID"]."_select"])) {
        $query = "UPDATE PROPOSEPRODUCT SET STATUS ='L'".
               " WHERE PROPOSALID=".$row["PROPOSALID"];
        //echo $query.'<br>';
        $stid=oci_parse($conn, $query);
        oci_execute($stid);
        
        $query = "INSERT INTO PRODUCTS VALUES(PRODUCTS_PK.NEXTVAL, "
                .$row['CATEGORYID'].", "
                .$_SESSION['EMPLOYEEID'].", '"
                .$row['PRODUCTNAME']."', "
                .$_POST[$row["PROPOSALID"]."_cost"].", "
                .$_POST[$row["PROPOSALID"]."_warranty"].", "
                .$_POST[$row["PROPOSALID"]."_stock"].", "
                . "'A',"              
                .$_POST[$row["PROPOSALID"]."_reorder"].")";
        //echo $query.'<br>';
        $stid=oci_parse($conn, $query);
        oci_execute($stid);
        
        $numLaunched++;
    }     
    
}
        oci_close($conn);?>


        <div> Launch was successful!<br>
            <?php echo $numLaunched;?> products launched!<br>
            Click below to return home.<br>
            <a href="index.php">Home</a></div>
<?php include 'footer.php';?>

