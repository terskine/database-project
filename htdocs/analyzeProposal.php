<?php session_start();
include './header.php';

$conn = oci_connect('SYSTEM', 'password', '//localhost/project');
        $stid=oci_parse($conn, "SELECT * FROM PROPOSEPRODUCT NATURAL JOIN CATEGORY WHERE STATUS='P'");
        oci_execute($stid);
        if($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            echo 'Analyze Proposals<br>';
            echo '<form method="post" action="validateAnalyze.php">
    <table>
        <tr>
            <th>Proposal ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Votes</th>
            <th>Quantity</th>
            <th>Accept</th>
            <th>Reject</th>
        </tr>';
do {
            echo '<tr>';
            echo '<td>'.$row["PROPOSALID"].'</td>';
            echo '<td>'.$row["PRODUCTNAME"].'</td>';
            echo '<td>'.$row["CATEGORYNAME"].'</td>';
            echo '<td>'.$row["VOTES"].'</td>';
            echo '<td><input name="'.$row["PROPOSALID"].'_QUANTITY" type="number" value="0" min="0"></td>';
            echo '<td><input name="'.$row["PROPOSALID"].'_SELECTION" value="accept" type="radio"></td>';
            echo '<td><input name="'.$row["PROPOSALID"].'_SELECTION" value="reject" type="radio"></td>';
            echo'</tr>';
        } while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS));
        oci_close($conn); 
        echo '</table>
    <input type="submit" value="Submit">
</form>';
        
        
        } else {
            echo 'No products to analyze!';
        }
        include './footer.php';
?>

<!--<form method="post" action="validateAnalyze.php">
    <table>
        <tr>
            <th>Proposal ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Votes</th>
            <th>Quantity</th>
            <th>Accept</th>
            <th>Reject</th>
        </tr>
        /
//        $conn = oci_connect('SYSTEM', 'password', '//localhost/project');
//        $stid=oci_parse($conn, "SELECT * FROM PROPOSEPRODUCT NATURAL JOIN CATEGORY WHERE STATUS='P'");
//        oci_execute($stid);
//        while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
//            echo '<tr>';
//            echo '<td>'.$row["PROPOSALID"].'</td>';
//            echo '<td>'.$row["PRODUCTNAME"].'</td>';
//            echo '<td>'.$row["CATEGORYNAME"].'</td>';
//            echo '<td>'.$row["VOTES"].'</td>';
//            echo '<td><input name="'.$row["PROPOSALID"].'_QUANTITY" type="number" value="0" min="0"></td>';
//            echo '<td><input name="'.$row["PROPOSALID"].'_SELECTION" value="accept" type="radio"></td>';
//            echo '<td><input name="'.$row["PROPOSALID"].'_SELECTION" value="reject" type="radio"></td>';
//            echo'</tr>';
//        }
//        oci_close($conn);   
  //  
    </table>
    <input type="submit" value="Submit">
</form>



-->
