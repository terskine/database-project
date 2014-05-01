<?php session_start();

$conn = oci_connect('SYSTEM', 'password', '//localhost/project');
$stid=oci_parse($conn, "SELECT * FROM PROPOSEPRODUCT NATURAL JOIN CATEGORY WHERE STATUS='P'");
oci_execute($stid);
$numAccepted = 0;
$numRejected = 0;
while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    if($_POST[$row["PROPOSALID"]."_SELECTION"] == "accept") {
        $query = "UPDATE PROPOSEPRODUCT SET STATUS ='A', "
                . "QUANTITY=".$_POST[$row["PROPOSALID"]."_QUANTITY"].", "
                . "EMPLOYEEID=".$_SESSION["EMPLOYEEID"].
                " WHERE PROPOSALID=".$row["PROPOSALID"];
        $numAccepted++;
    } else if ($_POST[$row["PROPOSALID"]."_SELECTION"] == "reject") {
        $query = "UPDATE PROPOSEPRODUCT SET STATUS ='R', "
                . "EMPLOYEEID=".$_SESSION["EMPLOYEEID"]." "
                . "WHERE PROPOSALID=".$row["PROPOSALID"];
        $numRejected++;
    } else {
        continue;
    }
    
    $stid=oci_parse($conn, $query);
    oci_execute($stid);
    
}

    oci_close($conn);
    header('Location: analyzeSuccess.php?a='.$numAccepted."&r=".$numRejected);
    exit;



