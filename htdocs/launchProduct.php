<?php session_start(); 
include 'header.php';?>

<form onsubmit="return checkFilled()" action="submitLaunch.php" method="post">
    <table style="width:300px" >
        <tr>
            <th>Proposal ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Votes</th>
            <th>Quantity</th>
            <th>Cost</th>
            <th>Warranty</th>
            <th>Stock</th>
            <th>Reorder Level</th>
            <th>Select</th>
        </tr>
        <?php 
            $conn = oci_connect('SYSTEM', 'password', '//localhost/project');
            $stid=oci_parse($conn, "SELECT * FROM PROPOSEPRODUCT NATURAL JOIN CATEGORY WHERE STATUS='A'");
            oci_execute($stid);
            while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                echo '<tr>';
                echo '<td>'.$row["PROPOSALID"].'</td>';
                echo '<td>'.$row["PRODUCTNAME"].'</td>';
                echo '<td>'.$row["CATEGORYNAME"].'</td>';
                echo '<td>'.$row["VOTES"].'</td>';
                echo '<td>'.$row["QUANTITY"].'</td>';
                echo '<td><input type="number" name="'.$row["PROPOSALID"].'_cost" min="1" max="9999999999"></td>';
                echo '<td><input type="number" name="'.$row["PROPOSALID"].'_warranty" min="1" max="99"></td>';
                echo '<td><input type="number" name="'.$row["PROPOSALID"].'_stock" min="1" max="9999"></td>';
                echo '<td><input type="number" name="'.$row["PROPOSALID"].'_reorder" min="1" max="999"></td>';
                echo '<td><input type="checkbox" id="box" name="'.$row["PROPOSALID"].'_select"></td>';
                echo'</tr>';
            }
            oci_close($conn);
            

        ?>
    </table>
    <input type="submit" value="Submit">
</form>
<script>
    function checkFilled() {
        
        var boxes = document.getElementsByTagName("tr");
        for (var i = 1; i < boxes.length; i++){
            if (document.getElementsByName(boxes[i].cells[0].innerHTML+"_select")[0].checked == true) {
                var id = boxes[i].cells[0].innerHTML;
                if((document.getElementsByName(id+"_cost")[0].value =="") ||
                        (document.getElementsByName(id+"_warranty")[0].value =="") ||
                        (document.getElementsByName(id+"_stock")[0].value =="") ||
                        (document.getElementsByName(id+"_reorder")[0].value =="")){
                    alert("Please make sure all fields are filled in for selected products.");
                    return false;
                }
            }
            
        }
        return true;
    }
    
</script>
<?php include 'footer.php';?>

