<?php
session_start();

include 'header.php';

$statement = getAllProducts();

while($row = oci_fetch_array($statement, OCI_BOTH))
{
    $pid = $row[1];
    $p_name = $row[3];
    $p_cost = $row[4];
    $p_warrenty = $row[5];
    $p_stock = $row[6];
    
    $link = '<a href="product.php?product_id='.$pid.'">'.$p_name.'</a>';
    
    echo "Name: ". $link . " ". $p_cost. " ". $p_stock. "</br></br>";
}

include 'footer.php';

?>