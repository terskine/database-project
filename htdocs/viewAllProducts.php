<?php
session_start();

include 'header.php';

$statement = getAllProducts();

echo '<table style="width:500px">';
echo '<td><strong>'.Name .'</strong></td>';
echo '<td><strong>'.Cost .'</strong></td>';
echo '<td><strong>'.Stock .'</strong></td>';

while($row = oci_fetch_array($statement, OCI_BOTH))
{
    echo '<tr>';
    $pid = $row[1];
    $p_name = $row[3];
    $p_cost = $row[4];
    $p_warrenty = $row[5];
    $p_stock = $row[6];
    
    $link = '<a href="product.php?product_id='.$pid.'">'.$p_name.'</a>';
    
    echo '<td>'.$link .'</td>';
    echo '<td>'.$p_cost .'</td>';
    echo '<td>'.$p_stock .'</td>';
    
    echo '</tr>';
}

echo "</table>";

include 'footer.php';

?>